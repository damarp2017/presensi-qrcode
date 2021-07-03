<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Config;
use App\Models\Attendance;
use Carbon\Carbon;
use DB;

class AttendanceController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','permission:manage everything'])->except(['attendance']);
        $this->config = Config::first();
        $this->time = Carbon::now()->toTimeString();
        $this->inBegin = $this->config->in_begin ?? null;
        $this->inOver = $this->config->in_over ?? null;
        $this->outBegin = $this->config->out_begin ?? null;
        $this->outOver = $this->config->out_over ?? null;
    }

    public function index(){
      return view('admin.attendance.attendance');
    }

    public function main(){
      $students = Student::all();
      $attendances = Attendance::whereDate('created_at', Carbon::now())->get();

      if (!$attendances) {
        DB::beginTransaction();
          try {
            foreach ($students as $student) {
              $this->saveAttendance($student);
            }
            DB::commit();
          } catch (\Exception $e) {
             DB::rollback();
          }
      }
      elseif (count($attendances) != count($students)) {
         foreach ($students as $student) {
           if($student->attendances->where('created_at', Carbon::now())){
             $this->saveAttendance($student);
           }
         }
      }

      return view('main');
    }

    public function saveAttendance($student){
      $attendance = new Attendance();
      $attendance->student_id = $student->id;
      $attendance->absent = "A";
      $attendance->save();
    }

    public function attendance(Request $request){
      $nisn = $request->nisn;
      $student = Student::where('nisn',$nisn)->first();
      if ($student) {
        return $this->attendanceConfig($student);;
      }
      else {
        return $this->responseFailed("Absensi gagal!");
      }
    }

    protected function attendanceConfig($student){
      $studentAttendance = Attendance::where('student_id', $student->id)
                          ->whereDate('created_at', Carbon::now())->first();
      if(!$studentAttendance->in && !$studentAttendance->out){
        return $this->attendanceIn($studentAttendance, $student);
      }
      elseif ($studentAttendance->in && $studentAttendance->out) {
        return $this->responseFailed("Absensi pulang gagal!", "Maaf anda talah melakukan absensi pulang");
      }
      elseif ($studentAttendance->in
              && $this->time >= $this->outBegin
              && $this->time <= Carbon::parse($this->outOver)->addSeconds(59)) {

        return $this->attendanceOut($studentAttendance,$student);
      }else {
        return $this->responseFailed("Absensi berangkat gagal!", "Maaf anda sudah melakukan absensi berangkat");
      }
    }

  protected function attendanceIn($studentAttendance,$student){
      $message = "Absensi berangkat gagal!";
      if($this->time >= $this->inBegin && $this->time <= $this->inOver){

        $delay = gmdate('H:i:s', Carbon::parse($this->time)->diffInSeconds($this->inBegin));
        $studentAttendance->in = Carbon::now()->toDateTimeString();
        $studentAttendance->delay_in = $delay;
        $studentAttendance->absent = null;
        $studentAttendance->update();
        $text = $student->name ." ". $student->grade->name;
        return $this->responseSuccsess("Absensi berangkat berhasil", $text);
      }
      elseif ( $this->time > $this->inOver) {
        return $this->responseFailed($message, "Sesi absensi berangkat telah habis");
      }
      return $this->responseFailed($message, "Maaf sesi absensi berangkat belum bisa dilakukan");
    }

  protected function attendanceOut($studentAttendance, $student){
      $message = "Absensi pulang gagal!";

      if($this->time >= $this->outBegin
        && $this->time <= Carbon::parse($this->outOver)->addSeconds(59)){

        $delay = gmdate('H:i:s', Carbon::parse($this->time)->diffInSeconds($this->outBegin));
        $studentAttendance->out = Carbon::now()->toDateTimeString();
        $studentAttendance->delay_out = $delay;
        $studentAttendance->absent = null;
        $studentAttendance->update();
        $text = $student->name ." ". $student->grade->name;
        return $this->responseSuccsess("Absensi pulang berhasil", $text);
      }
      elseif ( $this->time > $this->outOver) {
        return $this->responseFailed($message, "Sesi absensi pulang telah habis");
      }
      return $this->responseFailed($message, "Maaf sesi absensi pulang belum bisa dilakukan");
    }

    protected function responseSuccsess($message, $text){
      return response()->json([
        'message' => $message,
        'text' => $text,
        'status' => true
      ]);
    }

    protected function responseFailed($message, $text){
      return response()->json([
        'message' => $message,
        'text' => $text,
        'status' => false,
      ]);
    }
}

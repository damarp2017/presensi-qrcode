<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Config;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['attendance']);
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

    public function attendance(Request $request){
      $nisn = $request->nisn;
      $student = Student::where('nisn',$nisn)->first();
      if ($student) {
        return $this->attendanceConfig($student);;
      }else {
        return $this->responseFailed("Absensi gagal!");
      }
    }

    protected function attendanceConfig($student){
      $studentAttendance = Attendance::where('student_id', $student->id)
                          ->whereDate('created_at', Carbon::now())->first();

      if(!$studentAttendance){
        return $this->attendanceIn($student);
      }elseif ($studentAttendance->in && $studentAttendance->out) {
        return $this->responseFailed("Absensi pulang gagal!", "Maaf anda talah melakukan absensi pulang");
      }
      elseif ($studentAttendance->in && $this->time >= $this->outBegin && $this->time <= $this->outOver) {
        return $this->attendanceOut($studentAttendance,$student);
      }else {
        return $this->responseFailed("Absensi berangkat gagal!", "Maaf anda sudah melakukan absensi berangkat");
      }
    }

  protected function attendanceIn($student){
      $message = "Absensi berangkat gagal!";
      if($this->time >= $this->inBegin && $this->time <= $this->inOver){
        $attendance = new Attendance();
        $delay = gmdate('H:i:s', Carbon::parse($this->time)->diffInSeconds($this->inBegin));
        $attendance->student_id = $student->id;
        $attendance->in = Carbon::now()->toDateTimeString();
        $attendance->delay_in = $delay;
        $attendance->save();
        $text = $student->name ." ". $student->grade->name;
        return $this->responseSuccsess("Absensi berangkat berhasil", $text);
      }elseif ( $this->time > $this->inOver) {
        return $this->responseFailed($message, "Sesi absensi berangkat telah habis");
      }
      return $this->responseFailed($message, "Maaf sesi absensi berangkat belum bisa dilakukan");
    }

  protected function attendanceOut($studentAttendance, $student){
      $message = "Absensi pulang gagal!";

      if($this->time >= $this->outBegin && $this->time <= $this->outOver){
        $delay = gmdate('H:i:s', Carbon::parse($this->time)->diffInSeconds($this->outBegin));
        $studentAttendance->out = Carbon::now()->toDateTimeString();
        $studentAttendance->delay_out = $delay;
        $studentAttendance->update();
        $text = $student->name ." ". $student->grade->name;
        return $this->responseSuccsess("Absensi pulang berhasil", $text);
      }elseif ( $this->time > $this->outOver) {
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

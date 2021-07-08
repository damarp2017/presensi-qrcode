<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Config;
use Carbon\Carbon;

class StudentAttendanceController extends Controller
{
    public function __construct(){
      $this->attendances = Attendance::whereDate('created_at', Carbon::now())->get();
      $this->grades = Grade::orderBy('name', 'ASC')->get();
      $this->config = Config::first();
      $this->time = Carbon::now()->toTimeString();
      $this->inBegin = $this->config->in_begin ?? null;
      $this->inOver = Carbon::parse($this->config->in_over)->addSeconds(59)->format('H:i:s') ?? null;
      $this->outBegin = $this->config->out_begin ?? null;
      $this->outOver = Carbon::parse($this->config->out_over)->addSeconds(59)->format('H:i:s') ?? null;
    }

    public function index(Request $request){
      if($request->date){
        $this->search($request);
      }
      return view('admin.attendance.show', [
        'attendances' => $this->attendances,
        'grades' => $this->grades
      ]);
    }

    public function search($request){
      $date = $request->date ? Carbon::parse($request->date)->format('Y-m-d') : null;
      $grade = $request->grade;

      if ($request->date && $request->status && $request->grade) {
        $status = $request->status == 'M' ? null : $request->status;
        $this->attendances = Attendance::whereDate('created_at', $date)
                            ->where('absent', $status)
                            ->whereHas('student', function($query) use($grade){
                              $query->where('grade_id', $grade);
                            })->get();

      }elseif ($request->date && $request->grade) {
        $this->attendances = Attendance::whereDate('created_at', $date)
                            ->whereHas('student', function($query) use($grade){
                              $query->where('grade_id', $grade);
                            })->get();
      }elseif ($request->date && $request->status) {
        $status = $request->status == 'M' ? null : $request->status;
        $this->attendances = Attendance::whereDate('created_at', $date)
                            ->where('absent', $status)->get();
      }else{
        $this->attendances = Attendance::whereDate('created_at', $date)->get();
      }

    }

    public function adminAttendance(){
      return view('admin.attendance.admin-attendance');
    }

    public function adminAttendanceInUpdate(Request $request){
      $student = Student::where('nisn', $request->nisn)->first();
      $date_in = Carbon::parse($request->date_in)->format('Y-m-d');
      if($student){
        $attendance = Attendance::where('student_id', $student->id)->whereDate('created_at', $date_in)->first();
        if ($this->time > $this->inOver) {
          if ($attendance) {
            $attendance->update([
              'in' => $request->absent ? null : Carbon::now()->toDateTimeString(),
              'absent' => $request->absent,
              'delay_in' => $request->absent ? null : gmdate('H:i:s', Carbon::parse($this->inOver)->diffInSeconds($this->time))
            ]);
          }else {
            return back()->with('error', "Data pada tanggal ".$request->date_in." tidak di temukan");
          }
          return back()->with('success', "Data berhasil di ubah");
        }else {
          return back()->with('error', "Sesi absensi berangkat belum berakhir");
        }
      }
      return back()->with('error', "Data mahasiswa tidak ditemukan");
    }

    public function adminAttendanceOutUpdate(Request $request){
      $student = Student::where('nisn', $request->nisn)->first();
      $date_out = Carbon::parse($request->date_out)->format('Y-m-d');
      if($student){
        $attendance = Attendance::where('student_id', $student->id)->whereDate('created_at', $date_out)->first();
        if ($this->time > $this->outOver) {
          if ($attendance) {
            if ($attendance->absent) {
              return back()->with('error', "Siswa tidak masuk");
            }else {
              $attendance->update([
                'out' => Carbon::now()->toDateTimeString(),
                'absent' => $request->absent,
                'delay_out' => gmdate('H:i:s', Carbon::parse($this->outOver)->diffInSeconds($this->time))
              ]);
            }
          }
          else {
            return back()->with('error', "Data pada tanggal ".$request->date_in." tidak di temukan");
          }
          return back()->with('success', "Data berhasil di ubah");
        }else {
          return back()->with('error', "Sesi absensi pulang belum berakhir");
        }
      }
      return back()->with('error', "Data mahasiswa tidak ditemukan");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Grade;
use Carbon\Carbon;

class StudentAttendanceController extends Controller
{
    public function __construct(){
      $this->attendances = Attendance::whereDate('created_at', Carbon::now())->get();
      $this->grades = Grade::orderBy('name', 'ASC')->get();
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
      }

    }
}

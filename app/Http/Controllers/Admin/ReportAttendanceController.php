<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Grade;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SheetAttendance;

class ReportAttendanceController extends Controller
{
    public function __construct(){
      $this->attendances = Attendance::whereDate('created_at', Carbon::now())->get();
      $this->grades = Grade::orderBy('name', 'ASC')->get();
    }

    public function index(Request $request){
      if($request->search){
        $this->search($request);
      }

      if($request->print){
        return $this->print($request);
      }

      return view('admin.report.index',[
        'attendances' => $this->attendances,
        'grades' => $this->grades
      ]);
    }

    public function search($request){

      $startDate = $request->start_date ? Carbon::parse($request->start_date)->format('Y-m-d') : null;
      $endDate = $request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d') : null;
      $grade = $request->grade;

      if ($startDate && $endDate && $request->grade) {
        $this->attendances = Attendance::whereDate('created_at', '>=' ,$startDate)
                            ->whereDate('created_at', '<=' ,$endDate)
                            ->whereHas('student', function($query) use($grade){
                              $query->where('grade_id', $grade);
                            })->get();

      }elseif ($startDate && $endDate) {
        $this->attendances = Attendance::whereDate('created_at', '>=' ,$startDate)
                             ->whereDate('created_at', '<=' ,$endDate)
                             ->get();
      }
    }

    public function print($request){
      $startDate = $request->start_date ? Carbon::parse($request->start_date)->format('Y-m-d') : null;
      $endDate = $request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d') : null;
      $grade = $request->grade;
      $filename = $request->start_date == $request->end_date ?
        'Absensi '.$request->start_date.'.xlsx' :
        'Absensi '.$request->start_date.' sampai '.$request->end_date.'.xlsx';

      return (new SheetAttendance($startDate, $endDate, $grade))
      ->download($filename);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Grade;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportAttendance;

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

        // $this->attendances = Student::with(['attendances' => function($query) use($startDate, $endDate){
        //   $query->whereDate('created_at', '>=' ,$startDate)
        //         ->whereDate('created_at', '<=' ,$endDate);
        // }])->where('grade_id', $grade)
        // ->get();
        // dd($this->attendances->first());

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
      // dd((new ExportAttendance)->parameters($startDate, $endDate, $grade));
      return (new ExportAttendance)->parameters($startDate, $endDate, $grade)
      ->download('Absensi.xlsx');
    }

}

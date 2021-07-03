<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;

class StudentAttendanceController extends Controller
{
    public function index(){
      $attendances = Attendance::all();
      dd($attendances);
      return view('admin.attendance.show', [
        'attendances' => $attendances
      ]);
    }
}

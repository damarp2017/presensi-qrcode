<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Grade;

class DashboardController extends Controller
{
    public function index(){
      $students = Student::count();
      $grades = Grade::count();
      return view('dashboard', [
        'students' => $students,
        'grades' => $grades
      ]);
    }
}

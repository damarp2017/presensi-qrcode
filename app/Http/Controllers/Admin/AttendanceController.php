<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['attendance']);
    }

    public function index(){
      return view('admin.attendance.attendance');
    }

    public function attendance($nisn){
      $student = Student::where('nisn',$nisn)->first();
      if ($student) {
        return response()->json([
          'data' => (object)[
            'name' => $student->name,
            'grade' => $student->grade->name
          ],
          'message' => 'Absensi berhasil!',
          'status' => true
        ]);
      }else {
        return response()->json([
          'data' => (object) [],
          'message' => 'Absensi gagal!',
          'status' => false
        ]);
      }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Grade;
use App\Models\Attendance;
use Carbon\Carbon;


class ParentController extends Controller
{

  public function __construct(){
    $this->attendances = Attendance::whereDate('created_at', Carbon::now())->get();
    $this->grades = Grade::orderBy('name', 'ASC')->get();
  }
  public function index(Request $request)
  {
    if($request->date){
      $this->search($request);
    }

    return view('admin.parents.index', [
        'grades' => $this->grades,
        'attendances' => $this->attendances
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

  // public function create()
  // {
  //     $grades = Grade::orderBy('name', 'ASC')->get();
  //     return view('admin.students.create', [
  //         'grades' => $grades
  //     ]);
  // }
  //
  // public function store(Request $request)
  // {
  //     $request->validate([
  //         'grade_id' => 'required',
  //         'nisn' => 'required|min:10|max:10|unique:students,nisn',
  //         'name' => 'required',
  //         'address' => 'required',
  //         'phone' => 'required',
  //         'gender' => 'required',
  //     ]);
  //
  //     $student = new Student();
  //     $student->grade_id = $request->grade_id;
  //     $student->nisn = $request->nisn;
  //     $student->name = $request->name;
  //     $student->gender = $request->gender;
  //     $student->phone = $request->phone;
  //     $student->address = $request->address;
  //
  //     $student->save();
  //
  //     return redirect()->route('admin.student.index')
  //         ->with(["success" => "Data kelas baru: $student->name berhasil disimpan."]);
  // }
  //
  // public function edit(Student $student){
  //   $grades = Grade::orderBy('name', 'ASC')->get();
  //   return view('admin.students.edit', [
  //       'student' => $student,
  //       'grades' => $grades
  //   ]);
  // }
  //
  // public function update(Student $student, Request $request){
  //   $request->validate([
  //       'grade_id' => 'required',
  //       'nisn' => 'required|min:10|max:10|unique:students,nisn,'.$student->id,
  //       'name' => 'required',
  //       'address' => 'required',
  //       'phone' => 'required',
  //       'gender' => 'required',
  //   ]);
  //
  //   $student->grade_id = $request->grade_id;
  //   $student->nisn = $request->nisn;
  //   $student->name = $request->name;
  //   $student->gender = $request->gender;
  //   $student->phone = $request->phone;
  //   $student->address = $request->address;
  //
  //   $student->update();
  //
  //   return redirect()->route('admin.student.index')
  //       ->with(["success" => "Data kelas baru: $student->name berhasil diubah."]);
  // }
  //
  // public function destroy(Student $student){
  //   $name = $student->name;
  //   $student->delete();
  //   return redirect()->route('admin.student.index')
  //       ->with(["success" => "Data kelas baru: $name berhasil dihapus."]);
  // }
}

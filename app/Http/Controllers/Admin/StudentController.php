<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('name', 'ASC')->get();
        return view('admin.students.index', [
            'students' => $students
        ]);
    }

    public function create()
    {
        $grades = Grade::orderBy('name', 'ASC')->get();
        return view('admin.students.create', [
            'grades' => $grades
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required',
            'nisn' => 'required|min:10|max:10|unique:students,nisn',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
        ]);

        $student = new Student();
        $student->grade_id = $request->grade_id;
        $student->nisn = $request->nisn;
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->address = $request->address;

        $student->save();

        return redirect()->route('admin.student.index')
            ->with(["success" => "Data kelas baru: $student->name berhasil disimpan."]);
    }

    public function edit(Student $student)
    {
        $grades = Grade::orderBy('name', 'ASC')->get();
        return view('admin.students.edit', [
            'student' => $student,
            'grades' => $grades
        ]);
    }

    public function update(Student $student, Request $request)
    {
        $request->validate([
            'grade_id' => 'required',
            'nisn' => 'required|min:10|max:10|unique:students,nisn,' . $student->id,
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
        ]);

        $student->grade_id = $request->grade_id;
        $student->nisn = $request->nisn;
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->address = $request->address;

        $student->update();

        return redirect()->route('admin.student.index')
            ->with(["success" => "Data kelas: $student->name berhasil diubah."]);
    }

    public function destroy($student_id)
    {
        $student = Student::find($student_id);
        $name = $student->name;
        $student->delete();
        return redirect()->route('admin.student.index')
            ->with(["success" => "Data kelas: $name berhasil dihapus."]);
    }
}

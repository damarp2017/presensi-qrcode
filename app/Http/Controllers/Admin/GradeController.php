<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return view('admin.grades.index', compact([
            'grades',
        ]));
    }

    public function create()
    {
        return view('admin.grades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:grades,name',
        ]);

        $grade = new Grade();
        $grade->name = Str::upper($request->name);
        $grade->save();

        return redirect()->route('admin.grade.index')
            ->with(["success" => "Data kelas baru: $grade->name berhasil disimpan."]);
    }

    public function edit(Grade $grade)
    {
        return view('admin.grades.edit', compact([
            'grade'
        ]));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'name' => "required|unique:grades,name,$grade->id",
        ]);

        $grade->name = Str::upper($request->name);
        $grade->update();

        return redirect()->route('admin.grade.index')
            ->with(["success" => "Data kelas: $grade->name berhasil diubah."]);
    }

    public function destroy($grade_id)
    {
        $grade = Grade::find($grade_id);
        $name = $grade->name;

        if ($grade->students->count() == 0) {
            $grade->delete();
            return redirect()->route('admin.grade.index')
                ->with(["success" => "Data kelas: $name berhasil dihapus."]);
        } else {
            return redirect()->route('admin.grade.index')
                ->with(["error" => "Data kelas: $name gagal dihapus, karena masih memiliki siswa. Silahkan kosongkan kelas terlebih dahulu."]);
        }
    }

    public function grade($grade_name)
    {
        $grade = Grade::where('name', $grade_name)->first();
        $students = $grade->students()->orderBy('name')->get();
        return view('admin.grades.grade', [
            'grade' => $grade,
            'students' => $students,
        ]);
    }
}

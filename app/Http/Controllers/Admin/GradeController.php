<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return view('admin.grade.index');
    }

    public function create()
    {
        return view('admin.grade.create');
    }
}

<?php

use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Parent\AttendanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // route that only admin can access
    Route::middleware(['permission:manage everything'])->group(function () {
        Route::get('/master-kelas', [
            GradeController::class, 'index'
        ])->name('admin.grade.index');
        Route::get('/master-kelas/tambah', [
            GradeController::class, 'create'
        ])->name('admin.grade.create');
    });

    // route for parent
    Route::get('attendace', [
        AttendanceController::class, 'index'
    ])->name('parent.attendance.index');
});

require __DIR__ . '/auth.php';

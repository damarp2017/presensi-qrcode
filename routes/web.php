<?php
//Admin Controller
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendance;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentAttendanceController;

//Parrent Controller
use App\Http\Controllers\Parent\AttendanceController;
use App\Http\Controllers\TestController;
// use App\Models\Grade;
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
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    // route that only admin can access
    Route::middleware(['permission:manage everything'])->group(function () {
      Route::get('/dashboard',[
        DashboardController::class, 'index'
        ])->name('dashboard');
        // grade's route
        Route::get('/grades', [
            GradeController::class, 'index'
        ])->name('admin.grade.index');
        Route::get('/grades/create', [
            GradeController::class, 'create'
        ])->name('admin.grade.create');
        Route::post('/grades/store', [
            GradeController::class, 'store'
        ])->name('admin.grade.store');
        Route::get('/grades/{grade}/edit', [
            GradeController::class, 'edit'
        ])->name('admin.grade.edit');
        Route::patch('/grades/{grade}/update', [
            GradeController::class, 'update'
        ])->name('admin.grade.update');
        Route::delete('/grades/destroy/{id}', [
            GradeController::class, 'destroy'
        ])->name('admin.grade.destroy');

        // get lists student on specific grade
        Route::get('/grades/{grade_name}', [
            GradeController::class, 'grade'
        ])->name('admin.grade.grade');

        // student's route
        Route::get('students', [
            StudentController::class, 'index'
        ])->name('admin.student.index');
        Route::get('students/create', [
            StudentController::class, 'create'
        ])->name('admin.student.create');
        Route::post('students/store', [
            StudentController::class, 'store'
        ])->name('admin.student.store');
        Route::get('/students/{student}/edit', [
            StudentController::class, 'edit'
        ])->name('admin.student.edit');
        Route::patch('/students/{student}/update', [
            StudentController::class, 'update'
        ])->name('admin.student.update');
        Route::delete('/students/destroy/{id}', [
            StudentController::class, 'destroy'
        ])->name('admin.student.destroy');

        // route admin to download card each student
        Route::get('/students/{student}/download', [
            StudentController::class, 'printIDCard'
        ])->name('admin.card.download');

        //route's admin parent
        Route::get('/parents', [
            ParentController::class, 'index'
        ])->name('admin.parent.index');

        //route's admin student attendace
        Route::get('/attendances/student', [
            AdminAttendance::class, 'index'
        ])->name('admin.attendance.student.index');
        Route::get('/main', [
            AdminAttendance::class, 'main'
        ])->name('main');
        Route::post('/attendances/student', [
            AdminAttendance::class, 'attendance'
        ])->name('admin.attendance.student.store');

        //route's admin config
        Route::get('/config', [
            ConfigController::class, 'index'
        ])->name('admin.config.index');
        Route::post('/config', [
            ConfigController::class, 'update'
        ])->name('admin.config.update');
    });

    // route for parent
    Route::get('attendace', [
        StudentAttendanceController::class, 'index'
    ])->name('parent.attendance.index');
});

require __DIR__ . '/auth.php';

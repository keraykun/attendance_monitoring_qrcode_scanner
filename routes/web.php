<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/signout', [App\Http\Controllers\Auth\LoginController::class, 'signout'])->name('signout');

Route::get('/qrcode/download/{student}', [App\Http\Controllers\QrCodeController::class, 'download'])->name('qrcode.download');

Route::middleware(['PreventBackHistory','auth','admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::resources([
        'dashboard' =>App\Http\Controllers\Admin\DashboardController::class,
        'teacher' =>App\Http\Controllers\Admin\TeacherController::class,
        'student' =>App\Http\Controllers\Admin\StudentController::class,
        'grade' =>App\Http\Controllers\Admin\GradeController::class,
        'room' =>App\Http\Controllers\Admin\RoomController::class,
        'schedule' =>App\Http\Controllers\Admin\ScheduleController::class,
        'attendance' =>App\Http\Controllers\Admin\AttendanceController::class,
        'teacherschedule' =>App\Http\Controllers\Admin\TeacherScheduleController::class,
        'studentschedule' =>App\Http\Controllers\Admin\ScheduleStudentsController::class,
    ]);
    Route::get('/teacherschedule/selected/{schedule}/{date}', [App\Http\Controllers\Admin\TeacherScheduleController::class, 'selected'])->name('teacherschedule.selected');
    Route::get('/attendance/list/{schedule}/{date}', [App\Http\Controllers\Admin\AttendanceController::class, 'list'])->name('attendance.list');
    Route::get('/schedule/list/{schedule}', [App\Http\Controllers\Admin\ScheduleController::class, 'list'])->name('schedule.list');
    // Route::get('/student/list/{student}', [App\Http\Controllers\Admin\StudentController::class, 'list'])->name('student.list');
});

Route::middleware(['PreventBackHistory','auth','teacher'])->prefix('teacher')->name('teacher.')->group(function(){
    Route::resources([
        'dashboard' =>App\Http\Controllers\Teacher\DashboardController::class,
        'schedule' =>App\Http\Controllers\Teacher\ScheduleController::class,
        'attendance' =>App\Http\Controllers\Teacher\AttendanceController::class,
        'student' =>App\Http\Controllers\Teacher\StudentController::class,
    ]);

    Route::get('/schedule/room/{schedule}', [App\Http\Controllers\Teacher\ScheduleController::class, 'room'])->name('schedule.room');
    Route::get('/schedule/selected/{schedule}/{date}', [App\Http\Controllers\Teacher\ScheduleController::class, 'selected'])->name('schedule.selected');
    Route::get('/attendance/list/{schedule}/{date}', [App\Http\Controllers\Teacher\AttendanceController::class, 'list'])->name('attendance.list');
});

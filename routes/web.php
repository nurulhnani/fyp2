<?php

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

Auth::routes();

//ADMIN
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');
});

/*------------------------------------------
--------------------------------------------
All Student Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:student'])->group(function () {
  
    Route::get('/student/home', [App\Http\Controllers\HomeController::class, 'studentHome'])->name('student.home');
});

/*------------------------------------------
--------------------------------------------
All Teacher Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:teacher'])->group(function () {
  
    Route::get('/teacher/home', [App\Http\Controllers\HomeController::class, 'teacherHome'])->name('teacher.home');
});

//STUDENT
// Route::get('/student', [App\Http\Controllers\StudentController::class, 'studentdashboard'])->name('student');
Route::resource('students', App\Http\Controllers\StudentController::class);
Route::put('/archiveStudent/{id}',[App\Http\Controllers\AdminController::class, 'archiveStudent'])->name('archiveStudent');
Route::put('/unarchiveStudent/{id}',[App\Http\Controllers\AdminController::class, 'unarchiveStudent'])->name('unarchiveStudent');
Route::get('/archivedStudentList', [App\Http\Controllers\AdminController::class, 'archivedStudentList'])->name('archivedStudentList');
Route::get('/addStudentInBulk', [App\Http\Controllers\AdminController::class, 'addStudentInBulk'])->name('addStudentInBulk');


//TEACHER
Route::get('/teacher', 'TeacherLoginController@index');
Route::resource('teachers', App\Http\Controllers\TeacherController::class);
Route::put('/archiveTeacher/{id}',[App\Http\Controllers\AdminController::class, 'archiveTeacher'])->name('archiveTeacher');
Route::put('/unarchiveTeacher/{id}',[App\Http\Controllers\AdminController::class, 'unarchiveTeacher'])->name('unarchiveTeacher');
Route::get('/archivedTeacherList', [App\Http\Controllers\AdminController::class, 'archivedTeacherList'])->name('archivedTeacherList');
Route::get('/addTeacherInBulk', [App\Http\Controllers\AdminController::class, 'addTeacherInBulk'])->name('addTeacherInBulk');

//CLASS
Route::resource('classes', App\Http\Controllers\ClassController::class);

//SUBJECT
Route::resource('subjects', App\Http\Controllers\SubjectController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
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
    Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'chartjs'])->name('admin.home');
	Route::resource('students', App\Http\Controllers\StudentController::class);
	Route::put('/archiveStudent/{id}',[App\Http\Controllers\AdminController::class, 'archiveStudent'])->name('archiveStudent');
	Route::put('/unarchiveStudent/{id}',[App\Http\Controllers\AdminController::class, 'unarchiveStudent'])->name('unarchiveStudent');
	Route::get('/archivedStudentList', [App\Http\Controllers\AdminController::class, 'archivedStudentList'])->name('archivedStudentList');
	Route::get('/addStudentInBulk', [App\Http\Controllers\AdminController::class, 'addStudentInBulk'])->name('addStudentInBulk');
	Route::resource('teachers', App\Http\Controllers\TeacherController::class);
	Route::put('/archiveTeacher/{id}',[App\Http\Controllers\AdminController::class, 'archiveTeacher'])->name('archiveTeacher');
	Route::put('/unarchiveTeacher/{id}',[App\Http\Controllers\AdminController::class, 'unarchiveTeacher'])->name('unarchiveTeacher');
	Route::get('/archivedTeacherList', [App\Http\Controllers\AdminController::class, 'archivedTeacherList'])->name('archivedTeacherList');
	Route::get('/addTeacherInBulk', [App\Http\Controllers\AdminController::class, 'addTeacherInBulk'])->name('addTeacherInBulk');
	Route::resource('classes', App\Http\Controllers\ClassController::class);
	Route::resource('subjects', App\Http\Controllers\SubjectController::class);
	Route::post('student-file-import', [App\Http\Controllers\StudentController::class, 'fileImport'])->name('student-file-import');
	Route::post('teacher-file-import', [App\Http\Controllers\TeacherController::class, 'fileImport'])->name('teacher-file-import');
	Route::get('/customfield',[App\Http\Controllers\AdminController::class, 'customfield'])->name('customfield');
	Route::get('/addmore',[App\Http\Controllers\AutoFieldsController::class, 'addMore']);
	Route::post('/addmore',[App\Http\Controllers\AutoFieldsController::class, 'addMorePost'])->name('addmore');
	Route::post('/storeclass',[App\Http\Controllers\SubjectController::class, 'storeclass'])->name('subjects.storeclass');
	Route::get('/manageAssessment',[App\Http\Controllers\InterestInventoryController::class, 'index'])->name('manageAssessment');
	Route::post('/addquestion',[App\Http\Controllers\InterestInventoryController::class, 'addquestion'])->name('addquestion');
	Route::put('/editassessment/{id}',[App\Http\Controllers\InterestInventoryController::class, 'editassessment'])->name('editassessment');
	Route::delete('/deletequestion/{id}',[App\Http\Controllers\InterestInventoryController::class, 'deletequestion'])->name('deletequestion');
	// Route::get('/admin/home',[App\Http\Controllers\AdminController::class, 'chartjs'])->name('filterdata');
});

/*------------------------------------------
--------------------------------------------
All Student Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:student'])->group(function () {
    Route::get('/student/home', [App\Http\Controllers\HomeController::class, 'studentHome'])->name('student.home');
	Route::get('/overview',[App\Http\Controllers\StudentController::class, 'overview'])->name('overview');
	Route::get('/history',[App\Http\Controllers\StudentController::class, 'history'])->name('history');
	Route::get('/studentprofile',[App\Http\Controllers\StudentController::class, 'viewprofile'])->name('viewprofile');
});

/*------------------------------------------
--------------------------------------------
All Teacher Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:teacher'])->group(function () {
  
    	Route::get('/teacher/home', [App\Http\Controllers\HomeController::class, 'teacherHome'])->name('teacher.home');
		//Module 1: meritDemerit
		Route::get('meritdemerit', function () {return view('merits.main');})->name('merits.main');
		Route::post('meritdemerit', [App\Http\Controllers\CurrMeritController::class, 'redirect'])->name('merits.redirect');

		Route::get('meritdemerit/curriculum/{student}', ['as' => 'merits.index', 'uses' => 'App\Http\Controllers\CurrMeritController@index']);
		Route::resource('merits', App\Http\Controllers\CurrMeritController::class, ['except' => ['index']]);
		Route::get('meritdemerit/curriculum-bulk', [App\Http\Controllers\CurrMeritController::class, 'viewStudentList'])->name('merits.bulk');
		// Route::get('file-import-export', [CurrMeritController::class, 'fileImportExport']);
		// Route::get('file-export', [CurrMeritController::class, 'fileExport'])->name('file-export');
		Route::post('checklist-import', [App\Http\Controllers\CurrMeritController::class, 'checklistImport'])->name('checklist-import');
		Route::post('file-import', [App\Http\Controllers\CurrMeritController::class, 'fileImport'])->name('file-import');
		Route::post('bulkmerits/add', [App\Http\Controllers\CurrMeritController::class, 'storeBulk'])->name('bulkmerits.store');

		Route::post('meritdemerit/behavioural/{student}', [App\Http\Controllers\BehaMeritController::class, 'index'])->name('behaMerits.index');
		Route::resource('behaMerits', App\Http\Controllers\BehaMeritController::class, ['except' => ['index']]);
		Route::get('meritdemerit/behavioural-bulk', [App\Http\Controllers\BehaMeritController::class, 'viewStudentList'])->name('behaMerits.bulk');
		Route::post('beha-checklist-import', [App\Http\Controllers\BehaMeritController::class, 'checklistImport'])->name('beha-checklist-import');
		Route::post('beha-file-import', [App\Http\Controllers\BehaMeritController::class, 'fileImport'])->name('beha-file-import');
		Route::post('behaBulkmerits/add', [App\Http\Controllers\BehaMeritController::class, 'storeBulk'])->name('behaBulkmerits.store');
	
		//Module 2: studentEvaluation
		Route::get('studentlist-evaluation', [App\Http\Controllers\PersonalityEvaluationController::class, 'viewStudentList'])->name('evaluationList');
		Route::get('studentlist-evaluation/question', [App\Http\Controllers\PersonalityEvaluationController::class, 'viewQuestion'])->name('evaluationQuestion');
		Route::get('studentlist-evaluation/interest/{id}', [App\Http\Controllers\InterestInventoryController::class, 'viewInterestQuestion'])->name('interestInventory');
		Route::put('studentlist-evaluation/interestresult', [App\Http\Controllers\InterestInventoryController::class, 'store'])->name('interest.store');
		Route::get('studentlist-evaluation/interestresult/{id}', [App\Http\Controllers\InterestInventoryController::class, 'showResult'])->name('interestResult');

		//Teacher profile
		Route::get('/teacherprofile',[App\Http\Controllers\TeacherController::class, 'viewprofile'])->name('viewprofile');

		//Student profile
		Route::get('/studentlist',[App\Http\Controllers\TeacherController::class, 'studentlist'])->name('studentlist');
		Route::get('/editstudent/{id}', [App\Http\Controllers\StudentController::class,'editstudent'])->name('editstudent');
		Route::put('/updatestudent/{id}', [App\Http\Controllers\StudentController::class,'updatestudent'])->name('updatestudent');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

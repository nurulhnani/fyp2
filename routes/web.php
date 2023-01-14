<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ForgotPasswordController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
    // return redirect()->route('login');
});

Route::get('/uploadimage', function () {
    return view('upload');
});

Route::post('upload', function(Request $request){
	$uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath(),['folder'=>'userImage'])->getSecurePath();
	dd($uploadedFileUrl);
})->name('upload');

Route::get("/storage-link", function () {
    // $targetFolder = storage_path("app/public");
    // $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    // symlink($targetFolder, $linkFolder);
	Artisan::call('storage:link');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/changePassword', [App\Http\Controllers\HomeController::class, 'changePwFirstLogin'])->name('changePwFirstLogin');
Route::get('/student-resetpassword/{id}',[App\Http\Controllers\HomeController::class, 'resetPw'])->name('student-resetpassword');
Route::post('/student-updatepassword/{id}',[App\Http\Controllers\HomeController::class, 'updatePw'])->name('studentpassword.update');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	// Route::get('/login',function () {return view('login');})->name('login');
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
	Route::get('/customfields-list',[App\Http\Controllers\AutoFieldsController::class, 'showfields'])->name('showfields');
	Route::delete('/deleteField/{id}',[App\Http\Controllers\AutoFieldsController::class, 'deleteField'])->name('deleteField');
	Route::put('/editField/{id}',[App\Http\Controllers\AutoFieldsController::class, 'editField'])->name('editField');
	Route::post('/storeclass',[App\Http\Controllers\SubjectController::class, 'storeclass'])->name('subjects.storeclass');
	Route::get('/manageAssessment',[App\Http\Controllers\InterestInventoryController::class, 'index'])->name('manageAssessment');
	Route::post('/addquestion',[App\Http\Controllers\InterestInventoryController::class, 'addquestion'])->name('addquestion');
	Route::put('/editassessment/{id}',[App\Http\Controllers\InterestInventoryController::class, 'editassessment'])->name('editassessment');
	Route::delete('/deletequestion/{id}',[App\Http\Controllers\InterestInventoryController::class, 'deletequestion'])->name('deletequestion');
	Route::get('download-student-file', [App\Http\Controllers\AdminController::class, 'downloadstudentfile'])->name('downloadstudentfile');
	Route::get('download-teacher-file', [App\Http\Controllers\AdminController::class, 'downloadteacherfile'])->name('downloadteacherfile');
	Route::get('/manageProfileRequest',[App\Http\Controllers\ProfileRequestController::class, 'index'])->name('manageProfileRequest');
	Route::post('/manageProfileRequest/{id}',[App\Http\Controllers\ProfileRequestController::class, 'storeApproval'])->name('storeApproval');



});

/*------------------------------------------
--------------------------------------------
All Student Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:student'])->group(function () {
    Route::get('/student/home', [App\Http\Controllers\HomeController::class, 'studentHome'])->name('student.home');
	Route::get('/overview/{id}',[App\Http\Controllers\StudentController::class, 'overview'])->name('overview');
	// Route::get('/InterestInventoryResult/{id}',[App\Http\Controllers\StudentController::class, 'showResultforStudent'])->name('showResultforStudent');
	Route::get('/dashboard/{id}',[App\Http\Controllers\StudentController::class, 'dashboard'])->name('studenthome');
	Route::get('/studentprofile',[App\Http\Controllers\StudentController::class, 'viewprofile'])->name('viewstudentprofile');
	Route::get('/studentprofile/edit',[App\Http\Controllers\StudentController::class, 'updateprofile'])->name('updatestudentprofile');
	Route::post('/studentprofile/edit',[App\Http\Controllers\ProfileRequestController::class, 'storeRequest'])->name('storeRequest');
	Route::get('/studentProfile-export/{id}',[App\Http\Controllers\PDFController::class, 'showExportForm'])->name('studentProfile-export');
	Route::post('/student-profile/{id}',[App\Http\Controllers\PDFController::class, 'showStudentProfile'])->name('showProfile');
	Route::get('/generatePDF/{id}',[App\Http\Controllers\PDFController::class, 'generatePDF'])->name('generatePDF');
	Route::get('/showPDF/{id}',[App\Http\Controllers\PDFController::class, 'showPDF'])->name('showPDF');
});

/*------------------------------------------
--------------------------------------------
All Teacher Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:teacher'])->group(function () {
  
    	Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherDashboardController::class, 'index'])->name('teacher.home');
		
		//Merit and Demerit
		Route::get('meritdemerit', function () {return view('merits.main');})->name('merits.main');
		Route::post('meritdemerit', [App\Http\Controllers\CurrMeritController::class, 'redirect'])->name('merits.redirect');

		Route::get('meritdemerit/curriculum/{student}', ['as' => 'merits.index', 'uses' => 'App\Http\Controllers\CurrMeritController@index']);
		Route::resource('merits', App\Http\Controllers\CurrMeritController::class, ['except' => ['index']]);
		Route::get('meritdemerit/curriculum-bulk', [App\Http\Controllers\CurrMeritController::class, 'viewStudentList'])->name('merits.bulk');
		Route::post('checklist-import', [App\Http\Controllers\CurrMeritController::class, 'checklistImport'])->name('checklist-import');
		Route::post('file-import', [App\Http\Controllers\CurrMeritController::class, 'fileImport'])->name('file-import');
		Route::post('bulkmerits/add', [App\Http\Controllers\CurrMeritController::class, 'storeBulk'])->name('bulkmerits.store');
		Route::get('/autocomplete-search', [App\Http\Controllers\CurrMeritController::class, 'autocompleteSearch'])->name('autocompleteSearch');

		Route::get('meritdemerit/behavioural/{student}', [App\Http\Controllers\BehaMeritController::class, 'index'])->name('behaMerits.index');
		Route::resource('behaMerits', App\Http\Controllers\BehaMeritController::class, ['except' => ['index']]);
		Route::get('meritdemerit/behavioural-bulk', [App\Http\Controllers\BehaMeritController::class, 'viewStudentList'])->name('behaMerits.bulk');
		Route::post('beha-checklist-import', [App\Http\Controllers\BehaMeritController::class, 'checklistImport'])->name('beha-checklist-import');
		Route::post('beha-file-import', [App\Http\Controllers\BehaMeritController::class, 'fileImport'])->name('beha-file-import');
		Route::post('behaBulkmerits/add', [App\Http\Controllers\BehaMeritController::class, 'storeBulk'])->name('behaBulkmerits.store');
		Route::get('/beha-autocomplete-search', [App\Http\Controllers\BehaMeritController::class, 'autocompleteSearch'])->name('beha-autocompleteSearch');

		//Student Evaluation
		Route::get('studentlist-evaluation', [App\Http\Controllers\PersonalityEvaluationController::class, 'index'])->name('evaluations.index');
		Route::get('studentlist-evaluation/personality/{question}/{student?}', [App\Http\Controllers\PersonalityEvaluationController::class, 'viewPersonalityQuestion'])->name('personalityEval');
		Route::post('result', [App\Http\Controllers\PersonalityEvaluationController::class, 'store'])->name('personality.store');
		Route::get('studentlist-evaluation/personality-result/current/{student}', [App\Http\Controllers\PersonalityEvaluationController::class, 'showCurrResult'])->name('personalityResultCurr');
		Route::get('studentlist-evaluation/personality-result/history/{student}', [App\Http\Controllers\PersonalityEvaluationController::class, 'showHistory'])->name('personalityResultHist');

		Route::get('studentlist-evaluation/interest/{id}', [App\Http\Controllers\InterestInventoryController::class, 'viewInterestQuestion'])->name('interestInventory');
		Route::put('studentlist-evaluation/interestresult', [App\Http\Controllers\InterestInventoryController::class, 'store'])->name('interest.store');
		Route::get('studentlist-evaluation/interestresult/{id}', [App\Http\Controllers\InterestInventoryController::class, 'showResult'])->name('interestResult');

		//Teacher profile
		Route::get('/teacherprofile',[App\Http\Controllers\TeacherController::class, 'viewprofile'])->name('viewprofile');
		Route::post('/teacherprofile',[App\Http\Controllers\TeacherController::class, 'editprofile'])->name('editprofile');

		//Student profile
		Route::get('/studentlist',[App\Http\Controllers\TeacherController::class, 'studentlist'])->name('studentlist');
		Route::get('/editstudent/{id}', [App\Http\Controllers\StudentController::class,'editstudent'])->name('editstudent');
		Route::get('/student-overview/{id}', [App\Http\Controllers\StudentController::class,'overviewForTeacher'])->name('studentoverview');
		Route::put('/updatestudent/{id}', [App\Http\Controllers\StudentController::class,'updatestudent'])->name('updatestudent');

		//Classroom Management
		Route::get('classroom', [App\Http\Controllers\ClassroomManagementController::class, 'index'])->name('classrooms.index');
		Route::post('classroom/view', [App\Http\Controllers\ClassroomManagementController::class, 'view'])->name('classrooms.view');
		Route::get('classroom/plan/{class}', [App\Http\Controllers\ClassroomManagementController::class, 'plan'])->name('classrooms.plan');
		Route::post('classroom/getAjax', [App\Http\Controllers\ClassroomManagementController::class, 'getAjax'])->name('classrooms.getAjax');

		//Health Assessment
		Route::resource('health', App\Http\Controllers\HealthController::class);
		Route::get('/health/create/{id}',[App\Http\Controllers\HealthController::class, 'create']);
});

Auth::routes();
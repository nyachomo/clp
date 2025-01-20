<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClasController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\LeedController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CourseModuleController;
Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


/*
Route::get('/administrators',[UserController::class, 'index'])->name('showAdministrator');
Route::get('admin.fetch.users',[UserController::class, 'adminFetchUsers'])->name('adminFetchUsers');
Route::post('admin.add.new.user2',[UserController::class, 'adminAddNewUser2'])->name('adminAddNewUser2');
Route::post('/update-user', [UserController::class, 'update'])->name('updateUser');
Route::post('/delete-user', [UserController::class, 'delete'])->name('deleteUser');
Route::post('/users/upload', [UserController::class, 'upload'])->name('users.upload');
Route::get('/users/download', [UserController::class, 'download'])->name('users.download');
Route::get('/download-user-file',[UserController::class,'downloadUserFile'])->name('downloadUserFile');
*/





Route::prefix('admin')->group(function () {
    Route::get('/administrators', [UserController::class, 'index'])->name('showAdministrator');
    Route::get('/fetch-users', [UserController::class, 'adminFetchUsers'])->name('adminFetchUsers');
    Route::post('/add-new-user', [UserController::class, 'adminAddNewUser2'])->name('adminAddNewUser2');
    Route::post('/update-user', [UserController::class, 'update'])->name('updateUser');
    Route::post('/delete-user', [UserController::class, 'delete'])->name('deleteUser');
    Route::post('/suspend-user', [UserController::class, 'suspend'])->name('suspendUser');
    Route::post('/users/upload', [UserController::class, 'upload'])->name('users.upload');
    Route::get('/users/download', [UserController::class, 'download'])->name('users.download');
    Route::get('/download-user-file', [UserController::class, 'downloadUserFile'])->name('downloadUserFile');
    Route::get('/user-account', [UserController::class, 'UserAccount'])->name('userAccount');
});

Route::prefix('trainees')->group(function () {
    Route::get('/show', [TraineeController::class, 'index'])->name('showTrainees');
    Route::get('/fetch-trainees', [TraineeController::class, 'fetchTrainees'])->name('fetchTrainees');
    Route::post('/add-trainee', [TraineeController::class, 'addTrainee'])->name('addTrainee');
    Route::post('/update-trainee', [TraineeController::class, 'updateTrainee'])->name('updateTrainee');
    Route::get('/view-notes/{id}', [TraineeController::class, 'traineeViewNotes'])->name('traineeViewNotes');
    //trainee view course

    Route::get('/view-course', [TraineeController::class, 'traineeViewCourse'])->name('traineeViewCourse');
});


Route::prefix('courses')->group(function () {
    Route::get('/show', [CourseController::class, 'index'])->name('showCourses');
    Route::get('/fetch-courses', [CourseController::class, 'fetchCourses'])->name('fetchCourses');
    Route::post('/add', [CourseController::class, 'addCourse'])->name('addCourse');
    Route::post('/update', [CourseController::class, 'updateCourse'])->name('updateCourse');
    Route::post('/delete', [CourseController::class, 'deleteCourse'])->name('deleteCourse');
    Route::post('/suspend', [CourseController::class, 'suspendCourse'])->name('suspendCourse');

   
});



Route::prefix('clases')->group(function () {
    Route::get('/show', [ClasController::class, 'index'])->name('showClases');
    Route::get('/fetch-clases', [ClasController::class, 'fetchClases'])->name('fetchClases');
    Route::post('/add', [ClasController::class, 'addClas'])->name('addClas');
    Route::post('/update', [ClasController::class, 'updateClas'])->name('updateClas');
    Route::post('/delete', [ClasController::class, 'deleteClas'])->name('deleteClas');
    Route::post('/suspend', [ClasController::class, 'suspendClas'])->name('suspendClas');

   
});


Route::prefix('topics')->group(function () {
    Route::get('/show', [TopicController::class, 'index'])->name('showTopics');
    //Route::get('/fetch-topics', [TopicController::class, 'fetchTopics'])->name('fetchTopics');
    Route::post('/add', [TopicController::class, 'addTopics'])->name('addTopics');
    Route::post('/update', [TopicController::class, 'updateTopics'])->name('updateTopics');
    Route::post('/delete', [TopicController::class, 'deleteTopics'])->name('deleteTopics');
    Route::post('/suspend', [TopicController::class, 'suspendTopics'])->name('suspendTopics');

   
});

Route::prefix('school')->group(function () {
    Route::get('/show', [SchoolController::class, 'index'])->name('showSchools');
    Route::get('/fetch-schools', [SchoolController::class, 'fetchSchools'])->name('fetchSchools');
    Route::post('/add', [SchoolController::class, 'addSchools'])->name('addSchools');
    Route::post('/update', [SchoolController::class, 'updateSchools'])->name('updateSchools');
    Route::post('/delete', [SchoolController::class, 'deleteSchools'])->name('deleteSchools');
    Route::post('/suspend', [SchoolController::class, 'suspendSchools'])->name('suspendSchools');

   
});


Route::prefix('Leeds')->group(function () {
    Route::get('/show', [LeedController::class, 'index'])->name('showLeeds');
    Route::get('/fetch-leeds', [LeedController::class, 'fetchLeeds'])->name('fetchLeeds');
    Route::post('/add', [LeedController::class, 'addLeeds'])->name('addLeeds');
    Route::post('/update', [LeedController::class, 'updateLeeds'])->name('updateLeeds');
    Route::post('/delete', [LeedController::class, 'deleteLeeds'])->name('deleteLeeds');
    Route::post('/suspend', [LeedController::class, 'suspendLeeds'])->name('suspendLeeds'); 
});


Route::prefix('exams')->group(function () {
    Route::get('/show', [ExamController::class, 'index'])->name('showExams');
    Route::get('/fetch-assignments', [ExamController::class, 'fetchAssignments'])->name('fetchAssignments');
    Route::post('/add/assignment', [ExamController::class, 'addAssignment'])->name('addAssignment');


    Route::post('/update', [ExamController::class, 'updateExams'])->name('updateExams');
    Route::post('/delete', [ExamController::class, 'deleteExams'])->name('deleteExams');
    Route::post('/published', [ExamController::class, 'publishedExams'])->name('publishedExams');
});







Route::prefix('questions')->group(function () {
    Route::get('/adminManageQuestions', [QuestionController::class, 'adminManageQuestions'])->name('adminManageQuestions');
    Route::post('/add', [QuestionController::class, 'addQuestion'])->name('addQuestion');
    //Route::get('/fetch-questions', [QuestionController::class, 'fetchQuestions'])->name('fetchQuestions');
    Route::get('/fetch_questions/{exam_id}', [QuestionController::class, 'fetchQuestions'])->name('fetchQuestions');
    Route::post('/update', [QuestionController::class, 'updateQuestion'])->name('updateQuestion');
    Route::post('/delete', [QuestionController::class, 'deleteQuestion'])->name('deleteQuestion');
});

Route::prefix('course-modules')->group(function () {
    Route::get('/manageCourseModule', [CourseModuleController::class, 'manageCourseModule'])->name('manageCourseModule');
    Route::post('/add', [CourseModuleController::class, 'addModule'])->name('addModule');
    Route::post('/update', [CourseModuleController::class, 'updateModule'])->name('updateModule');
    Route::post('/delete', [CourseModuleController::class, 'deleteModule'])->name('deleteModule');
    Route::get('/fetch_module/{course_id}', [CourseModuleController::class, 'fetchModules'])->name('fetchModules');
    Route::post('/topics', [CourseModuleController::class, 'deleteModule'])->name('deleteModule');

    Route::get('/manageNotes', [CourseModuleController::class, 'adminManageNotes'])->name('adminManageNotes');
    Route::get('/fetch-topics/{id}', [CourseModuleController::class, 'fetchTopics'])->name('fetchTopics');
});

Route::prefix('settings')->group(function () {
    Route::get('/show', [SettingController::class, 'ShowSettings'])->name('ShowSettings');
    Route::post('/update-logo', [SettingController::class, 'updateCompanyLogo'])->name('updateCompanyLogo');
    Route::post('/update-company-deatils', [SettingController::class, 'updateCompanyDetails'])->name('updateCompanyDetails');
    Route::get('/fetch', [SettingController::class, 'fetchCompanyDetails'])->name('fetchCompanyDetails');

    Route::post('/updateComapy-settings', [SettingController::class, 'updatecompanySettings'])->name('updatecompanySettings');

    
   
});
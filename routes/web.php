<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClasController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\LeedController;
use App\Http\Controllers\ExamController;
Route::get('/', function () {
    return view('welcome');
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
    Route::post('/users/upload', [UserController::class, 'upload'])->name('users.upload');
    Route::get('/users/download', [UserController::class, 'download'])->name('users.download');
    Route::get('/download-user-file', [UserController::class, 'downloadUserFile'])->name('downloadUserFile');
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
    Route::get('/fetch-topics', [TopicController::class, 'fetchTopics'])->name('fetchTopics');
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
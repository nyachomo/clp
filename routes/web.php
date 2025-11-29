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
use App\Http\Controllers\FeeController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CourseModuleController;
use App\Http\Controllers\ClassNotesController;
use App\Http\Controllers\HighSchoolTeacherController;
use App\Http\Controllers\DashboardUpdatesController;
use App\Http\Controllers\GoogleMeetController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ScholarshipLetterController;
use App\Http\Controllers\ScholarshipTestCourseController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\JitsiMeetingController;
use App\Http\Controllers\PracticalController;

/*
Route::get('/', function () {
    return view('welcome');
    //return redirect()->route('login');
})->name('welcome');

*/
Route::get('/',[WelcomeController::class,'welcome'])->name('welcome');

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
    Route::get('/administrators', [BackendController::class, 'index'])->name('showAdministrator');
    Route::get('/fetch-users', [BackendController::class, 'adminFetchUsers'])->name('adminFetchUsers');
    Route::post('/add-new-user', [BackendController::class, 'adminAddNewUser2'])->name('adminAddNewUser2');
    Route::post('/update-user', [BackendController::class, 'update'])->name('updateUser');
    Route::post('/delete-user', [BackendController::class, 'delete'])->name('deleteUser');
    Route::post('/update-user-password', [BackendController::class, 'updateUserPassword'])->name('updateUserPassword');
    Route::post('/suspend-user', [BackendController::class, 'suspend'])->name('suspendUser');
    Route::post('/users/upload', [BackendController::class, 'upload'])->name('users.upload');
    Route::get('/users/download', [BackendController::class, 'download'])->name('users.download');
    Route::get('/download-user-file', [BackendController::class, 'downloadUserFile'])->name('downloadUserFile');
    Route::get('/user-account', [BackendController::class, 'UserAccount'])->name('userAccount');
    //AJAX REQUEST THAT FETCH USER PROFILE
    Route::get('/fetch-user-profile', [BackendController::class, 'fetchUserProfile'])->name('fetchUserProfile');

    Route::post('adminUpdateUserPassword',[BackendController::class, 'adminUpdateUserPassword'])->name('adminUpdateUserPassword');
    Route::post('adminUpdateUserPicture',[BackendController::class, 'adminUpdateUserPicture'])->name('adminUpdateUserPicture');
    Route::post('userUpdateProfile',[BackendController::class, 'userUpdateProfile'])->name('userUpdateProfile');
    

    //admin manage timetable
    Route::get('manageTimeTable',[BackendController::class, 'showTimeTable'])->name('showTimeTable');
    Route::post('create-timetable',[BackendController::class, 'addTimeTable'])->name('addTimeTable');
    Route::post('update-timetable',[BackendController::class, 'updateTimeTable'])->name('updateTimeTable');
    Route::post('delete-timetable',[BackendController::class, 'deleteTimeTable'])->name('deleteTimeTable');

    //MANAGE CLASS NOTES
    Route::get('ShowClassNotes',[BackendController::class, 'showClassNotes'])->name('showClassNotes');
    Route::post('create-class-notes',[BackendController::class, 'addClassNotes'])->name('addClassNotes');
    Route::post('update-class-notes',[BackendController::class, 'updateClassNotes'])->name('updateClassNotes');
    Route::post('delete-class-notes',[BackendController::class, 'deleteClassNotes'])->name('deleteClassNotes');
    
});



//ROUTE FOR UPDATING THE DASHBOARD
Route::prefix('Dashboard-Updates')->group(function (){
   Route::get('admin',[BackendController::class,'fetchAdminDashboardUpdates'])->name('fetchAdminDashboardUpdates');
   Route::get('/monthly-enrollments', [BackendController::class, 'getMonthlyEnrollments'])->name('monthly.enrollments');

});

//HIGH SCHOOL TEACHER
Route::prefix('h-schl')->group(function () {
    Route::get('/students', [BackendController::class, 'fetchHighStudents'])->name('fetchHighStudents');
    Route::get('/ViewTraineeProfile', [BackendController::class, 'ViewTraineeProfile'])->name('ViewTraineeProfile');
});



Route::prefix('trainees')->group(function () {
    Route::get('/show', [BackendController::class, 'showTrainees'])->name('showTrainees');
    Route::get('/showTraineePerClas', [BackendController::class, 'showTraineePerClas'])->name('showTraineePerClas');
    Route::get('/showAssignmentPerClas', [ClasController::class, 'showAssignmentPerClas'])->name('showAssignmentPerClas');
    
    Route::get('/showPracticalPerClas', [ClasController::class, 'showPracticalPerClas'])->name('showPracticalPerClas');
    Route::get('/showCatsPerClas', [ClasController::class, 'showCatsPerClas'])->name('showCatsPerClas');
    Route::get('/showFinalExamPerClas', [ClasController::class, 'showFinalExamPerClas'])->name('showFinalExamPerClas');
    Route::get('/fetchFinalExamPerClas/{classId}', [ClasController::class, 'fetchFinalExamPerClas'])->name('fetchFinalExamPerClas');
    Route::get('/fetchAssignmentPerClas/{classId}', [ClasController::class, 'fetchAssignmentPerClas'])->name('fetchAssignmentPerClas');
    Route::get('/fetchPracticalPerClas/{classId}', [ClasController::class, 'fetchPracticalPerClas'])->name('fetchPracticalPerClas');
    Route::post('/updatePracticalPerClas', [ClasController::class, 'updatePracticalPerClas'])->name('updatePracticalPerClas');
    Route::post('/deletePracticalPerClas', [ClasController::class, 'deletePracticalPerClas'])->name('deletePracticalPerClas');
    Route::get('/fetchCatsPerClas/{classId}', [ClasController::class, 'fetchCatsPerClas'])->name('fetchCatsPerClas');


    Route::get('/fetch-trainees', [BackendController::class, 'fetchTrainees'])->name('fetchTrainees');
    Route::post('/add-trainee', [BackendController::class, 'addTrainee'])->name('addTrainee');
    
    Route::post('/update-trainee', [BackendController::class, 'updateTrainee'])->name('updateTrainee');
    Route::post('/update-trainee-per-class', [BackendController::class, 'updateTraineePerClas'])->name('updateTraineePerClas');
    
    Route::get('/view-notes/{id}', [BackendController::class, 'traineeViewNotes'])->name('traineeViewNotes');
    //trainee view course

    Route::get('/view-course', [BackendController::class, 'traineeViewCourse'])->name('traineeViewCourse');
    Route::get('/viewFeePayments', [BackendController::class, 'traineeViewFeePayment'])->name('traineeViewFeePayment');
    Route::get('/viewAssignment', [BackendController::class, 'traineeViewAssignment'])->name('traineeViewAssignment');
    Route::get('/fetch-assignments', [BackendController::class, 'traineeFetchAssignments'])->name('traineeFetchAssignments');
    Route::get('/viewQuestions', [BackendController::class, 'traineeViewQuestions'])->name('traineeViewQuestions');
    Route::get('/fetch_questions/{exam_id}', [BackendController::class, 'fetchQuestionsForTrainee'])->name('fetchQuestionsForTrainee');


    Route::post('/store-answer', [BackendController::class, 'storeStudentAnswer'])->name('storeStudentAnswer');

    //CATS
    Route::get('/viewCats', [BackendController::class, 'traineeViewCats'])->name('traineeViewCats');
    Route::get('/fetch-cats', [BackendController::class, 'traineeFetchCats'])->name('traineeFetchCats');

    //FINAL EXAM
    Route::get('/viewFinalExam', [BackendController::class, 'traineeViewFinalExam'])->name('traineeViewFinalExam');
    Route::get('/fetch-final-exam', [BackendController::class, 'traineeFetchFinalExam'])->name('traineeFetchFinalExam');


    //FETCH FEES
    Route::get('/fetch-fees', [BackendController::class, 'fetchFeeBalance'])->name('fetchFeeBalance');

    Route::get('/show-class-link', [BackendController::class, 'showClassLink'])->name('showClassLink');
    Route::get('/show-class-notes', [BackendController::class, 'viewClassNotes'])->name('viewClassNotes');


    Route::get('/{id}', [BackendController::class, 'showTraineeProfile'])->name('showTraineeProfile');

    //MARKED ALL STUDENTS AS ALUMNI
    Route::post('/markedStudentAsAlumni',[BackendController::class,'markedStudentAsAlumni'])->name('markedStudentAsAlumni');
    Route::post('/suspendAllStudents',[BackendController::class,'suspendAllStudents'])->name('suspendAllStudents');
    Route::post('/activateAllStudents',[BackendController::class,'activateAllStudents'])->name('activateAllStudents');

    Route::get('/downloadStudentPerClassPdf/{id}',[BackendController::class,'downloadStudentPerClassPdf'])->name('downloadStudentPerClassPdf');

    Route::get('/downloadAllTraineePerClassPdf/{id}',[BackendController::class,'downloadAllTraineePerClassPdf'])->name('downloadAllTraineePerClassPdf');
    Route::get('/downloadFormFourTraineePerClassPdf/{id}',[BackendController::class,'downloadFormFourTraineePerClassPdf'])->name('downloadFormFourTraineePerClassPdf');

    Route::get('/downloadLowerFormsTraineePerClassPdf/{id}',[BackendController::class,'downloadLowerFormsTraineePerClassPdf'])->name('downloadLowerFormsTraineePerClassPdf');
    

});


Route::prefix('courses')->group(function () {
    Route::get('/show', [BackendController::class, 'showCourses'])->name('showCourses');
    Route::get('/show/suspended', [BackendController::class, 'showSuspendedCourses'])->name('showSuspendedCourses');
    Route::get('/fetch-courses', [BackendController::class, 'fetchCourses'])->name('fetchCourses');
    Route::get('/fetch-suspended-courses', [BackendController::class, 'fetchSuspendedCourses'])->name('fetchSuspendedCourses');
    Route::get('/adminManageTraineePerCourse', [BackendController::class, 'adminManageTraineePerCourse'])->name('adminManageTraineePerCourse');
   
    Route::get('/fetch-student-per-course/{course_id}', [BackendController::class, 'fetchStudentPerCourse'])->name('fetchStudentPerCourse');
    Route::post('/add', [BackendController::class, 'addCourse'])->name('addCourse');
    Route::post('/update', [BackendController::class, 'updateCourse'])->name('updateCourse');
    Route::post('/delete', [BackendController::class, 'deleteCourse'])->name('deleteCourse');
    Route::post('/suspend', [BackendController::class, 'suspendCourse'])->name('suspendCourse');
    Route::post('/updateCourseImage', [BackendController::class, 'updateCourseImage'])->name('updateCourseImage');

   
});



Route::prefix('clases')->group(function () {
    Route::get('/show', [ClasController::class, 'index'])->name('showClases');
    Route::get('/show/suspended', [ClasController::class, 'showSuspendedClases'])->name('showSuspendedClases');
    Route::get('/fetch-clases', [ClasController::class, 'fetchClases'])->name('fetchClases');
    Route::get('/fetch-suspended-clases', [ClasController::class, 'fetchSuspendedClases'])->name('fetchSuspendedClases');
    Route::post('/add', [ClasController::class, 'addClas'])->name('addClas');
    Route::post('/update', [ClasController::class, 'updateClas'])->name('updateClas');
    Route::post('/delete', [ClasController::class, 'deleteClas'])->name('deleteClas');
     Route::post('/downloadFeeBalance', [ClasController::class, 'downloadFeeBalance'])->name('downloadFeeBalance');
    Route::post('/suspend', [ClasController::class, 'suspendClas'])->name('suspendClas');
    Route::get('/fetch-program', [ClasController::class, 'fetchPrograms'])->name('fetchPrograms');
    Route::get('/programs', [ClasController::class, 'adminManagePrograms'])->name('adminManagePrograms');
    Route::get('/classRoom', [ClasController::class, 'classRoom'])->name('classRoom');
    Route::post('/activate', [ClasController::class, 'activateClas'])->name('activateClas');
    Route::POST('/activate/all', [ClasController::class, 'activateAllClas'])->name('activateAllClas');
    Route::get('/get-students/{classId}', [BackendController::class, 'getStudents'])->name('getStudentsPerClass');
   // Route::get('/download-students-excel/{classId}', [ClasController::class, 'downloadStudentPerClassExcel'])->name('downloadStudentPerClassExcel');

    Route::post('/download-students-excel', [ClasController::class, 'downloadStudentPerClassExcel'])->name('downloadStudentPerClassExcel');

   
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
    Route::get('/showFormFourLeedPerSchool', [SchoolController::class, 'showFormFourLeedPerSchool'])->name('showFormFourLeedPerSchool');
    Route::get('/fetchFormFourLeedPerSchool/{classId}', [SchoolController::class, 'fetchFormFourLeedPerSchool'])->name('fetchFormFourLeedPerSchool');
    Route::post('/addScholarshipTestStudentPerSchool', [SchoolController::class, 'addScholarshipTestStudentPerSchool'])->name('addScholarshipTestStudentPerSchool');
    Route::post('/updateScholarshipTestStudentPerSchool', [SchoolController::class, 'updateScholarshipTestStudentPerSchool'])->name('updateScholarshipTestStudentPerSchool');

    Route::get('/highSchoolTeacherViewStudent',[SchoolController::class,'highSchoolTeacherViewStudent'])->name('highSchoolTeacherViewStudent');
    Route::get('/highSchoolTeacherFetchStudent',[SchoolController::class,'highSchoolTeacherFetchStudent'])->name('highSchoolTeacherFetchStudent');
    Route::post('/highSchoolTeacherEnrolStudent',[SchoolController::class,'highSchoolTeacherEnrolStudent'])->name('highSchoolTeacherEnrolStudent');
    Route::post('/highSchoolTeacherUpdateStudent',[SchoolController::class,'highSchoolTeacherUpdateStudent'])->name('highSchoolTeacherUpdateStudent');
    Route::get('/highSchoolTeacherViewingStudentTest',[SchoolController::class,'highSchoolTeacherViewingStudentTest'])->name('highSchoolTeacherViewingStudentTest');
    Route::get('/highSchoolTeacherFetchStudentTest',[SchoolController::class,'highSchoolTeacherFetchStudentTest'])->name('highSchoolTeacherFetchStudentTest');
    Route::get('/highSchoolTeacherViewTestAttemptPage',[SchoolController::class,'highSchoolTeacherViewTestAttemptPage'])->name('highSchoolTeacherViewTestAttemptPage');
    Route::get('/highSchoolTeacherFetchTestAttemptStudent',[SchoolController::class,'highSchoolTeacherFetchTestAttemptStudent'])->name('highSchoolTeacherFetchTestAttemptStudent');
    Route::get('/highSchoolTeacherDownloadStudentScholarshipLetter', [SchoolController::class, 'highSchoolTeacherDownloadStudentScholarshipLetter'])->name('highSchoolTeacherDownloadStudentScholarshipLetter');
});


Route::prefix('Leeds')->group(function () {
    Route::get('/show', [LeedController::class, 'index'])->name('showLeeds');
    Route::get('/fetch-leeds', [LeedController::class, 'fetchLeeds'])->name('fetchLeeds');
    Route::post('/add', [LeedController::class, 'addLeeds'])->name('addLeeds');
    Route::post('/update', [LeedController::class, 'updateLeeds'])->name('updateLeeds');
    Route::post('/delete', [LeedController::class, 'deleteLeeds'])->name('deleteLeeds');
    Route::post('/suspend', [LeedController::class, 'suspendLeeds'])->name('suspendLeeds'); 
    Route::get('/{id}/download-pdf', [LeedController::class, 'downloadShortCourseLetter'])->name('leeds.downloadShortCourseLetter');
});


Route::prefix('exams')->group(function () {
    Route::get('/show/assignment', [ExamController::class, 'index'])->name('showExams');
    Route::get('/fetch-assignments', [ExamController::class, 'fetchAssignments'])->name('fetchAssignments');
    Route::post('/add/assignment', [ExamController::class, 'addAssignment'])->name('addAssignment');

    Route::get('/show/cats', [ExamController::class, 'adminManageCats'])->name('adminManageCats');
    Route::get('/fetch-cats', [ExamController::class, 'fetchCats'])->name('fetchCats');


    Route::get('/show/finalExam', [ExamController::class, 'adminManageFinalExam'])->name('adminManageFinalExam');
    Route::get('/fetch-final-exam', [ExamController::class, 'fetchFinalExam'])->name('fetchFinalExam');


    Route::post('/update', [ExamController::class, 'updateExams'])->name('updateExams');
    Route::post('/delete', [ExamController::class, 'deleteExams'])->name('deleteExams');
    Route::post('/published', [ExamController::class, 'publishedExams'])->name('publishedExams');

    Route::post('/notpublished', [ExamController::class, 'notpublishedExams'])->name('notpublishedExams');

    Route::get('/showExamAttempts', [ExamController::class, 'showExamAttempts'])->name('showExamAttempts');
    Route::get('/showPracticalAttempts', [ExamController::class, 'showPracticalAttempts'])->name('showPracticalAttempts');
    Route::get('/fetchPracticalAttempts/{exam_id}', [ExamController::class, 'fetchPracticalAttempts'])->name('fetchPracticalAttempts');

    Route::get('/fetchExamAttempts/{exam_id}', [ExamController::class, 'fetchExamAttempts'])->name('fetchExamAttempts');

    Route::post('/adminAddStudentPracticalScore', [ExamController::class, 'adminAddStudentPracticalScore'])->name('adminAddStudentPracticalScore');
    Route::post('/adminDeleteStudentPracticalScore', [ExamController::class, 'adminDeleteStudentPracticalScore'])->name('adminDeleteStudentPracticalScore');
    Route::post('/adminUpdateStudentPracticalScore', [ExamController::class, 'adminUpdateStudentPracticalScore'])->name('adminUpdateStudentPracticalScore');
    Route::get('/downloadPracticalScore/{exam_id}', [ExamController::class, 'downloadPracticalScore'])->name('downloadPracticalScore');
    Route::get('/studentViewPracticalScore', [ExamController::class, 'studentViewPracticalScore'])->name('studentViewPracticalScore');

    Route::get('/studentFetchPracticalScore', [ExamController::class, 'studentFetchPracticalScore'])->name('studentFetchPracticalScore');

    Route::post('/studentUploadPracticalWork', [ExamController::class, 'studentUploadPracticalWork'])->name('studentUploadPracticalWork');





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

    
    Route::post('/update-social-links', [SettingController::class, 'updateCompanySocialLinks'])->name('updateCompanySocialLinks');
    Route::post('/update-mission-vision', [SettingController::class, 'updateCompanyMissionVision'])->name('updateCompanyMissionVision');
    Route::post('/update-company-details', [SettingController::class, 'updateCompanyDetails'])->name('updateCompanyDetails');


});


Route::prefix('fees')->group(function () {
    Route::get('/showFees', [FeeController::class, 'showFees'])->name('showFees');
    Route::post('/add', [FeeController::class, 'addFees'])->name('addFees');
    Route::post('/update', [FeeController::class, 'updateFees'])->name('updateFees');
    Route::post('/delete', [FeeController::class, 'deleteFees'])->name('deleteFees');
    
    //TRAINEE DOWNLOADING RECEIPT FOR HERSELF/HIMESELF
    Route::get('/downloadReceipt/{id}', [FeeController::class, 'downloadReceipt'])->name('downloadReceipt');

    //ADMIN DOWNLOAD RECEIPT FOR TRAINEE
    Route::get('/admindownloadReceipt/{id}', [FeeController::class, 'admindownloadReceipt'])->name('admindownloadReceipt');

    Route::get('/traineePrintingReceiptForRegistration', [FeeController::class, 'traineePrintingReceiptForRegistration'])->name('traineePrintingReceiptForRegistration');
});

Route::prefix('Applicants')->group(function () {
    Route::get('/show', [ApplicantController::class, 'index'])->name('showApplicants');
    Route::get('/fetch-applicants', [ApplicantController::class, 'fetchApplicants'])->name('fetchApplicants');
    Route::post('/markedAsPaidRegFee', [ApplicantController::class, 'markedAsPaidRegFee'])->name('markedAsPaidRegFee');
    
});



//WEBSITE CONTROLLER
Route::get('/about_us',[App\Http\Controllers\WebsiteController::class, 'about_us'])->name('about_us');
Route::get('/all_courses',[App\Http\Controllers\WebsiteController::class, 'all_courses'])->name('all_courses');
Route::get('/apply',[App\Http\Controllers\WebsiteController::class, 'apply'])->name('apply');
Route::get('/digital-hustle',[App\Http\Controllers\WebsiteController::class, 'digitalHustle'])->name('digitalHustle');

Route::get('/data-science',[App\Http\Controllers\WebsiteController::class, 'dataScience'])->name('dataScience');
Route::get('/android-application',[App\Http\Controllers\WebsiteController::class, 'androidApplication'])->name('androidApplication');
Route::get('/web-application',[App\Http\Controllers\WebsiteController::class, 'webApplication'])->name('webApplication');
Route::get('/digital-marketing',[App\Http\Controllers\WebsiteController::class, 'digitalMarketing'])->name('digitalMarketing');
Route::get('/cyber-security',[App\Http\Controllers\WebsiteController::class, 'cyberSecurity'])->name('cyberSecurity');
Route::get('/graphic-design',[App\Http\Controllers\WebsiteController::class, 'graphicDesign'])->name('graphicDesign');
Route::get('/software-engineering',[App\Http\Controllers\WebsiteController::class, 'softwareEngineering'])->name('softwareEngineering');

Route::get('/data-analysis',[App\Http\Controllers\WebsiteController::class, 'dataAnalysis'])->name('dataAnalysis');

Route::get('/about',[App\Http\Controllers\WebsiteController::class, 'aboutUs'])->name('aboutUs');
Route::get('/corporate-training',[App\Http\Controllers\WebsiteController::class, 'corporateTraining'])->name('corporateTraining');
Route::get('/indistrial-attachment',[App\Http\Controllers\WebsiteController::class, 'industrialAttachment'])->name('industrialAttachment');
Route::get('/ict-hub',[App\Http\Controllers\WebsiteController::class, 'ictHub'])->name('ictHub');


Route::get('/enrol',[App\Http\Controllers\WebsiteController::class, 'enrol'])->name('enrol');

Route::post('/contact-us/create',[App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');




//NEW WEBSITE CONTROLLER
Route::get('/course/signup/{id}',[WebsiteController::class,'signup'])->name('pages.signup');
Route::get('/course/show/{id}',[WebsiteController::class,'showSingleCourse'])->name('showSingleCourse');
Route::get('/Courses',[WebsiteController::class,'showAllCourses'])->name('showAllCourses');
Route::get('/contact-us',[WebsiteController::class, 'contactUs'])->name('contactUs');
Route::get('/about-us',[WebsiteController::class, 'aboutUs'])->name('aboutUs');
Route::post('sendContactMessage',[WebsiteController::class,'sendContactMessage'])->name('sendContactMessage');
Route::get('/showContactMessages',[WebsiteController::class,'showContactMessages'])->name('showContactMessages');
Route::get('/enrol_for_scholarship_test',[WebsiteController::class,'enrol_for_scholarship_test'])->name('enrol_for_scholarship_test');
Route::get('/showScholarshipTest',[WebsiteController::class,'showScholarshipTest'])->name('showScholarshipTest');
Route::get('/showFormFourScholarshipLetter',[WebsiteController::class,'showFormFourScholarshipLetter'])->name('showFormFourScholarshipLetter');
Route::get('/applicantDownloadAdmissionLetter',[WebsiteController::class,'applicantDownloadAdmissionLetter'])->name('applicantDownloadAdmissionLetter');
Route::get('/applicantAdmissionLetter',[WebsiteController::class,'applicantAdmissionLetter'])->name('applicantAdmissionLetter');
Route::get('/adminDownloadAdmissionLetter',[WebsiteController::class,'adminDownloadAdmissionLetter'])->name('adminDownloadAdmissionLetter');


//SCHOLARSHIP LETTERS
Route::get('/adminManageFormFourScholarshipLetters',[ScholarshipLetterController::class,'adminManageFormFourScholarshipLetters'])->name('adminManageFormFourScholarshipLetter');
Route::post('/adminAddFormFourScholarshipLetters',[ScholarshipLetterController::class,'adminAddFormFourScholarshipLetters'])->name('adminAddFormFourScholarshipLetters');
Route::post('/adminUpdateFormFourScholarshipLetters',[ScholarshipLetterController::class,'adminUpdateFormFourScholarshipLetters'])->name('adminUpdateFormFourScholarshipLetters');
Route::post('/adminDeleteFormFourScholarshipLetters',[ScholarshipLetterController::class,'adminDeleteFormFourScholarshipLetters'])->name('adminDeleteFormFourScholarshipLetters');
Route::get('/studentDownloadFormFourScholarshipLetter/{id}',[ScholarshipLetterController::class,'studentDownloadFormFourScholarshipLetter'])->name('studentDownloadFormFourScholarshipLetter');






//SCHOLARSHIPTESTCOURSES
Route::get('/adminManageScholarshipTestCourse',[ScholarshipTestCourseController::class,'adminManageScholarshipTestCourse'])->name('adminManageScholarshipTestCourse');
Route::post('/adminAddScholarshipTestCourse',[ScholarshipTestCourseController::class,'adminAddScholarshipTestCourse'])->name('adminAddScholarshipTestCourse');
Route::get('/fetchScholarshipTestCourses',[ScholarshipTestCourseController::class,'fetchScholarshipTestCourses'])->name('fetchScholarshipTestCourses');



//JISTI MEETING
Route::prefix('jitsi-meeting')->group(function (){
    Route::get('show-jitsi-meeting-per-class',[JitsiMeetingController::class,'showJitsiMeetingPerClas'])->name('showJitsiMeetingPerClas');
    Route::post('create-jitsi-meeting-per-class',[JitsiMeetingController::class,'createJitsiMeetingPerClas'])->name('createJitsiMeetingPerClas');
    Route::post('update-jitsi-meeting-per-class',[JitsiMeetingController::class,'updateJitsiMeetingPerClas'])->name('updateJitsiMeetingPerClas');
    Route::post('delete-jitsi-meeting-per-class',[JitsiMeetingController::class,'deleteJitsiMeetingPerClas'])->name('deleteJitsiMeetingPerClas');
    Route::post('suspend-jitsi-meeting-per-class',[JitsiMeetingController::class,'suspendJitsiMeetingPerClas'])->name('suspendJitsiMeetingPerClas');
    Route::post('activate-jitsi-meeting-per-class',[JitsiMeetingController::class,'activateJitsiMeetingPerClas'])->name('activateJitsiMeetingPerClas');
    Route::get('fetch-jitsi-meeting-per-class/{classId}',[JitsiMeetingController::class,'fetchJitsiMeetingPerClas'])->name('fetchJitsiMeetingPerClas');
    Route::get('join-jitsi-meeting-per-class',[JitsiMeetingController::class,'joinJitsiMeetingPerClas'])->name('joinJitsiMeetingPerClas');
});





//PRACTICALS
Route::get('/managePracticals',[ClasController::class,'showPracticalPerClas'])->name('showPracticalPerClas');
Route::post('/addPracticalPerClas',[ClasController::class,'addPracticalPerClas'])->name('addPracticalPerClas');
Route::post('/updatePracticalQuestion',[ClasController::class,'updatePracticalQuestion'])->name('updatePracticalQuestion');






Route::get('/create-meeting', [GoogleMeetController::class, 'createMeeting']);
Route::get('/join-meeting/{meetingId}', [GoogleMeetController::class, 'joinMeeting']);

//ROUTE FOR SMS
Route::get('/sms',[SmsController::class,'sms'])->name('sms');
Route::get('/mpesa',[MpesaController::class,'mpesa'])->name('mpesa');
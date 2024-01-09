<?php

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
Route::get('/',\General\IndexController::class."@homepage")->name('homepage');
Route::get('/message/{id}', \General\ChatController::class."@getMessage")->name('message');
Route::post('messages', \General\ChatController::class."@sendMessage")->name('sendMessage');
Route::get('/message',\General\ChatController::class."@index")->name('liveChat');
Route::get('/edit',\General\indexcontroller::class."@edit")->name('edit');

Route::get('supervisor',\General\StudentAuth::class."@mySupervisor")->name('mySupervisor');
Route::get('supervisor/{id}',\General\ChatController::class."@userGetMessage")->name('user.message');
Route::post('user/messages', \General\ChatController::class."@userSendMessage")->name('user.sendMessage');


Route::get('/pending/user',\Admin\GuestAdmin::class."@pendingLecturer")->name('pending');
Route::prefix('students')->group(function(){
    Route::get('login',\General\GuestController::class."@login")->name('login');
    Route::post('login',\General\GuestController::class."@createLogin");
    Route::get('register',\General\GuestController::class."@showRegister")->name('user.register');
    Route::post('register',\General\GuestController::class."@createRegister");

    Route::get('contactUs',\General\IndexController::class."@contact")->name('contact');
    Route::post('contactUs',\General\IndexController::class."@createContact");
    Route::get('about',\General\IndexController::class."@about")->name('about');
    Route::get('gallery',\General\IndexController::class."@gallery")->name('user.gallery');

    Route::get('profile',\General\StudentAuth::class."@profile")->name('user.profile');
    Route::post('profile',\General\StudentAuth::class."@createProfile");
    Route::get('projects',\General\StudentAuth::class."@projects")->name('user.projects');
    Route::get('request/supervisor{id}',\General\StudentAuth::class."@requestSupervisor")->name('requestSupervisor');
    Route::get('request/topic{id}',\General\StudentAuth::class."@requestTopic")->name('requestTopic');
    Route::get('/search/',\General\StudentAuth::class."@search")->name('search');

//    Route::get('/home', '\General\ChatController@index')->name('home');


    Route::get('logout',\General\GuestController::class."@logout")->name('user.logout');
});
Route::prefix('Admin')->group(function(){
    Route::get('/',\Admin\GuestAdmin::class."@show")->name('admin.login');
    Route::get('/dashboard',\Admin\AdminAuth::class."@dashboard")->name('dashboard');

    Route::post('/',\Admin\GuestAdmin::class."@create");

    Route::get('/register',\Admin\GuestAdmin::class."@register")->name('admin.register');
    Route::post('/register',\Admin\GuestAdmin::class."@CreateRegister");
//    Route::get('/pending/lecturer',\Admin\GuestAdmin::class."@pendingLecturer")->name('pending');


    Route::get('/logout/',\Admin\GuestAdmin::class."@logout")->name('admin.logout');

    Route::get('/update/profile/',\Admin\AdminAuth::class."@getProfile")->name('admin.profile');

    Route::post('/update/profile/',\Admin\AdminAuth::class."@adminProfileUpdate");

    Route::get('/slideshow/',\Admin\AdminAuth::class."@getSlide")->name('slide');

    Route::post('/slideshow/',\Admin\AdminAuth::class."@createSlide");

    Route::get('/delete/slideshow/{id}',\Admin\AdminAuth::class."@deleteSlide")->name('deleteSlide');

    Route::get('/slideshow/record',\Admin\AdminAuth::class."@slideRecord")->name('slideRecord');


    Route::get('allocate',\Admin\AdminAuth::class."@allocate")->name('allocate');

    Route::post('allocator',\Admin\AdminAuth::class."@createAllocation")->name('allocator');

    Route::get('allocated',\Admin\AdminAuth::class."@getAllocatedStudents")->name('allocated');

    Route::get('students',\Admin\AdminAuth::class."@showStudent")->name('student');

    Route::get('lecturers',\Admin\AdminAuth::class."@showLecturer")->name('lecturer');

    Route::get('/delete/lecturers{delete}',\Admin\AdminAuth::class."@deleteLecturer")->name('deleteLecturer');

    Route::get('/delete/students{delete}',\Admin\AdminAuth::class."@deleteStudent")->name('deleteStudent');

    Route::get('/verify/lecturers{verify}',\Admin\AdminAuth::class."@verifyLecturer")->name('verifyLecturer');

    Route::get('/verify/students{verify}',\Admin\AdminAuth::class."@verifyStudent")->name('verifyStudent');

    Route::get('my students',\Admin\AdminAuth::class."@myStudents")->name('myStudents');

    Route::get('messages',\Admin\AdminAuth::class."@messages")->name('messages');

    Route::post('messages',\Admin\AdminAuth::class."@messages");

    Route::get('gallery',\Admin\AdminAuth::class."@showGallery")->name('gallery');
    Route::post('gallery',\Admin\AdminAuth::class."@createGallery");
    Route::get('delete/image{id}',\Admin\AdminAuth::class."@deleteImage")->name('deleteImage');


    Route::get('all/messages',\Admin\AdminAuth::class."@allMessages")->name('allMessages');

    Route::get('messages{attended}',\Admin\AdminAuth::class."@attendToMessage")->name('attended');

    Route::get('projects',\Admin\AdminAuth::class."@project")->name('project');
    Route::post('projects',\Admin\AdminAuth::class."@createProject");
    Route::get('all/Projects',\Admin\AdminAuth::class."@allProjects")->name('allProjects');
    Route::get('my-uploaded/Projects',\Admin\AdminAuth::class."@myProjects")->name('myProjects');
    Route::get('delete/my-uploaded/Projects{id}',\Admin\AdminAuth::class."@deleteProject")->name('deleteProject');
    Route::post('update/Projects{id}',\Admin\AdminAuth::class."@updateProject")->name('updateProject');
    Route::get('all/Projects{delete}',\Admin\AdminAuth::class."@deleteTopic")->name('deleteTopic');
    Route::get('accept/Student{id}',\Admin\AdminAuth::class."@acceptRequest")->name('acceptRequest');
    Route::get('reject/student{id}',\Admin\AdminAuth::class."@rejectRequest")->name('rejectRequest');
    Route::get('accept/allocate/Student{id}',\Admin\AdminAuth::class."@approveAndAllocate")->name('approveAndAllocate');
    Route::get('reject/allocate/student{id}',\Admin\AdminAuth::class."@rejectAllocation")->name('rejectAllocation');

    Route::get('students/logs',\Admin\AdminAuth::class."@studentsLog")->name('slogs');

    Route::get('lecturers/logs',\Admin\AdminAuth::class."@lecturersLog")->name('alogs');


});



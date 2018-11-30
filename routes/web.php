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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'ProjectController@index')->name('home');


Route::get('/projects', 'ProjectController@index');
Route::post('/projects', 'ProjectController@store');
Route::get('/projects/create', 'ProjectController@create');
Route::get('/projects/{project}', 'ProjectController@show');
Route::delete('/projects/{project}', 'ProjectController@delete');

Route::get('/tasks', 'TaskController@index');
Route::post('/projects/{project}/tasks', 'TaskController@store');
Route::get('/tasks/{task}', 'TaskController@show');
Route::patch('/tasks/{task}', 'TaskController@update');
Route::post('/tasks/{task}/notes', 'NoteController@store');

Route::get('/tasks/{task}/issues/{issue}', 'IssueController@show');
Route::get('/issues/{task}/create', 'IssueController@create');
Route::get('/tasks/{task}/issues', 'IssueController@index');
Route::post('/tasks/{task}/issues', 'IssueController@store');
Route::get('/task/create/{project}', 'TaskController@createTask'); // Created By Employee

Route::post('/issues/{issue}/comments', 'CommentController@create');
Route::patch('/issues/{issue}', 'IssueController@update');

Route::delete('/comments/{comment}', 'CommentController@delete');

Route::get('/register', 'RegistrationController@create')->name('register');
Route::post('/register', 'RegistrationController@store');
Route::get('/login', 'SessionController@create')->name('login');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');



Route::get('/users', 'UserController@create');
Route::get('/users/{user}', 'UserController@show');
Route::patch('/users/{user}', 'UserController@update');
Route::get('/users/{user}/edit', 'UserController@edit');
Route::get('/search', 'UserController@search');

Route::get('/password', 'PasswordController@index');
Route::post('/password/reset', 'PasswordController@reset');	
Route::get('/notifications/read', 'NotificationController@index');
Route::get('issue/notifications/read/{id}/{task_id}', 'NotificationController@updateIssue');
Route::get('comment/notifications/read/{id}/{issue_id}/{task_id}', 'NotificationController@updateComment');
Route::get('/notifications/read/{notification}', 'NotificationController@update');

Route::get('/reminders', 'ReminderController@index');
Route::post('/users/{user}/reminders', 'ReminderController@create');
Route::patch('/reminders/{id}/done', 'ReminderController@update');
Route::post('/reminders/{id}/strike', 'ReminderController@strikeStatus');
Route::post('/reminders/{id}/unstrike', 'ReminderController@unstrikeStatus');
Route::get('/reminders/done', 'ReminderController@completedReminders');

Route::get('/appointment', 'AppointmentController@index');
Route::post('/users/{user}/appointment', 'AppointmentController@create');
Route::patch('/appointment/{id}/done', 'AppointmentController@update');
Route::post('/appointment/{id}/strike', 'AppointmentController@strikeStatus');
Route::post('/appointment/{id}/unstrike', 'AppointmentController@unstrikeStatus');
Route::get('/appointments/done', 'AppointmentController@completedAppointments');

Route::get('/forgotPassword', 'ForgotPasswordController@index');
// Route::get('/appointment', 'AppointmentController@index');
Route::post('/users/{user}/forgotPassword', 'ForgotPasswordController@create');
Route::patch('/forgotPassword/{id}/done', 'ForgotPasswordController@update');
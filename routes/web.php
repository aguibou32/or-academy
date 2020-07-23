<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\RegistrationMail;
 
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

    // The web page routes 
Route::get('/', 'PagesController@welcome')->name('pages.welcome');
Route::get('/about', 'PagesController@about')->name('pages.about');
Route::get('/team', 'PagesController@team')->name('pages.ourteam');

// Routes for adding a course on the website
Route::resource('courses', 'WebsiteCoursesController'); // This maps all the ressources functions to its actual routes (create, update, delete)
   

// Routes for the application
Route::resource('application', 'ApplicationsController');

// Routes for the modules
Route::resource('module', 'ModulesController');

// add or detach students 
Route::get('attach_students/{id}', 'ModulesController@attach_student')->name('attach_student_view');
Route::get('detach_students/{id}', 'ModulesController@detach_student')->name('detach_student_view');
Route::get('attach/{id}', 'ModulesController@attach')->name('attach');
Route::get('detach/{id}', 'ModulesController@detach')->name('detach'); // In case you want to detach 

// Notices route
Route::resource('notices', 'ModuleNoticesController');

// Notes route
Route::resource('notes', 'ModuleNotesController');
// practicals routes
Route::resource('practicals', 'PracticalsController');
Route::resource('practical_submission', 'PracticalsSubmissionController');

Route::get('add_practical_marks_view/{id}', 'PracticalsController@add_practical_marks_view')->name('add_practical_marks_view');


Route::resource('users', 'UsersController');
Route::resource('general_notice', 'GeneralNoticesController');

Route::resource('callback', 'RequestCallBackController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


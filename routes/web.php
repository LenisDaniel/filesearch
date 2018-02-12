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
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    if(!Auth::user())    {
        return view('auth/login');
    }

});

Auth::routes();

//Maintenance Insert Routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
Route::post('/departments_insert', 'DepartmentsController@store')->name('departments_insert');
Route::post('/cities_insert', 'CitiesController@store')->name('cities_insert');
Route::post('/locations_insert', 'LocationsController@store')->name('locations_insert');
Route::post('/archives_insert', 'ArchivesController@store')->name('archives_insert');
Route::post('/boxes_insert', 'BoxesController@store')->name('boxes_insert');
Route::post('/storing_record', 'StoringsController@store')->name('storing_record');



Route::get('/departments', 'DepartmentsController@index')->name('departments');
Route::get('/cities', 'CitiesController@index')->name('cities');
Route::get('/locations', 'LocationsController@index')->name('locations');
Route::get('/archives', 'ArchivesController@index')->name('archives');
Route::get('/boxes', 'BoxesController@index')->name('boxes');
Route::get('/storing', 'StoringsController@index')->name('storing');

//Ajax
Route::post('/remove_departments_records', 'DepartmentsController@remove_records')->name('remove_departments_records');
Route::post('/remove_locations_records', 'LocationsController@remove_records')->name('remove_locations_records');
Route::post('/remove_archives_records', 'ArchivesController@remove_records')->name('remove_archives_records');
Route::post('/remove_boxes_records', 'BoxesController@remove_records')->name('remove_boxes_records');
Route::post('/remove_cities_records', 'CitiesController@remove_records')->name('remove_cities_records');
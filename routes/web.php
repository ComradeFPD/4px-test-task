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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => '/departments'], function (){
    Route::get('/', 'DepartmentController@all')->name('departments.all');
    Route::get('/add', 'DepartmentController@createForm')->name('departments.add-form');
    Route::post('/add', 'DepartmentController@createDepartment')->name('departments.create');
    Route::get('/update/{id}', 'DepartmentController@updateForm')->name('departments.update-form');
    Route::post('/update', 'DepartmentController@updateDepartment')->name('departments.update');
    Route::get('/delete/{id}', 'DepartmentController@deleteDepartment');
});
Route::group(['prefix' => '/users'], function (){
    Route::get('/', 'UserController@all')->name('users.all');
    Route::get('/add', 'UserController@createForm')->name('users.add-form');
    Route::post('/add', 'UserController@createUser')->name('users.create');
    Route::get('/update/{id}', 'UserController@updateForm')->name('users.update-form');
    Route::post('/update', 'UserController@updateUser')->name('users.update');
    Route::get('/delete/{id}', 'UserController@deleteUser');
});

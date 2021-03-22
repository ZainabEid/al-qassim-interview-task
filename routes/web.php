<?php

use Illuminate\Support\Facades\Route;

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


// project Routes
Route::get('/projects/index','ProjectController@index')->name('projects.index');
Route::post('/projects/add/{project}','ProjectController@add')->name('projects.add');

// task Routes
Route::post('/task/add','TaskController@add')->name('task.add');
Route::post('/task/{task}','TaskController@changeStatus')->name('task.change-status');

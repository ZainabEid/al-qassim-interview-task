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

Route::get('/', 'ProjectController@index')->name('projects');


// project Routes
Route::get('/projects', 'ProjectController@index')->name('projects');
Route::get('/projects/create', 'ProjectController@create')->name('projects.create');
Route::post('/projects/store', 'ProjectController@store')->name('projects.store');

// task Routes
Route::post('/task/add/{project}', 'TaskController@add')->name('task.add');
Route::get('/task/change-status/{task}', 'TaskController@changeStatus')->name('task.change-status');

<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/projects/show/{project}', 'ProjectController@show')->name('projects.show');

// task Routes
Route::get('/task/form/{project}', 'TaskController@addTaskForm')->name('task.add-task-form');
Route::get('/task/store/{project}', 'TaskController@store')->name('task.store');
Route::get('/task/change-status/{task}', 'TaskController@changeStatus')->name('task.change-status');

Route::get('/calculate-percentage/{project_id}', function ($project_id) {
    return calculatePercentage($project_id); // helper function
})->name('calculate-percentage');

Auth::routes();


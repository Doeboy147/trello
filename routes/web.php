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

Route::post('/add-task', 'Task@saveTask');
Route::get('/get-task/{state}', 'Task@Tasks');

Route::get('/get-tasks', 'Task@getTasks');
Route::get('/delete-task/{id}', 'Task@destroy');
Route::get('/change-state/{state}/{uuid}', 'Task@changeState');

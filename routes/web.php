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

// Render the Homepage
Route::get('/', 'CommentsController@index');

// GET request to get a JSON list of all the comments
Route::get('/comments/all', 'CommentsController@all');

// POST request to save a new comment
Route::post('/comments/save', 'CommentsController@save');


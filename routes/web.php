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
    return view('home');
});

//Route for Comment Posting
Route::post('/comment/post', [
 'uses' => 'CommentController@post',
 'as' => 'addComment'
]);

//Route for Reply Posting
Route::post('/reply/post', [
 'uses' => 'CommentController@postReply',
 'as' => 'addReply'
]);

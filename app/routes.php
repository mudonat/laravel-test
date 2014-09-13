<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@listPosts');
Route::get('show/{id}', 'HomeController@showPost')->where(array('id'=>'[0-9]+'));
Route::get('users',array('before'=>'auth', 'uses'=>'UsersController@index'));

Route::get('login', 'HomeController@loginShow');
Route::post('login', 'HomeController@loginDo');
Route::post('add-comment/{postId}', array('as'=>'add-comment', 'before'=>'csrf', 'uses'=>'HomeController@addComment'))->where(array('postId'=>'[0-9]+'));

Route::group(array('before'=>'auth'), function(){
	Route::any('admin', function(){
		return Redirect::to('admin/posts');
	});
	
	Route::any('logout', function(){
		Auth::logout();
		return Redirect::to('/');
	});
	
	Route::get('admin/posts', array('uses'=>'PostAdminController@index'));
	Route::get('admin/posts/create', array('uses'=>'PostAdminController@createShow'));
	Route::post('admin/posts/create', array('uses'=>'PostAdminController@createDo'));
	Route::get('admin/posts/edit/{id}', array('uses'=>'PostAdminController@editShow'))->where(array('id'=>'[0-9]+'));
	Route::post('admin/posts/edit/{id}', array('uses'=>'PostAdminController@editDo'))->where(array('id'=>'[0-9]+'));
	Route::get('admin/posts/delete/{id}', array('uses'=>'PostAdminController@delete'))->where(array('id'=>'[0-9]+'));
});
<?php

Auth::routes();
Route::get('/', 'UserPostsController@index');
Route::get('/user_posts/{id}', 'UserPostsController@show')->name('user_posts_show');
Route::post('/user_posts/{post}/', 'CommentController@store')->name('make_comm');

Route::prefix('manage')->middleware('role:superadministrator|administrator|editor|author')->group(function(){
	Route::get('/', 'ManageController@index');
	Route::get('/dashboard', 'ManageController@dashboard')->name('manage.dashboard');
	Route::resource('/users', 'UserController');
	Route::resource('/profile', 'ProfileController');
	Route::post('/users/{id}/destroy', 'UserController@destroy')->name('destroy_user');
	Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
	Route::post('/permissions/{id}/destroy', 'PermissionController@destroy')->name('destroy_permission');
	Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
	Route::post('/roles/{id}/destroy', 'RoleController@destroy')->name('destroy_role');
	Route::resource('/posts', 'PostController');
	Route::post('/posts/{id}/destroy', 'PostController@destroy')->name('destroy_post');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

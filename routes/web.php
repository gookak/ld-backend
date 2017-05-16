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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/', function(){
	return view('index');
});

Route::resource('category', 'CategoryController');

Route::resource('product', 'ProductController');

Route::get('/fileupload', 'FileuploadController@index');

// Route::get('/show', 'FileuploadController@show');

Route::post('/fileupload', 'FileuploadController@upload');

Route::post('/fileupload/{id}', 'FileuploadController@destroy');

Route::get('/apigetfileupload', 'ApiController@apigetfileupload');



//Admin Login
Route::GET('admin/home', 'AdminController@index');

Route::GET('admin/employee', 'EmployeeController@index');

Route::GET('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin', 'Admin\LoginController@login');
// Route::POST('logout', 'AdminLoginController@logout');
Route::POST('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST('admin-password/reset', 'Admin\ResetPasswordController@reset');
Route::GET('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');


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


// Route::get('/', function () {
// 	return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/admin', 'AdminController@index')->name('admin');


Auth::routes();

// Route::get('/', function () {
// 	return view('welcome');
// });

Route::get('/', function () {
	return Redirect::action('Auth\LoginController@showLoginForm');
});

Route::get('/error500', function(){
	return view('otherpage.error500');
});

Route::get('/error404', function(){
	return view('otherpage.error404');
});

Route::get('/dashboard', 'DashboardController@index');

Route::resource('category', 'CategoryController');

Route::resource('product', 'ProductController');

Route::resource('purchaseorder', 'PurchaseOrderController');

// // Route::get('/show', 'FileuploadController@show');

Route::get('/fileupload', 'FileuploadController@index');

Route::post('/fileupload', 'FileuploadController@upload');

Route::post('/fileupload/{id}', 'FileuploadController@destroy');

Route::get('/apigetfileupload', 'ApiController@apigetfileupload');

Route::get('/apigetpercentpricebycategorys', 'ApiController@apigetpercentpricebycategorys');

Route::get('/apigetproductname/{name}', 'ApiController@apigetproductname');

Route::resource('adminuser', 'AdminUserController');

Route::resource('user', 'UserController');

Route::resource('order', 'OrderController');

Route::get('order/{id}/pdf', 'OrderController@pdf');

Route::get('/report', 'ReportController@index');

Route::post('/report/salesbycategory', 'ReportController@salesbycategory');

Route::post('/report/salesbyproduct', 'ReportController@salesbyproduct');

Route::post('/report/balancebyproduct', 'ReportController@balancebyproduct');

Route::post('/report/employee', 'ReportController@employee');










// //Admin Login
// Route::GET('admin/home', 'AdminController@index');
// Route::GET('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
// Route::POST('admin', 'Admin\LoginController@login');
// // Route::POST('logout', 'AdminLoginController@logout');
// Route::POST('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
// Route::GET('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
// Route::POST('admin-password/reset', 'Admin\ResetPasswordController@reset');
// Route::GET('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');


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
//     return view('welcome');
// });
Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/services', 'HomeController@services');
Route::get('/media', 'HomeController@media');
// Route::get('/media-details/{post}', 'HomeController@mediadetails');
Route::get('/contact', 'HomeController@contact');
Route::get('/anita-anand', 'HomeController@anitaanand');
Route::get('/mahesh-uppal', 'HomeController@maheshuppal');


// media
Route::get('admin/media', 'Admin\MediaController@index')->name('admin.media');
Route::get('admin/media/create', 'Admin\MediaController@createForm')->name('admin.media.create');
Route::post('admin/media/create', 'Admin\MediaController@create');
Route::get('admin/media/read/{media}', 'Admin\MediaController@read')->name('admin.media.read');
Route::get('admin/media/update/{media}', 'Admin\MediaController@updateForm')->name('admin.media.update');
Route::patch('admin/media/update/{media}', 'Admin\MediaController@update');
Route::delete('admin/media/delete/{media}', 'Admin\MediaController@delete')->name('admin.media.delete');

Route::post('send-mail', 'MailController@sendmail')->name('mail');
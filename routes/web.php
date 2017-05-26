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

// @AppController
Route::post('app/token', 'AppController@token')->name('app.token');

// @FileController
Route::get('files', 'FileController@index')->name('file.index');
Route::get('download/{uuid}', 'FileController@download')->name('file.download');
Route::get('me', 'FileController@me')->name('file.me')->middleware('auth');
Route::delete('delete/{uuid}', 'FileController@delete')->name('file.delete');
Route::get('file/{uuid}', 'FileController@view')->name('file.view');

// @PasswordController
Route::get('password/{uuid}', 'PasswordController@form')->name('password.form');
Route::post('password/{uuid}', 'PasswordController@confirm')->name('password.confirm');
Route::get('password/setup/{uuid}', 'PasswordController@setupForm')->name('password.setupForm');
Route::put('password/setup/{uuid}', 'PasswordController@setup')->name('password.setup');
Route::get('password/remove/{uuid}', 'PasswordController@remove')->name('password.remove')->middleware('auth');

// @UploadController
Route::get('', 'UploadController@form')->name('upload.form');
Route::post('upload', 'UploadController@upload')->name('upload.upload');
Route::post('upload/save', 'UploadController@save')->name('upload.save');
Route::post('upload/size', 'UploadController@size')->name('upload.size');
Route::post('upload/expiration', 'UploadController@expiration')->name('upload.expiration');

// @File\ReportController
Route::group(['namespace' => 'File', 'as' => 'report.'], function () {
    Route::get('reports', 'ReportController@index')->name('index')->middleware('auth');
    Route::post('report/{uuid}', 'ReportController@submit')->name('submit');
});

Route::get('rules', 'PageController@rule')->name('page.rule');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

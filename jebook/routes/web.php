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

// 前台模块路由
Route::get('/','IndexController@welcome');
Route::get('log.html','IndexController@log');
Route::get('article/info','ArticleController@info');
Route::get('article/edit','ArticleController@edit');
Route::post('article/save','ArticleController@save');
Route::post('book/save','BookController@save');
Route::get('book/create.html','BookController@create');
Route::any('login.html','LoginController@login');
Route::any('register.html','LoginController@register');
Route::any('logout.html','LoginController@logout');
Route::any('personalCenter.html','UserController@personalCenter');
Route::any('verifyUser.html','LoginController@verifyUser');
Route::any('chapter.html','UserController@chapter');

Route::any('/user/booklist.html','UserController@bookList');
Route::any('/signin.html','UserController@signIn');
Route::post('/isPublic.html','UserController@isPublic');
Route::get('/case.html','IndexController@jeCase');
Route::get('/contact.html','IndexController@contactUs');
Route::get('/about.html','IndexController@about');
Route::post('/contact/add','IndexController@add');
Route::get('/news.html','IndexController@news');
Route::get('/details.html','IndexController@details');

// 后台模块路由
Route::any('admin/login.html','Admin\LoginController@login');
Route::get('admin/logout.html','Admin\LoginController@logout');
Route::get('admin.html','Admin\IndexController@index');
Route::get('admin/welcome','Admin\IndexController@welcome');
Route::get('admin/book/list','Admin\BookController@lst');
Route::post('/admin/book/audit','Admin\BookController@audit');
Route::get('/admin/book/auditview/{id}','Admin\BookController@auditview')->where('id', '[0-9]+');
Route::get('/admin/user/list','Admin\UserController@lst');
Route::post('/admin/user/setUserStatus','Admin\UserController@setUserStatus');
Route::any('/admin/book/info','Admin\BookController@info');
Route::any('/admin/log','Admin\LogController@lst');
Route::any('/admin/black/lst','Admin\BlackIpController@lst');
Route::any('/admin/black/add','Admin\BlackIpController@add');
Route::any('/admin/black/del','Admin\BlackIpController@del');
Route::get('/admin/contact/lst','Admin\ContactController@lst');
Route::post('/admin/contact/del','Admin\ContactController@del');
Route::any('/admin/contact/reply','Admin\ContactController@reply');
Route::any('/admin/contact/audit','Admin\ContactController@audit');

Route::get('/mail/send','MailController@send');
Route::get('/user/activatemail','LoginController@verify');







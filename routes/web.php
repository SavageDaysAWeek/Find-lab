<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/auth', 'HomeController@auth');
Auth::routes();
Route::get('/register', function () {
    return redirect('/login');
});


Route::get('/', 'DocController@index');
Route::get('/docs', 'DocController@docs');
Route::get('/orders', 'DocController@orders');
Route::get('/doc/{id}', 'DocController@doc');
Route::post('/search-doc', 'DocController@search');

Route::any('/bot', 'BotController@message');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/add', function () {
        return view('add', ['type' => 0]);
    });
    Route::get('/order', function () {
        return view('add', ['type' => 1]);
    });
    Route::get('/profile', 'HomeController@profile');
    Route::get('/ad/{id}_{hash}', 'AdController@success');

    Route::post('/add', 'DocController@add');
    Route::post('/set-bill', 'HomeController@setBill');
    Route::post('/change-password', 'HomeController@changePassword');
    Route::post('/set-private', 'HomeController@setPrivate');
    Route::post('/new-ad', 'AdController@new');
    Route::post('/delete-doc', 'DocController@delete');
    Route::post('/notify', 'NotifyController@notify');
});
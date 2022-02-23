<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('index');
});
Route::get('/login', 'AuthController@login')->name('login')->middleware('guest');
Route::post('/login', 'AuthController@store')->name('login.store');
Route::post('logout', 'AuthController@logout')->name('logout');

//Route Dashboard
Route::prefix('dashboard')->middleware('auth')->group(function ()
{
    Route::get('/', 'PagesController@dashboard')->name('dashboard');

    //Route Mata Pelajaran
    Route::prefix('pelajaran')->group(function ()
    {
        Route::get('/', 'SubjectController@index')->name('pelajaran');
        Route::post('/store', 'SubjectController@store')->name('pelajaran.store');
        Route::patch('/update/{id}', 'SubjectController@update')->name('pelajaran.update');
    });
});

Route::prefix('grup-kelas')->middleware('auth')->group(function ()
{
    Route::get('/', 'GroupClassController@index')->name('grup');
});

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

    //Route Mata Pelajaran
    Route::prefix('ruangan')->group(function ()
    {
        Route::get('/', 'RoomController@index')->name('ruangan');
        Route::post('/store', 'RoomController@store')->name('ruangan.store');
        Route::patch('/update/{id}', 'RoomController@update')->name('ruangan.update');
    });

    //Route Mata Pelajaran
    Route::prefix('tingkat-kelas')->group(function ()
    {
        Route::get('/', 'ClassLevelController@index')->name('tingkat-kelas');
        Route::post('/store', 'ClassLevelController@store')->name('tingkat-kelas.store');
        Route::patch('/update/{id}', 'ClassLevelController@update')->name('tingkat-kelas.update');
    });

    //Route Mata Pelajaran
    Route::prefix('sub-kelas')->group(function ()
    {
        Route::get('/', 'SubClassController@index')->name('sub-kelas');
        Route::post('/store', 'SubClassController@store')->name('sub-kelas.store');
        Route::patch('/update/{id}', 'SubClassController@update')->name('sub-kelas.update');
    });
});

Route::prefix('grup-kelas')->middleware('auth')->group(function ()
{
    Route::get('/', 'GroupClassController@index')->name('grup');
});

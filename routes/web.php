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
// Route::get('/logout', function () {
//     Auth::logout();
//     return redirect()->route('login');
// });
Route::post('logout', 'AuthController@logout')->name('logout');

Route::get('/dashboard', 'PagesController@dashboard')->middleware('auth')->name('dashboard');
// Route::prefix('dashboard')->group(['middleware' => ['guru', 'staff', 'siswa']], function () {
//     Route::resource('/', 'PagesController@dashboard');
// });

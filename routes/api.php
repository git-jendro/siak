<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route Kurikulum
Route::post('/dashboard/kurikulum/add_pelajaran', 'CurriculumController@add_pelajaran');
Route::post('/dashboard/kurikulum/remove_pelajaran', 'CurriculumController@remove_pelajaran');

//Route Walikelas
Route::get('/dashboard/walikelas/{guru_id}', 'HomeroomTeacherController@modal_walikelas');
Route::post('/dashboard/walikelas/store', 'HomeroomTeacherController@store');

//Route Jadwal
Route::get('/dashboard/jadwal-pelajaran/{tingkat}', 'LessonScheduleController@filter_jurusan');


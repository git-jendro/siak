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
Route::get('/dashboard/jadwal-pelajaran/kelas/{tingkat_id}/{jurusan_id}', 'LessonScheduleController@filter_kelas');
Route::get('/dashboard/jadwal-pelajaran/tingkat/{tingkat_id}', 'LessonScheduleController@filter_tingkat');
Route::get('/dashboard/jadwal-pelajaran/jurusan/{jurusan_id}', 'LessonScheduleController@filter_jurusan');
Route::get('/dashboard/jadwal-pelajaran/jadwal/{kelas_id}', 'LessonScheduleController@filter_jadwal');
Route::post('/dashboard/jadwal-pelajaran/store', 'LessonScheduleController@store_jadwal');
Route::get('/dashboard/jadwal-pelajaran/check_ruangan/{ruangan_id}/{hari}/{mulai}', 'LessonScheduleController@check_ruangan');
Route::get('/dashboard/jadwal-pelajaran/check_guru/{guru_id}/{hari}/{mulai}', 'LessonScheduleController@check_guru');
Route::get('/dashboard/jadwal-pelajaran/check_both/{ruangan_id}/{guru_id}/{hari}/{mulai}', 'LessonScheduleController@check_both');


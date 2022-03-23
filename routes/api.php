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

//Route Filter
Route::get('/dashboard/filter/tingkat/{tingkat_id}', 'LessonScheduleController@filter_tingkat');
Route::get('/dashboard/filter/jurusan/{jurusan_id}', 'LessonScheduleController@filter_jurusan');
Route::get('/dashboard/filter/kelas/{tingkat_id}/{jurusan_id}', 'LessonScheduleController@filter_kelas');

//Route Jadwal Pelajaran
Route::get('/dashboard/jadwal-pelajaran/jadwal/{kelas_id}', 'LessonScheduleController@filter_jadwal');
Route::post('/dashboard/jadwal-pelajaran/store', 'LessonScheduleController@store_jadwal');
Route::get('/dashboard/jadwal-pelajaran/check_ruangan/{ruangan_id}/{hari}/{mulai}', 'LessonScheduleController@check_ruangan');
Route::get('/dashboard/jadwal-pelajaran/check_guru/{guru_id}/{hari}/{mulai}', 'LessonScheduleController@check_guru');
Route::get('/dashboard/jadwal-pelajaran/check_both/{ruangan_id}/{guru_id}/{hari}/{mulai}', 'LessonScheduleController@check_both');

//Route Jadwal UTS
Route::get('/dashboard/uts/jadwal/{kelas_id}', 'MidtermExamController@filter_jadwal');
Route::post('/dashboard/uts/store', 'MidtermExamController@store_jadwal');
Route::get('/dashboard/uts/check_ruangan/{ruangan_id}/{hari}/{mulai}', 'MidtermExamController@check_ruangan');
Route::get('/dashboard/uts/check_guru/{guru_id}/{hari}/{mulai}', 'MidtermExamController@check_guru');
Route::get('/dashboard/uts/check_both/{ruangan_id}/{guru_id}/{hari}/{mulai}', 'MidtermExamController@check_both');

//Route Jadwal UAS
Route::get('/dashboard/uas/jadwal/{kelas_id}', 'FinalExamController@filter_jadwal');
Route::post('/dashboard/uas/store', 'FinalExamController@store_jadwal');
Route::get('/dashboard/uas/check_ruangan/{ruangan_id}/{hari}/{mulai}', 'FinalExamController@check_ruangan');
Route::get('/dashboard/uas/check_guru/{guru_id}/{hari}/{mulai}', 'FinalExamController@check_guru');
Route::get('/dashboard/uas/check_both/{ruangan_id}/{guru_id}/{hari}/{mulai}', 'FinalExamController@check_both');

//Route Nilai
Route::get('/dashboard/nilai/{kelas_id}', 'ValueController@filter_kelas');
Route::post('/dashboard/store/tugas1', 'ValueController@store_tugas1');
Route::post('/dashboard/store/tugas2', 'ValueController@store_tugas2');
Route::post('/dashboard/store/tugas3', 'ValueController@store_tugas3');
Route::post('/dashboard/store/tugas4', 'ValueController@store_tugas4');
Route::post('/dashboard/store/tugas5', 'ValueController@store_tugas5');
Route::post('/dashboard/store/uts', 'ValueController@store_uts');
Route::post('/dashboard/store/uas', 'ValueController@store_uas');

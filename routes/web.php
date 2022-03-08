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

    //Route Ruangan
    Route::prefix('ruangan')->group(function ()
    {
        Route::get('/', 'RoomController@index')->name('ruangan');
        Route::post('/store', 'RoomController@store')->name('ruangan.store');
        Route::patch('/update/{id}', 'RoomController@update')->name('ruangan.update');
    });

    //Route Tingkat Kelas
    Route::prefix('tingkat-kelas')->group(function ()
    {
        Route::get('/', 'ClassLevelController@index')->name('tingkat-kelas');
        Route::post('/store', 'ClassLevelController@store')->name('tingkat-kelas.store');
        Route::patch('/update/{id}', 'ClassLevelController@update')->name('tingkat-kelas.update');
    });

    //Route Sub Kelas
    Route::prefix('sub-kelas')->group(function ()
    {
        Route::get('/', 'SubClassController@index')->name('sub-kelas');
        Route::post('/store', 'SubClassController@store')->name('sub-kelas.store');
        Route::patch('/update/{id}', 'SubClassController@update')->name('sub-kelas.update');
    });

    //Route Jurusan
    Route::prefix('jurusan')->group(function ()
    {
        Route::get('/', 'MajorController@index')->name('jurusan');
        Route::post('/store', 'MajorController@store')->name('jurusan.store');
        Route::patch('/update/{id}', 'MajorController@update')->name('jurusan.update');
    });

    //Route Kelas
    Route::prefix('kelas')->group(function ()
    {
        Route::get('/', 'ClassController@index')->name('kelas');
        Route::post('/store', 'ClassController@store')->name('kelas.store');
        Route::patch('/update/{id}', 'ClassController@update')->name('kelas.update');
    });

    //Route Kurikulum
    Route::prefix('kurikulum')->group(function ()
    {
        Route::get('/', 'CurriculumController@index')->name('kurikulum');
        Route::post('/store', 'CurriculumController@store')->name('kurikulum.store');
        Route::patch('/update/{id}', 'CurriculumController@update')->name('kurikulum.update');
        Route::get('/pelajaran/{slug}', 'CurriculumController@pelajaran')->name('kurikulum.pelajaran');
    });

    //Route Tahun Akademik
    Route::prefix('tahun-akademik')->group(function ()
    {
        Route::get('/', 'AcademicController@index')->name('tahun-akademik');
        Route::post('/store', 'AcademicController@store')->name('tahun-akademik.store');
        Route::patch('/update/{id}', 'AcademicController@update')->name('tahun-akademik.update');
        Route::post('/active/{id}', 'AcademicController@active')->name('tahun-akademik.active');
    });

    //Route Staff
    Route::prefix('staff')->group(function ()
    {
        Route::get('/', 'StaffController@index')->name('staff');
        Route::post('/store', 'StaffController@store')->name('staff.store');
        Route::patch('/update/{id}', 'StaffController@update')->name('staff.update');
        Route::delete('/destroy/{id}', 'StaffController@destroy')->name('staff.destroy');
    });

    //Route Guru
    Route::prefix('guru')->group(function ()
    {
        Route::get('/', 'TeacherController@index')->name('guru');
        Route::post('/store', 'TeacherController@store')->name('guru.store');
        Route::patch('/update/{id}', 'TeacherController@update')->name('guru.update');
        Route::post('/active/{id}', 'TeacherController@active')->name('guru.active');
    });

    //Route Siswa
    Route::prefix('siswa')->group(function ()
    {
        Route::get('/', 'StudentController@index')->name('siswa');
        Route::post('/store', 'StudentController@store')->name('siswa.store');
        Route::patch('/update/{id}', 'StudentController@update')->name('siswa.update');
        Route::post('/active/{id}', 'StudentController@active')->name('siswa.active');
    });

    //Route Walikelas
    Route::prefix('walikelas')->group(function ()
    {
        Route::get('/', 'HomeroomTeacherController@index')->name('walikelas');
        Route::post('/store', 'HomeroomTeacherController@store')->name('walikelas.store');
        Route::patch('/update/{id}', 'HomeroomTeacherController@update')->name('walikelas.update');
        Route::post('/active/{id}', 'HomeroomTeacherController@active')->name('walikelas.active');
    });

    //Route Jadwal Pelajaran
    Route::prefix('jadwal-pelajaran')->group(function ()
    {
        Route::get('/', 'LessonScheduleController@index')->name('jadwal-pelajaran');
        Route::post('/store', 'LessonScheduleController@store')->name('jadwal-pelajaran.store');
        Route::patch('/update/{id}', 'LessonScheduleController@update')->name('jadwal-pelajaran.update');
        Route::post('/active/{id}', 'LessonScheduleController@active')->name('jadwal-pelajaran.active');
    });
});

Route::prefix('grup-kelas')->middleware('auth')->group(function ()
{
    Route::get('/', 'GroupClassController@index')->name('grup');
});

<?php

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

/*Route::get('/', function () {
    return view('index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/
Route::get('/login', function () {
    return view('home');
});

Route::get('/', [\App\Http\Controllers\AddMapPointController::class, 'mappoint']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\AddMapPointController::class, 'mappoint'])->name('home');

Auth::routes();

Route::get('/add_message', [\App\Http\Controllers\AddMapPointController::class, 'indexmessagepols']);
Route::post('/addmessage', [App\Http\Controllers\AddMapPointController::class, 'addmessage']);
Route::get('/tidinggen/{id}', [\App\Http\Controllers\AddMapPointController::class, 'tidinggen']);


Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', function () {
        return view('admin');
    });
    Route::get('/add_tiding', [\App\Http\Controllers\AddMapPointController::class, 'indexadmin']);
    Route::post('/addtiding', [App\Http\Controllers\AddMapPointController::class, 'addtiding']);
    Route::get('/edittiding/{id}', [\App\Http\Controllers\AddMapPointController::class, 'edittiding']);
    Route::post('/updatetiding', [\App\Http\Controllers\AddMapPointController::class, 'updatetiding'])->name('updatetiding');
    Route::get('/deletetiding/{id}', [\App\Http\Controllers\AddMapPointController::class, 'deletetiding'])->name('deletetiding');
});

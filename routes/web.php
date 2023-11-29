<?php

use App\Http\Controllers\FetchApiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/post', PostController::class);
Route::get('/download/{post}', [PostController::class, 'downloadFile'])->name('download');

Route::post('/uploadExcel', [UserController::class, 'uploadExcel'])->name('uploadExcel');
Route::get('/downloadExcel', [UserController::class, 'downloadExcel'])->name('downloadExcel');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/download', [UserController::class, 'download'])->name('user.download');

Route::get('/fetchUsers', [UserController::class, 'fetchUsers'])->name('fetchUsers');


Route::get('/fetch', [FetchApiController::class, 'fetchApi'])->name('fetch');
Route::get('/smartChurch', [FetchApiController::class, 'smartChurch'])->name('smartChurch');

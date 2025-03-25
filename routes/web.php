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

use App\Http\Controllers\PageController;

Route::get('/index', [ PageController::class, 'getIndex']);
Route::get('/type/{id}', [PageController::class, 'getLoaiSp']);
Route::get('/detail/{id}',[PageController::class,'getDetail']);
Route::get('/admin', [PageController::class, 'getIndexAdmin']);

Route::get('/about', [PageController::class, 'getAbout'])->name('about');
Route::get('/contacts', [PageController::class, 'getContact'])->name('contacts');

Route::get('/admin-add-form', [PageController::class,'getAdminAdd'])->name('add-product');
Route::post('/admin-add-form',[PageController::class, 'postAdminAdd']);

Route::get('/admin-edit-form/{id}', [PageController::class, 'getAdminEdit']);
Route::post('/admin-edit', [PageController::class, 'postAdminEdit']);

Route::post('/admin-delete/{id}', [PageController::class, 'postAdminDelete']);

Route::get('/admin-export', [PageController::class, 'exportAdminProduct']);

Route::post('/search', [PageController::class, 'postSearch'])->name('search');

//USER
use App\Http\Controllers\RegisterController;

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register', [RegisterController::class, 'showregister']);

Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
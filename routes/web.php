<?php

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
Route::any('/rest/api', [App\Http\Controllers\Token::class, 'index']);
Route::any('/rest/chek', [App\Http\Controllers\Info::class, 'getCheck']);
Route::get('/all', [App\Http\Controllers\Main::class, 'index']);
Route::get('/info', [App\Http\Controllers\Info::class, 'index']);
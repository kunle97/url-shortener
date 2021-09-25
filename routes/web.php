<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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

Route::get('/', [Controller::class, 'index'] );

Route::post('/save-url', [Controller::class, 'saveURL'] )->name('saveURL');

Route::get('/click/{shorten_url_id}', [Controller::class, 'clickClick'])->name('click');
Route::get('/delete-url/{id}', [Controller::class, 'deleteURL'])->name('deleteURL');
Route::get('/delete-url/all', [Controller::class, 'deleteAll'])->name('deleteAll');     
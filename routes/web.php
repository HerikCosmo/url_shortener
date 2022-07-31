<?php

use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\UrlController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ShortLinkController::class, 'index'])->name('link.index');
Route::get('/{short_url}', [ShortLinkController::class, 'findLink'])->name('link.find');
Route::post('/url', [ShortLinkController::class, 'store'])->name('link.store');
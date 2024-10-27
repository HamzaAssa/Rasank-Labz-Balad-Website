<?php

use App\Http\Controllers\UnverifiedWordController;
use App\Http\Controllers\VerifiedWordController;
use App\Http\Controllers\DashboardController;
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

Route::get('/',function () {
    return redirect('/dashboard');
});


# Dashboard words 
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/dashboard/store', [DashboardController::class, 'store']);

# unverified words 
Route::get('/unverified-words', [UnverifiedWordController::class, 'index']);
Route::post('/unverified-words/cerate', [UnverifiedWordController::class, 'store'])->name('add_unverified_words');
Route::post('/unverified-words/update', [UnverifiedWordController::class, 'update'])->name('update_unverified_words');
Route::post('/unverified-words/delete', [UnverifiedWordController::class, 'destroy'])->name('delete_unverified_words');

# verified words
Route::get('/verified-words', [VerifiedWordController::class, 'index']);
Route::post('/verified-words/store', [VerifiedWordController::class, 'store']);

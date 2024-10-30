<?php

use App\Http\Controllers\DashboardController;
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
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
# Dashboard words 
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:admin,verifier');
Route::post('/dashboard/store', [DashboardController::class, 'store']);

# unverified words 
Route::get('/unverified-words', [UnverifiedWordController::class, 'index']);
Route::post('/unverified-words/cerate', [UnverifiedWordController::class, 'store'])->name('add_unverified_words');
Route::post('/unverified-words/update', [UnverifiedWordController::class, 'update'])->name('update_unverified_words');
Route::post('/unverified-words/add-pending', [UnverifiedWordController::class, 'addPending'])->name('pending_unverified_words');
Route::post('/unverified-words/verify', [UnverifiedWordController::class, 'verify'])->name('verify_unverified_words');
Route::post('/unverified-words/add-meaning', [UnverifiedWordController::class, 'addMeaning'])->name('add_meaning_unverified_words');
Route::post('/unverified-words/delete', [UnverifiedWordController::class, 'destroy'])->name('delete_unverified_words');

# verified words
Route::get('/verified-words', [VerifiedWordController::class, 'index']);


# Definitions Routes
Route::get('/definition/wordid/{id}', [DefinitionController::class, 'index']);
Route::post('/definition/add', [DefinitionController::class, 'store'])->name('add_definition');
Route::post('/definition/delete', [DefinitionController::class, 'destroy'])->name('delete_definition');


# Examples Routes
Route::get('/example/definitionid/{id}', [ExampleController::class, 'index']);
Route::post('/example/add', [ExampleController::class, 'store'])->name('add_example');
Route::post('/example/delete', [ExampleController::class, 'destroy'])->name('delete_example');


# users 
Route::get('/users',[UsersController::class,'index']);

});
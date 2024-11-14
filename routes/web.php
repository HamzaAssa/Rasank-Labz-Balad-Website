<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnverifiedWordController;
use App\Http\Controllers\VerifiedWordController;
use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\UsersController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:admin,publisher,verifier');
    // Route::post('/dashboard/store', [DashboardController::class, 'store']);

    # unverified words 
    Route::get('/unverified-words', [UnverifiedWordController::class, 'index'])->middleware('role:admin,publisher,verifier');
    Route::post('/unverified-words/cerate', [UnverifiedWordController::class, 'store'])->name('add_unverified_words')->middleware('role:admin,publisher,verifier');
    Route::post('/unverified-words/update', [UnverifiedWordController::class, 'update'])->name('update_unverified_words')->middleware('role:admin,publisher,verifier');
    Route::post('/unverified-words/add-pending', [UnverifiedWordController::class, 'addPending'])->name('pending_unverified_words')->middleware('role:admin,publisher,verifier');
    Route::post('/unverified-words/verify', [UnverifiedWordController::class, 'verify'])->name('verify_unverified_words')->middleware('role:admin,publisher,verifier');
    Route::post('/unverified-words/add-meaning', [UnverifiedWordController::class, 'addMeaning'])->name('add_meaning_unverified_words')->middleware('role:admin,publisher,verifier');
    Route::post('/unverified-words/delete', [UnverifiedWordController::class, 'destroy'])->name('delete_unverified_words')->middleware('role:admin,publisher,verifier');

    # verified words
    Route::get('/verified-words', [VerifiedWordController::class, 'index'])->middleware('role:admin,publisher,verifier');
    Route::post('/verified-words/publish', [VerifiedWordController::class, 'publish'])->name('publish_verified_words')->middleware('role:admin,publisher');

    # Definitions Routes
    Route::get('/definition/wordid/{id}', [DefinitionController::class, 'index'])->middleware('role:admin,publisher,verifier');
    Route::post('/definition/add', [DefinitionController::class, 'store'])->name('add_definition')->middleware('role:admin,publisher,verifier');
    Route::post('/definition/delete', [DefinitionController::class, 'destroy'])->name('delete_definition')->middleware('role:admin,publisher,verifier');

    # Examples Routes
    Route::get('/example/definitionid/{id}', [ExampleController::class, 'index'])->middleware('role:admin,publisher,verifier');
    Route::post('/example/add', [ExampleController::class, 'store'])->name('add_example')->middleware('role:admin,publisher,verifier');
    Route::post('/example/delete', [ExampleController::class, 'destroy'])->name('delete_example')->middleware('role:admin,publisher,verifier');

    # users 
    Route::get('/users',[UsersController::class,'index'])->middleware('role:admin');
    Route::post('/users/update',[UsersController::class,'update'])->name('update_user')->middleware('role:admin');
    Route::post('/users/delete',[UsersController::class,'destroy'])->name('delete_user')->middleware('role:admin');

});
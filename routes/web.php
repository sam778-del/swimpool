<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    FrontendController,
    UserController,
    OrderController,
    ManualOrderController,
    MapController,
    ClientController
};

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

require __DIR__ . '/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(["auth"]);

Route::get('/', [FrontendController::class, 'index'])->name('front_site');

Route::resource('operator', UserController::class)->middleware(['auth']);
Route::get('get-operator', [UserController::class, 'datatables'])->name('operator.datatables');
Route::resource('client', ClientController::class)->middleware(['auth']);
Route::resource('order', OrderController::class)->middleware(['auth']);
Route::resource('maunal-order', ManualOrderController::class)->middleware(['auth']);
Route::resource('table-map', MapController::class)->middleware(['auth']);
Route::get('showMap', [MapController::class, 'show'])->middleware(['auth']);
Route::post('updateMap', [MapController::class, 'update'])->middleware(['auth']);
Route::post('updateGazeboMap', [MapController::class, 'updateGazebo'])->middleware(['auth']);



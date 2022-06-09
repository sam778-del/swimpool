<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    FrontendController,
    UsersController,
    OrderController,
    ManualOrderController,
    MapController,
    ClientController,
    PriceController,
    AccesoryController,
    ReportController,
    Auth\LoginController
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

Route::resource('operator', UsersController::class)->middleware(['auth']);

Route::get('operators/list', [UsersController::class, 'index'])->name('operators.index')->middleware(['auth']);

Route::get('get-operator', [UsersController::class, 'datatables'])->name('operator.datatables');

Route::resource('client', ClientController::class)->middleware(['auth']);

Route::get('custpmer-datatables', [ClientController::class, 'datatables'])->name('client.datatables')->middleware(['auth']);

Route::resource('order', OrderController::class)->middleware(['auth']);
Route::resource('manual-order', ManualOrderController::class)->middleware(['auth']);
Route::resource('table-map', MapController::class)->middleware(['auth']);
Route::get('showMap', [MapController::class, 'show'])->middleware(['auth']);
Route::post('updateMap', [MapController::class, 'update'])->middleware(['auth']);
Route::post('updateGazeboMap', [MapController::class, 'updateGazebo'])->middleware(['auth']);
Route::resource('accessory', AccesoryController::class)->middleware(['auth']);
Route::delete('accessory/{id}', [AccesoryController::class, 'destroy'])->name('accessory.delete')->middleware(['auth']);
Route::get('accessory/edit/{id}', [AccesoryController::class, 'edit'])->name('accessory.edi')->middleware(['auth']);
Route::get('get-accessory', [AccesoryController::class, 'datatables'])->name('accessory.datatables');


Route::get('vistagiornoricercacliente', [FrontendController::class, 'showMap']);
Route::post('calcolaprezzocliente', [FrontendController::class, 'calculationMap']);

Route::post('stripe-payment', [FrontendController::class, 'stripePayment'])->name('stripe.payment');
Route::post('make-payment/new', [FrontendController::class, 'makePayment'])->name('make.payment');

Route::resource('order', OrderController::class)->middleware(['auth']);
Route::get('get-order', [OrderController::class, 'datatables'])->name('order.datatables');

Route::resource('price', PriceController::class)->middleware(['auth']);

Route::resource('report', ReportController::class);

Route::post('check-valid', [FrontendController::class, 'checkValid']);
Route::post('aggiungiprenotazione1bisdaombrellonecliente', [FrontendController::class, 'insertMap']);

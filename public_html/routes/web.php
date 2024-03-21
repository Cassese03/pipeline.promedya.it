<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxController;

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

Route::any('', [HomeController::class, 'primapagina']);
Route::any('/statistiche/{data}', [HomeController::class, 'statistiche']);
Route::any('/statistiche', [HomeController::class, 'statistiche']);
Route::any('login', [HomeController::class, 'login']);
Route::any('pipeline', [HomeController::class, 'pipeline']);
Route::any('disdette', [HomeController::class, 'disdette']);
Route::any('concessionario', [HomeController::class, 'concessionario']);
Route::any('budget', [HomeController::class, 'budget']);
Route::any('prodotti', [HomeController::class, 'prodotti']);
Route::any('dipendenti', [HomeController::class, 'dipendenti']);
Route::any('motivazione', [HomeController::class, 'motivazione']);
Route::any('categoria', [HomeController::class, 'categoria']);
Route::any('segnalato', [HomeController::class, 'segnalato']);
Route::any('privacy', [HomeController::class, 'privacy']);
Route::any('operatori', [HomeController::class, 'operatori']);
Route::any('info', [HomeController::class, 'info']);
Route::any('mail', [HomeController::class, 'mail']);
Route::any('logout', [HomeController::class, 'logout']);


Route::any('ajax/modifica_ajax/{Id}', [AjaxController::class, 'modifica_ajax']);
Route::any('ajax/riga_ajax/{Id}', [AjaxController::class, 'riga_ajax']);
Route::any('ajax/duplica_ajax/{Id}', [AjaxController::class, 'duplica_ajax']);

Route::any('ajax/modifica_ajax_DISDETTA/{Id}', [AjaxController::class, 'modifica_ajax_DISDETTA']);


<?php


use App\Http\Controllers\CFController;
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
// require __DIR__.'/api.php';

Route::any('', [HomeController::class, 'primapagina']);
Route::any('/statistiche/{data}', [HomeController::class, 'statistiche']);
Route::any('/statistiche', [HomeController::class, 'statistiche']);
Route::any('login', [HomeController::class, 'login']);
Route::any('pipeline', [HomeController::class, 'pipeline']);
Route::any('disdette', [HomeController::class, 'disdette']);
Route::any('concessionario', [HomeController::class, 'concessionario']);
Route::any('budget', [HomeController::class, 'budget']);
Route::any('budget_annuale/{anno}', [HomeController::class, 'budget_annuale']);
Route::any('prodotti', [HomeController::class, 'prodotti']);
Route::any('dipendenti', [HomeController::class, 'dipendenti']);
Route::any('motivazione', [HomeController::class, 'motivazione']);
Route::any('esito', [HomeController::class, 'esito']);
Route::any('opening', [HomeController::class, 'opening']);
Route::any('incentivi', [HomeController::class, 'incentivi']);
Route::any('categoria', [HomeController::class, 'categoria']);
Route::any('segnalato', [HomeController::class, 'segnalato']);
Route::any('privacy', [HomeController::class, 'privacy']);
Route::any('operatori', [HomeController::class, 'operatori']);
Route::any('info', [HomeController::class, 'info']);
Route::any('mail', [HomeController::class, 'mail']);
Route::any('logout', [HomeController::class, 'logout']);
Route::get('import-disdette', [App\Http\Controllers\HomeController::class, 'importDisdette'])->name('import-disdette');
Route::post('import-disdette', [App\Http\Controllers\HomeController::class, 'importDisdettePost'])->name('import-disdette.post');


Route::any('ajax/modifica_ajax/{Id}', [AjaxController::class, 'modifica_ajax']);
Route::any('ajax/riga_ajax/{Id}', [AjaxController::class, 'riga_ajax']);
Route::any('ajax/duplica_ajax/{Id}', [AjaxController::class, 'duplica_ajax']);

Route::any('ajax/modifica_ajax_DISDETTA/{Id}', [AjaxController::class, 'modifica_ajax_DISDETTA']);
Route::any('ajax/duplica_ajax_DISDETTA/{Id}', [AjaxController::class, 'duplica_ajax_DISDETTA']);

Route::any('ajax/duplica_ajax_INCENTIVI/{Id}', [AjaxController::class, 'duplica_ajax_INCENTIVI']);


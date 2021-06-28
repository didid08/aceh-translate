<?php

use App\Http\Controllers\Admin\KamusController as AdminKamusController;

use App\Http\Controllers\Home\KamusController as HomeKamusController;
use App\Http\Controllers\Home\TranslateController;

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

/* DEFAULT ROUTE */
Route::get('/', function() {
    return redirect()->route('home.kamus');
});
Route::get('/home', function() {
    return redirect()->route('home.kamus');
});

/* HOME ROUTES */
Route::get('/home/translate/{word?}/{translateTo?}', [TranslateController::class, 'index'])->name('home.translate');
Route::get('/home/kamus/{word?}', [HomeKamusController::class, 'index'])->name('home.kamus');

/* ADMIN ROUTES */
Route::get('/admin', function () {
    return redirect()->route('admin.kamus');
})->name('admin');
Route::get('/admin/kamus', [AdminKamusController::class, 'index'])->middleware(['auth'])->name('admin.kamus');
Route::post('/admin/kamus', [AdminKamusController::class, 'addVocabulary'])->middleware(['auth'])->name('admin.kamus.add');
Route::delete('/admin/kamus/{dictionaryId}', [AdminKamusController::class, 'deleteVocabulary'])->middleware(['auth'])->name('admin.kamus.delete');
require __DIR__.'/auth.php';

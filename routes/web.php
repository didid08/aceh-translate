<?php

use App\Http\Controllers\Admin\KamusController;

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

Route::get('/', function() {
    return redirect()->route('home.translate');
});

/* HOME ROUTES */
Route::get('/home/translate/{word?}/{translateTo?}', [TranslateController::class, 'index'])->name('home.translate');


/* ADMIN ROUTES */
Route::get('/admin', function () {
    return redirect()->route('admin.kamus');
})->name('admin');
Route::get('/admin/kamus', [KamusController::class, 'index'])->middleware(['auth'])->name('admin.kamus');
Route::post('/admin/kamus', [KamusController::class, 'addVocabulary'])->middleware(['auth'])->name('admin.kamus.add');
Route::delete('/admin/kamus/{dictionaryId}', [KamusController::class, 'deleteVocabulary'])->middleware(['auth'])->name('admin.kamus.delete');
require __DIR__.'/auth.php';

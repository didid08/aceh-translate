<?php
/* ========================================================= */
/* FILE INI BERFUNGSI UNTUK MENGATUR ROUTE/URL UNTUK WEB INI */
/* ========================================================= */

/* Untuk memanggil package yang dibutuhkan untuk file route ini */
use App\Http\Controllers\Admin\KamusController as AdminKamusController; // Memanggil Controller Admin>Kamus untuk dibuatkan routenya
use App\Http\Controllers\Home\KamusController as HomeKamusController; // Memanggil Controller Home>Kamus untuk dibuatkan routenya
use App\Http\Controllers\Home\TranslateController; // Memanggil Controller Home>Translate untuk dibuatkan routenya
use Illuminate\Support\Facades\Route; // Package essesnsial/wajib buat mengatur route (Tanpa file ini route tidak akan berjalan) | Anggap aja ini sebagai mesinnya

/* ============= */
/* DAFTAR ROUTES */
/* ============= */

/* Redirect "/" ke "/home/kamus" atau mengatur route untuk halaman awal */
Route::get('/', function() {
    return redirect()->route('home.kamus'); // ->route() merupakan method untuk memanggil route lain dengan cara mengisi alias route kedalam parameter dari method tsb
});
/* Redirect "/home" ke "/home/kamus" */
Route::get('/home', function() {
    return redirect()->route('home.kamus');
});

/* HOME ROUTES */

    /* Route untuk halaman kamus */
    Route::get('/home/kamus/{word?}', [HomeKamusController::class, 'index'])->name('home.kamus'); // Method ->name() berfungsi untuk membuat alias dari route yang bersangkutan agar lebih mudah dipanggil
    /* Route untuk halaman translate */
    Route::get('/home/translate/{word?}/{translateTo?}', [TranslateController::class, 'index'])->name('home.translate');
    /* Route untuk memproses form dari sarankan terjemahan */
    Route::post('/home/translate/sarankan', [TranslateController::class, 'pushSuggestion'])->name('home.translate.sarankan');
    /* Route untuk memproses form dari request terjemahan */
    Route::post('/home/translate/request', [TranslateController::class, 'pushRequest'])->name('home.translate.request');

/* ADMIN ROUTES */

    /* Redirect "/admin" ke "/admin/kamus" */
    Route::get('/admin', function () {
        return redirect()->route('admin.kamus');
    })->name('admin');

    /* Route untuk halaman admin/kamus */
    Route::get('/admin/kamus', [AdminKamusController::class, 'index'])->middleware(['auth'])->name('admin.kamus'); // Middleware secara sederhana dapat diartikan sebagai perangkat perantara. Dia itu cara kerjanya seperti penjaga gerbang atau security. Dalam kasus ini, routenya memanggil middleware auth agar lalu lintas yang melewati route ini harus melalui proses autentikasi terlebih dahulu
    /* Berfungsi buat memproses form tambah kosakata */
    Route::post('/admin/kamus', [AdminKamusController::class, 'addVocabulary'])->middleware(['auth'])->name('admin.kamus.add');
    /* Berfungsi buat memproses form update kosakata */
    Route::patch('/admin/kamus/{id?}', [AdminKamusController::class, 'updateVocabulary'])->middleware(['auth'])->name('admin.kamus.update');
    /* Berfungsi buat menghapus kosakata */
    Route::delete('/admin/kamus/{dictionaryId}', [AdminKamusController::class, 'deleteVocabulary'])->middleware(['auth'])->name('admin.kamus.delete');
    /* Berfungsi buat menerima saran kosakata */
    Route::post('/admin/kamus/terima-saran/{id}', [AdminKamusController::class, 'acceptVocabulary'])->middleware(['auth'])->name('admin.kamus.terima-saran');
    /* Berfungsi buat menolak saran kosakata */
    Route::post('/admin/kamus/tolak-saran/{id}', [AdminKamusController::class, 'denyVocabulary'])->middleware(['auth'])->name('admin.kamus.tolak-saran');
    /* Berfungsi buat menolak request kosakata */
    Route::post('/admin/kamus/tolak-request/{id}', [AdminKamusController::class, 'denyRequest'])->middleware(['auth'])->name('admin.kamus.abaikan-request');

require __DIR__.'/auth.php';

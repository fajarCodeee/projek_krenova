<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/peserta')
    ->as('peserta.')->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\Peserta\Dashboard::class, 'index'])->name('dashboard');

        // krevona
        Route::prefix('/krenova')->as('krenova.')->group(function () {
            Route::get('/daftar-inovasi', [App\Http\Controllers\Peserta\Krenova\DaftarInovasi::class, 'index'])->name('daftar-inovasi');
            Route::get('/detail/daftar-inovasi/{id}', [App\Http\Controllers\Peserta\Krenova\DaftarInovasi::class, 'show'])->name('show.daftar-inovasi');

            Route::get('/create/daftar-inovasi', [App\Http\Controllers\Peserta\Krenova\DaftarInovasi::class, 'create'])->name('create.daftar-inovasi');

            Route::get('/daftar-draft-inovasi', [App\Http\Controllers\Peserta\Krenova\DaftarDraftInovasi::class, 'index'])->name('daftar-draft-inovasi');
            Route::get('/delete/daftar-draft-inovasi/{id}', [App\Http\Controllers\Peserta\Krenova\DaftarDraftInovasi::class, 'destroy'])->name('delete.draft-inovasi');
            Route::get('/edit/daftar-inovasi/{id}', [App\Http\Controllers\Peserta\Krenova\DaftarInovasi::class, 'create'])->name('edit.daftar-inovasi');
        });

        // penelitian daerah
        Route::prefix('/penelitian')->as('penelitian.')->group(function () {
            Route::get('/daftar-penelitian-daerah', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'index'])->name('daftar-penelitian-daerah');
            Route::get('/create/daftar-penelitian-daerah', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'create'])->name('create.daftar-penelitian-daerah');
            Route::get('/show/daftar-penelitian-daerah/{id}', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'show'])->name('show.daftar-penelitian-daerah');
        });
    });

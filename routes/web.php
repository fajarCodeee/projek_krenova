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
            Route::get('/daftar-inovasi/approve', [App\Http\Controllers\Peserta\Krenova\DaftarInovasiApprove::class, 'index'])->name('approve.daftar-inovasi');
            Route::get('/daftar-inovasi', [App\Http\Controllers\Peserta\Krenova\DaftarInovasi::class, 'index'])->name('daftar-inovasi');
            Route::get('/detail/daftar-inovasi/{id}', [App\Http\Controllers\Peserta\Krenova\DaftarInovasi::class, 'show'])->name('show.daftar-inovasi');

            Route::get('/create/daftar-inovasi', [App\Http\Controllers\Peserta\Krenova\DaftarInovasi::class, 'create'])->name('create.daftar-inovasi');

            Route::get('/daftar-draft-inovasi', [App\Http\Controllers\Peserta\Krenova\DaftarDraftInovasi::class, 'index'])->name('daftar-draft-inovasi');
            Route::delete('/delete/daftar-draft-inovasi/{id}', [App\Http\Controllers\Peserta\Krenova\DaftarDraftInovasi::class, 'destroy_draft'])->name('delete.draft-inovasi');
            Route::get('/edit/daftar-inovasi/{id}', [App\Http\Controllers\Peserta\Krenova\DaftarInovasi::class, 'create'])->name('edit.daftar-inovasi');
        });

        // penelitian daerah
        Route::prefix('/penelitian')->as('penelitian.')->group(function () {
            // approve
            Route::get('/daftar-penelitian-daerah', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'index'])->name('daftar-penelitian-daerah');
            // pending
            Route::get('/daftar-penelitian-daerah/pending', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'pending'])->name('pending.daftar-penelitian-daerah');
            // revisi
            Route::get('/daftar-penelitian-daerah/revisi', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'revisi'])->name('revisi.daftar-penelitian-daerah');
            Route::get('/create/daftar-penelitian-daerah', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'create'])->name('create.daftar-penelitian-daerah');
            Route::get('/show/daftar-penelitian-daerah/{id}', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'show'])->name('show.daftar-penelitian-daerah');

            Route::delete('/delete/daftar-penelitian-daerah/{id}', [App\Http\Controllers\Peserta\Penelitian\DaftarPenelitian::class, 'destroy'])->name('delete.daftar-penelitian-daerah');
        });
    });

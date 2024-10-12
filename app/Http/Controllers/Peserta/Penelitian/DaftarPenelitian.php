<?php

namespace App\Http\Controllers\Peserta\Penelitian;

use App\Http\Controllers\Controller;
use App\Models\FormPenelitianDaerah;
use App\Models\User;

class DaftarPenelitian extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Penelitian Daerah';
        $title_page = 'Daftar Penelitian Daerah';
        $daftar_penelitian = FormPenelitianDaerah::with('user')
            ->where('user_id', '1')
            ->where('status', '2')
            ->latest()
            ->get();

        return view('peserta.penelitian-daerah.daftar-penelitian', compact(
            'title',
            'title_page',
            'daftar_penelitian',
        ));
    }

    public function revisi()
    {
        $title = 'Penelitian Daerah';
        $title_page = 'Daftar Penelitian Daerah';
        $daftar_penelitian = FormPenelitianDaerah::with('user')
            ->where('user_id', '1')
            ->where('status', '3')
            ->latest()
            ->get();

        $title_popup = 'Hapus Penelitian!';
        $text = "Apakah Anda yakin ingin menghapus ini?";
        confirmDelete($title_popup, $text);

        return view('peserta.penelitian-daerah.daftar-penelitian', compact(
            'title',
            'title_page',
            'daftar_penelitian',
        ));
    }

    public function pending()
    {
        $title = 'Penelitian Daerah';
        $title_page = 'Daftar Penelitian Daerah';
        $daftar_penelitian = FormPenelitianDaerah::with('user')
            ->where('user_id', '1')
            ->where('status', '1')
            ->latest()
            ->get();

        return view('peserta.penelitian-daerah.daftar-penelitian', compact(
            'title',
            'title_page',
            'daftar_penelitian',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Penelitian Daerah';
        $title_page = 'Tambah Penelitian Daerah';

        return view('peserta.penelitian-daerah.pages.create', compact('title', 'title_page'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Penelitian Daerah';
        $title_page = 'Detail Penelitian Daerah';
        $form_id = $id;

        return view('peserta.penelitian-daerah.pages.create', compact('title', 'title_page', 'form_id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find('1');
        $user->hasFormPenelitianDaerah()
            ->where('id', $id)
            ->delete();

        return redirect()->route('peserta.penelitian.daftar-penelitian-daerah')->with('success', 'Berhasil Menghapus Data!');
    }
}

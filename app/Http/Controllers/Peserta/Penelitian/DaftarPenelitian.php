<?php

namespace App\Http\Controllers\Peserta\Penelitian;

use App\Http\Controllers\Controller;
use App\Models\FormPenelitianDaerah;
use Illuminate\Http\Request;

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
            ->where('status', '1')
            ->orWhere('status', '3')
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

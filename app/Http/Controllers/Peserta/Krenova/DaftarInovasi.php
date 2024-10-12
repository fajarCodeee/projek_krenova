<?php

namespace App\Http\Controllers\Peserta\Krenova;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FormKrenova;
use Illuminate\Support\Facades\Validator;

class DaftarInovasi extends Controller
{

    public  $title = 'Krenova';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $inovasi = FormKrenova::where('user_id', '1')
            ->where('status', '1')
            ->latest()->get();
        $title_page = 'Daftar Inovasi';
        return view('peserta.krenova.daftar-inovasi', compact('title', 'title_page', 'inovasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = null)
    {
        $title = $this->title;
        $title_page = 'Buat Inovasi';
        $form_id = $id;
        return view('peserta.krenova.pages.create', compact('title', 'title_page', 'form_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = $this->title;
        $title_page = 'Detail Inovasi';
        $form_id = $id;
        return view('peserta.krenova.pages.detail', compact('title', 'title_page', 'form_id'));
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

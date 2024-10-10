<?php

namespace App\Http\Controllers\Peserta\Krenova;

use App\Http\Controllers\Controller;
use App\Models\FormKrenova;
use App\Models\FormKrenovaDraft;
use Illuminate\Http\Request;

class DaftarDraftInovasi extends Controller
{

    public  $title = 'Krenova';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $inovasi = FormKrenovaDraft::where('user_id', '1')->latest()->get();
        $title_page = 'Daftar Draft Inovasi';
        return view('peserta.krenova.daftar-draft-inovasi', compact('title', 'title_page', 'inovasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
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
        FormKrenova::where('id', $id)->delete();
        FormKrenovaDraft::where('id', $id)->delete();

        return redirect()->back();
    }
}

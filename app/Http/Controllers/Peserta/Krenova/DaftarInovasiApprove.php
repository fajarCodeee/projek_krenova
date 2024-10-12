<?php

namespace App\Http\Controllers\Peserta\Krenova;

use App\Models\User;
use App\Http\Controllers\Controller;

class DaftarInovasiApprove extends Controller
{
    public function index()
    {
        $user = User::find('1');

        $title = 'Krenova';
        $inovasi = $user->hasFormKrenova()
            ->where('status', '2')
            ->get();
        $title_page = 'Daftar Draft Inovasi';
        return view('peserta.krenova.daftar-inovasi', compact('title', 'title_page', 'inovasi'));
    }
}

<?php

namespace App\Http\Controllers\Peserta\Krenova;

use App\Models\User;
use App\Models\FormKrenova;
use Illuminate\Http\Request;
use App\Models\FormKrenovaDraft;
use App\Http\Controllers\Controller;

class DaftarDraftInovasi extends Controller
{

    public  $title = 'Krenova';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $inovasi_draft = FormKrenovaDraft::where('user_id', '1')->latest()->get();
        $inovasi_revisi = FormKrenova::where('user_id', '1')
            ->where('status', '3')
            ->latest()->get();
        $title_page = 'Daftar Draft Inovasi';

        $title_popup = 'Hapus Draft!';
        $text = "Apakah Anda yakin ingin menghapus ini?";

        confirmDelete($title_popup, $text);
        return view('peserta.krenova.daftar-draft-inovasi', compact('title', 'title_page', 'inovasi_draft', 'inovasi_revisi'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_draft(string $id)
    {
        $user = User::find('1');

        $user->hasFormKrenovaDraft()->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }

    public function destroy_revisi(string $id)
    {
        $user = User::find('1');

        $user->hasFormKrenova()->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}

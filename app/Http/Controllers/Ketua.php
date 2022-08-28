<?php

namespace App\Http\Controllers;

use App\Models\JenisAnggaran;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class Ketua extends Controller
{

    public function pengajuan()
    {
        $data['pengajuan'] = Pengajuan::all();
        return view('pages.pengajuan.ketua', $data);
    }

    public function terimaPengajuan(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->update([
            'status_verifikasi' => '2'
        ]);
        buatLogAktivitas('menerima pengajuan');
        return 1;
    }

    public function tolakPengajuan(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->update([
            'status_verifikasi' => '4'
        ]);
        buatLogAktivitas('menolak pengajuan');
        return 1;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\JenisAnggaran;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class Bendahara extends Controller
{

    public function pengajuan()
    {
        $data['pengajuan'] = Pengajuan::all();
        return view('pages.pengajuan.bendahara', $data);
    }

    public function terimaPengajuan(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->update([
            'status_verifikasi' => '1'
        ]);
        return 1;
    }

    public function tolakPengajuan(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->update([
            'status_verifikasi' => '3'
        ]);
        return 1;
    }
}

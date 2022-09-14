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
        buatLogAktivitas('menerima pengajuan');
        return 1;
    }

    public function tolakPengajuan(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->update([
            'status_verifikasi' => '3'
        ]);

        buatLogAktivitas('menolak pengajuan');
        return 1;
    }

    public function updateAlasanTolak(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->update([
            'alasan_bendahara_tolak' => $request->alasan,
        ]);

        buatLogAktivitas('mengisi alasan menolak pengajuan');
        return redirect()->back()->with('message', 'data tersimpan');
    }

    public function updateTglPencairan(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->update([
            'tgl_pencairan' => $request->tgl_pencairan,
        ]);

        buatLogAktivitas('mengisi alasan menolak pengajuan');
        return redirect()->back()->with('message', 'data tersimpan');
    }
}

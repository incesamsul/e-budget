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

        $jenisAnggaran = JenisAnggaran::where('id_jenis_anggaran', $request->id_jenis_anggaran);
        $sisaAnggaran = $jenisAnggaran->first()->jumlah_anggaran - $request->jumlah_anggaran;
        $jenisAnggaran->update([
            'jumlah_anggaran' => $sisaAnggaran
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


    public function updateAlasanTolak(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->update([
            'alasan_ketua_tolak' => $request->alasan,
        ]);

        buatLogAktivitas('mengisi alasan menolak pengajuan');
        return redirect()->back()->with('message', 'data tersimpan');
    }
}

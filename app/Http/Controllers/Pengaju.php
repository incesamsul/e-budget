<?php

namespace App\Http\Controllers;

use App\Models\JenisAnggaran;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class Pengaju extends Controller
{

    public function pengajuan()
    {
        $data['jenis_anggaran'] = JenisAnggaran::all();
        $data['pengajuan'] = Pengajuan::where('id_pengaju', auth()->user()->id)->get();
        return view('pages.pengajuan.index', $data);
    }

    public function createPengajuan(Request $request)
    {
        Pengajuan::create([
            'id_tahun_akademik' => getTahunAkademikAktif()->id_tahun_akademik,
            'id_pengaju' => auth()->user()->id,
            'id_jenis_anggaran' => $request->id_jenis_anggaran,
            'jumlah_anggaran' => $request->jumlah_anggaran,
        ]);

        buatLogAktivitas('membuat pengajuan');

        return redirect()->back()->with('message', 'anggaran berhasil di ajukan');
    }

    public function deletePengajuan(Request $request)
    {
        Pengajuan::where('id_pengajuan', $request->id)->delete();
        buatLogAktivitas('menghapus pengajuan');
        return 1;
    }
}

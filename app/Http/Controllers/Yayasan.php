<?php

namespace App\Http\Controllers;

use App\Models\JenisAnggaran;
use App\Models\LogAktivitasModel;
use App\Models\Pengajuan;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class Yayasan extends Controller
{

    public function logAktivitas($tanggal = null)
    {
        if (!$tanggal) {
            $data['log_aktivitas'] = LogAktivitasModel::all();
        } else {
            $data['log_aktivitas'] = LogAktivitasModel::where('tgl_aktivitas', $tanggal)->get();
        }
        return view('pages.log.index', $data);
    }

    public function laporan()
    {
        $data['pengajuan'] = Pengajuan::all();
        return view('pages.laporan.index', $data);
    }

    public function cetakLaporan()
    {

        $data['pengajuan'] = Pengajuan::all();
        $html = view('pages.cetak.laporan', $data);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('Legal', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        exit(0);
    }
}

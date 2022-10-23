<?php

namespace App\Http\Controllers;

use App\Models\JenisAnggaran;
use App\Models\Pengajuan;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use DateTime;
use DateTimeZone;

class General extends Controller
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function dashboard()
    {
        // DATA GRAFIK
        $timezone = 'Asia/Makassar';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $data['tgl_sekarang'] = $date->format('Y-m-d');
        $data['jam_sekarang'] = $date->format('H:i:s');


        $data['hariIni'] = $date->format('Y-m-d');
        $data['hariYangLalu1'] = $date->modify('-1 day')->format('Y-m-d');
        $data['hariYangLalu2'] = $date->modify('-1 day')->format('Y-m-d');
        $data['hariYangLalu3'] = $date->modify('-1 day')->format('Y-m-d');
        $data['hariYangLalu4'] = $date->modify('-1 day')->format('Y-m-d');
        $data['hariYangLalu5'] = $date->modify('-1 day')->format('Y-m-d');
        $data['hariYangLalu6'] = $date->modify('-1 day')->format('Y-m-d');
        $data['hariYangLalu7'] = $date->modify('-1 day')->format('Y-m-d');

        $data['pengajuanHariIni'] = Pengajuan::where('created_at', $data['hariIni'])->get()->sum('*');
        $data['pengajuan1HariYangLalu'] = Pengajuan::where('created_at', $data['hariYangLalu1'])->get()->sum('*');
        $data['pengajuan2HariYangLalu'] = Pengajuan::where('created_at', $data['hariYangLalu2'])->get()->sum('*');
        $data['pengajuan3HariYangLalu'] = Pengajuan::where('created_at', $data['hariYangLalu3'])->get()->sum('*');
        $data['pengajuan4HariYangLalu'] = Pengajuan::where('created_at', $data['hariYangLalu4'])->get()->sum('*');
        $data['pengajuan5HariYangLalu'] = Pengajuan::where('created_at', $data['hariYangLalu5'])->get()->sum('*');
        $data['pengajuan6HariYangLalu'] = Pengajuan::where('created_at', $data['hariYangLalu6'])->get()->sum('*');
        $data['pengajuan7HariYangLalu'] = Pengajuan::where('created_at', $data['hariYangLalu7'])->get()->sum('*');


        return view('pages.dashboard.index', $data);
    }

    public function sisaAnggaran()
    {
        $data['jenis_anggaran'] = JenisAnggaran::all();
        return view('pages.sisa_anggaran.index', $data);
    }

    public function cetakLaporansisaAnggaran()
    {

        $data['jenis_anggaran'] = JenisAnggaran::all();
        $html = view('pages.cetak.laporan_sisa_anggaran', $data);

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

    public function profile()
    {
        $data['user'] = $this->userModel->getUserProfile(auth()->user()->id);
        return view('pages.profile.index', $data);
    }

    public function bantuan()
    {
        return view('pages.bantuan.index');
    }

    public function ubahRole(Request $request)
    {
        User::where('id', auth()->user()->id)
            ->update(['role' => $request->post('role')]);
        return redirect()->back();
    }

    public function ubahFotoProfile(Request $request)
    {

        $extensions = ['jpg', 'jpeg', 'png'];

        $result = array($request->foto->getClientOriginalExtension());

        if (in_array($result[0], $extensions)) {
            $file = $request->foto;
        } else {
            return redirect()->back()->with('error', 'format file tidak di dukung');
        }

        // $fileName = auth()->user()->email . "." . $request->foto->extension();
        $fileName = uniqid() . "." . $request->foto->extension();
        $request->foto->move(public_path('data/foto_profile/' . $fileName . '/'), $fileName);

        // Storage::disk('uploads')->put($fileName, file_get_contents($request->foto->getRealPath()));

        User::where('id', auth()->user()->id)
            ->update(['foto' => $fileName]);
        return redirect()->back();
    }
}

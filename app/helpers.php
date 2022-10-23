<?php

use App\Models\FavoritModel;
use App\Models\KategoriModel;
use App\Models\LogAktivitasModel;
use App\Models\Pengajuan;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isNull;


function getAllPengajuan()
{
    return Pengajuan::all();
}


function getJumlahPerStatus($status)
{
    return Pengajuan::where('status_verifikasi', $status)->get();
}

function getAnggaranTerpakai($idJenisAnggaran)
{
    return Pengajuan::where('id_jenis_anggaran', $idJenisAnggaran)->get()->sum('jumlah_anggaran');
}

function buatLogAktivitas($log)
{
    $timezone = 'Asia/Makassar';
    $date = new DateTime('now', new DateTimeZone($timezone));
    $tanggal = $date->format('Y-m-d');
    $localTime = $date->format('H:i:s');
    return LogAktivitasModel::create([
        'user_id' => auth()->user()->id,
        'tgl_aktivitas' => $tanggal,
        'jam_aktivitas' => $localTime,
        'aktivitas' => $log
    ]);
}

function getTahunAkademikAktif()
{
    return TahunAkademik::where('status', '1')->first();
}

function getStatus($data)
{
    if ($data->status_verifikasi == 0) {
        return '<span class="badge badge-primary">Dalam antrian</span>';
    } else if ($data->status_verifikasi == 1) {
        return '<span class="badge badge-success">diterima bendahara</span>';
    } else if ($data->status_verifikasi == 2) {
        return '<span class="badge badge-success">diterima ketua</span>';
    } else if ($data->status_verifikasi == 3) {
        return '<span class="badge badge-danger">ditolak bendahara</span>';
    } else if ($data->status_verifikasi == 4) {
        return '<span class="badge badge-danger">ditolak ketua</span>';
    }
}

function removeSpace($string)
{
    return str_replace(" ", "", $string);
}

function getUserRoleName($userRoleId)
{
    return DB::table('users')
        ->Join('role', 'role.id_role', '=', 'users.id_role')
        ->where('users.id_role', $userRoleId)
        ->select('nama_role')
        ->first()->nama_role;
}


function sweetAlert($pesan, $tipe)
{
    echo '<script>document.addEventListener("DOMContentLoaded", function() {
        Swal.fire(
            "' . $pesan . '",
            "proses berhasil di lakukan",
            "' . $tipe . '",
        );
    })</script>';
}

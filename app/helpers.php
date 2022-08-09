<?php

use App\Models\FavoritModel;
use App\Models\KategoriModel;
use App\Models\LogAktivitasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isNull;

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
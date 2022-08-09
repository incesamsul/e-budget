<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $guarded = ['id_pengajuan'];

    public function jenisAnggaran()
    {
        return $this->belongsTo(JenisAnggaran::class, 'id_jenis_anggaran', 'id_jenis_anggaran');
    }
}

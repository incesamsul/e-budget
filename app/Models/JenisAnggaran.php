<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAnggaran extends Model
{
    use HasFactory;
    protected $table = 'jenis_anggaran';
    protected $guarded = ['id_jenis_anggaran'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSpk extends Model
{
    use HasFactory;

    protected $table = 'laporan_spk';
    protected $primaryKey = 'id_spk';
    public $timestamps = true;

    protected $fillable = [
        'jenis_laporan',
        'biaya',
        'dampak',
        'durasi_pekerjaan',
        'jumlah_pengadua=',
        'id_warga',
    ];
}

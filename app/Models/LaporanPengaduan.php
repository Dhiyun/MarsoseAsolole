<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengaduan extends Model
{
    // Specify the table name if it does not follow Laravel's naming convention
    protected $table = 'laporan_pengaduan';

    // Specify the primary key if it does not follow Laravel's naming convention
    protected $primaryKey = 'id_laporan';

    // Mass assignable attributes
    protected $fillable = [
        'tanggal_proses',
        'tanggal_selesai',
        'jenis_laporan',
        'gambar',
        'keterangan',
        'status',
        'id_warga',
    ];
}

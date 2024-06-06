<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPengaduan extends Model
{
    protected $table = 'laporan_pengaduan';
    protected $primaryKey = 'id_laporan';
    public $timestamps = true;

    protected $fillable = [
        'judul',
        'tanggal_laporan',
        'tanggal_selesai',
        'jenis_laporan',
        'gambar',
        'keterangan',
        'status',
        'id_warga',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga');
    }

    public function alternatifs()
    {
        return $this->hasMany(Alternatif::class, 'id_laporan');
    }
}

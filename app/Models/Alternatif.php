<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';

    protected $primaryKey = 'id_alternatif';

    protected $fillable = [
        'kode_alternatif',
        'id_laporan',
    ];

    public function laporanPengaduan()
    {
        return $this->belongsTo(LaporanPengaduan::class, 'id_laporan');
    }
}

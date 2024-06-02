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
        'sdm',
    ];

    public function getSdmDescription()
    {
        return match($this->dampak) {
            1 => 'Rendah',
            2 => 'Medium',
            3 => 'Tinggi',
            default => 'Tidak diketahui',
        };
    }
}


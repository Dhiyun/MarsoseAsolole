<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    // Specify the table name if it does not follow Laravel's naming convention
    protected $table = 'alternatif';

    // Specify the primary key if it does not follow Laravel's naming convention
    protected $primaryKey = 'id_alternatif';

    // Mass assignable attributes
    protected $fillable = [
        'kode_alternatif',
        'id_laporan',
    ];

    // Define the relationship with the LaporanPengaduan model
    public function laporanPengaduan()
    {
        return $this->belongsTo(LaporanPengaduan::class, 'id_laporan');
    }
}

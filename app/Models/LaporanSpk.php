<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LaporanSpk extends Model
{
    use HasFactory;
    
    // Specify the table name if it does not follow Laravel's naming convention
    protected $table = 'laporan_spk';

    // Specify the primary key if it does not follow Laravel's naming convention
    protected $primaryKey = 'id_spk';

    // Mass assignable attributes
    protected $fillable = [
        'id_kriteria',
        'id_alternatif',
        'nilai',
    ];

    // Define the relationship with the Kriteria model
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    // Define the relationship with the Alternatif model
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif');
    }
}


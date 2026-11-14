<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    public $timestamps = true;

    protected $fillable = [
        'id_warga',
        'id_level',
        'periode_awal',
        'periode_akhir',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $primaryKey = 'id_surat';
    public $timestamps = true;

    protected $fillable = [
        'jenis_surat',
        'nama_surat',
        'file_surat',
        'id_warga',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga');
    }
}

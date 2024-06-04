<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KK extends Model
{
    use HasFactory;

    protected $table = 'kk';
    protected $primaryKey = 'id_kk';
    public $timestamps = true;

    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'id_rt',
    ];

    public function rt()
    {
        return $this->belongsTo(RT::class, 'id_rt');
    }

    public function warga()
    {
        return $this->hasOne(Warga::class, 'id_kk');
    }
}

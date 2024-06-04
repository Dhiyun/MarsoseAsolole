<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'id_warga';
    public $timestamps = true;

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'periode_jabatan_awal',
        'periode_jabatan_akhir',
        'no_rt',
        'status',
        'id_user',
        'id_kk',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    public function kk()
    {
        return $this->belongsTo(KK::class, 'id_kk');
    }
}

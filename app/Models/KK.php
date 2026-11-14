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
        'alamat',
        'id_rt',
    ];

    protected static function booted(): void
    {
        static::updated(function (KK $kk) {
            if ($kk->wasChanged(['id_rt', 'alamat'])) {
                Warga::where('id_kk', $kk->id_kk)->update([
                    'id_rt' => $kk->id_rt,
                    'alamat' => $kk->alamat,
                ]);
            }
        });
    }

    public function rt()
    {
        return $this->belongsTo(RT::class, 'id_rt');
    }

    public function warga()
    {
        return $this->hasOne(Warga::class, 'id_kk');
    }

    public function kepala()
    {
        return $this->hasOne(Warga::class, 'id_kk')->where('status_keluarga', 'kepala_keluarga');
    }

    public function getKepalaKeluargaAttribute()
    {
        return $this->kepala?->nama;
    }

    public function scopeMilikRt($query, $noRt)
    {
        return $query->whereHas('rt', function ($query) use ($noRt) {
            $query->where('no_rt', RT::formatNomor($noRt));
        });
    }
}

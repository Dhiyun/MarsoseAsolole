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
        'id_rt',
        'no_rt',
        'status_keluarga',
        'status_kependudukan',
        'id_user',
        'id_kk',
        'foto'
    ];

    protected static function booted(): void
    {
        static::saving(function (Warga $warga) {
            if ($warga->id_kk && $kk = KK::find($warga->id_kk)) {
                $warga->id_rt = $kk->id_rt;
                $warga->alamat = $kk->alamat;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    public function kk()
    {
        return $this->belongsTo(KK::class, 'id_kk');
    }

    public function rt()
    {
        return $this->belongsTo(RT::class, 'id_rt');
    }

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'id_warga');
    }

    public function jabatanTerakhir()
    {
        return $this->hasOne(Jabatan::class, 'id_warga')->latestOfMany('periode_awal');
    }

    public function laporan_pengaduan()
    {
        return $this->hasMany(LaporanPengaduan::class, 'id_warga');
    }

    public function getNoRtAttribute()
    {
        return $this->rt?->no_rt;
    }

    public function setNoRtAttribute($noRt)
    {
        $this->attributes['id_rt'] = RT::where('no_rt', RT::formatNomor($noRt))->value('id_rt');
    }

    public function getPeriodeJabatanAwalAttribute()
    {
        return $this->jabatanTerakhir?->periode_awal;
    }

    public function getPeriodeJabatanAkhirAttribute()
    {
        return $this->jabatanTerakhir?->periode_akhir;
    }

    public function aturJabatan($idLevel, $periodeAwal, $periodeAkhir): void
    {
        $hariIni = now()->toDateString();

        if ($idLevel == Level::where('level_kode', 'WRG')->value('id_level')) {
            $this->jabatan()->where('periode_awal', '>', $hariIni)->delete();
            $this->jabatan()->where('periode_akhir', '>', $hariIni)->update(['periode_akhir' => $hariIni]);

            return;
        }

        $this->jabatan()->updateOrCreate(
            ['id_level' => $idLevel, 'periode_awal' => $periodeAwal],
            ['periode_akhir' => $periodeAkhir]
        );
    }

    public function scopeMilikRt($query, $noRt)
    {
        return $query->whereHas('rt', function ($query) use ($noRt) {
            $query->where('no_rt', RT::formatNomor($noRt));
        });
    }
}

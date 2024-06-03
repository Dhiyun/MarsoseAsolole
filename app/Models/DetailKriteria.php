<?php

// app/Models/DetailKriteria.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKriteria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_kriteria';
    protected $fillable = ['id_kriteria', 'rentang', 'nilai', 'bobot_normalisasi'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}

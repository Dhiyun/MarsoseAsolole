<?php

// app/Models/Kriteria.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kriteria';
    protected $fillable = ['nama_kriteria', 'jenis_kriteria'];

    public function detailKriterias()
    {
        return $this->belongsTo(DetailKriteria::class, 'id_kriteria');
    }
}

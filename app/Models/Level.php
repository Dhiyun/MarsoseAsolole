<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'level';
    protected $primaryKey = 'id_level';
    public $timestamps = true;

    protected $fillable = [
        'level_kode',
        'level_nama',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_level');
    }
}

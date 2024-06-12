<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $table = 'rt';
    protected $primaryKey = 'id_rt';
    public $timestamps = true;

    protected $fillable = [
        'no_rt',
        'id_rw',
    ];

    public function rw()
    {
        return $this->belongsTo(RW::class, 'id_rw');
    }

    public function rt()
    {
        return $this->hasMany(RT::class, 'id_rt');
    }
}

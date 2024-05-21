<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;

    protected $table = 'rw';
    protected $primaryKey = 'id_rw';
    public $timestamps = true;
    
    protected $fillable = [
        'no_rw',
    ];
}

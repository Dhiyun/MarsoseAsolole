<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Foundation\Auth\User as Auth;

class Users extends Auth
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = true;
    
    protected $fillable = [
        'username',
        'password',
        'id_level',  
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }
    
    public function warga()
    {
        return $this->hasOne(Warga::class, 'id_user');
    }
}

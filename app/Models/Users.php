<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Foundation\Auth\User as Auth;
use Illuminate\Support\Facades\Hash;

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

    public function urlDashboard(): string
    {
        $level = $this->level->level_kode;

        if (strpos($level, 'RT') === 0 && strlen($level) === 3) {
            return route('admin.index', ['rt' => substr($level, 2)]);
        }

        if ($level == 'RW') {
            return route('super-admin.index');
        }

        return route('user.index');
    }

    public static function checkCredentials($username, $password)
    {
        $user = self::where('username', $username)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return false;
        }

        return $user;
    }
}

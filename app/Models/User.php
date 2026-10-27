<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function files() {
        return $this->hasMany(File::class, 'user_id');
    }

    public function isSuper() {
        return $this->role == 'super';
    }

    public function usedSpace() {
        return File::where('user_id', $this->id)->sum('size');
    }

    public function userFriendlyUsedSpace() {
        $used = $this->usedSpace();

        if ($used >= 1048576) {
            return round($used / 1048576, 2) . ' GB';
        }

        if ($used >= 1024) {
            return round($used / 1024, 2) . ' MB';
        }
            
        return $used . ' KB';
    }
}

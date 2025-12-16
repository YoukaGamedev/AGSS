<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($user) {
            if (User::count() === 0) {
                $user->role = 'admin';
            }
        });
    }
}
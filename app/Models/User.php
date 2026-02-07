<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // RELATION
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

    public function management()
    {
        return $this->hasOne(Management::class);
    }
}


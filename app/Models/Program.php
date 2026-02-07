<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pilar',
        'description',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function impacts()
    {
        return $this->hasMany(Impact::class);
    }
}

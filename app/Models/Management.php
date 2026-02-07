<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $table = 'management';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'jabatan',
        'divisi',
        'status',
        'joined_at',
    ];
}
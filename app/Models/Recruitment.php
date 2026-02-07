<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $table = 'recruitments';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'jabatan',
        'divisi',
        'alamat_lengkap',
        'photo_path',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'motivasi',
        'status_recruitment',
        'applied_at',
        'accepted_at',
        'rejected_at',
        'rejection_reason',
    ];
}

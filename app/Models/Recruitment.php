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
        'divisi',
        'alamat_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'motivasi',
        'pas_foto',
        'screenshot_bukti',
        'cv',
        'status_recruitment',
        'applied_at',
        'accepted_at',
        'rejected_at',
        'rejection_reason',
    ];
}

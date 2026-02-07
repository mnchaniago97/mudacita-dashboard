<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerRecruitment extends Model
{
    use HasFactory;

    protected $table = 'volunteer_recruitments';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'alamat_lengkap',
        'photo_path',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'motivasi',
        'minat',
        'skill',
        'komitmen',
        'harapan',
        'status_recruitment',
        'applied_at',
        'accepted_at',
        'rejected_at',
        'rejection_reason',
    ];
}

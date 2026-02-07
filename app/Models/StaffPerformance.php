<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffPerformance extends Model
{
    protected $table = 'staff_performances';

    protected $fillable = [
        'management_id',
        'perencanaan',
        'pelaksanaan',
        'kualitas',
        'inovasi',
        'evaluasi',
        'analisis',
        'kolaborasi',
        'kepemimpinan',
        'etika',
        'dampak',
        'notes',
        'programs_success',
    ];
}

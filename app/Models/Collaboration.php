<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    protected $fillable = [
        'title',
        'partner_name',
        'partner_type',
        'program_id',
        'pilar',
        'start_date',
        'end_date',
        'status',
        'pic_name',
        'pic_phone',
        'description',
        'documentation_url',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

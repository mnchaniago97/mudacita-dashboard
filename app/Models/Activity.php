<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'location_id',
        'title',
        'activity_date',
        'activity_datetime',
        'person_in_charge',
        'short_description',
        'status',
        'documentation_url',
        'documentation_photo_path',
        'description',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'activity_datetime' => 'datetime',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function impacts()
    {
        return $this->hasMany(Impact::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Impact extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'description',
        'beneficiaries',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

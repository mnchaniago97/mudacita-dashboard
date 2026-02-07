<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    protected $fillable = [
        'title', 'location', 'event_date', 
        'start_time', 'end_time', 'description', 'category_id'
    ];
}
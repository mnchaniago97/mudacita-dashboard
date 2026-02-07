<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'province',
        'detail',
        'type',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}

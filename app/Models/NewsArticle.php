<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category_id',
        'author_name',
        'status',
        'published_at',
        'is_featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}

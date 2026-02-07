<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'org_name',
        'org_email',
        'org_phone',
        'org_address',
        'org_logo_path',
        'timezone',
        'locale',
        'whatsapp_enabled',
        'whatsapp_token',
        'whatsapp_url',
        'whatsapp_template',
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_image_path',
        'org_favicon_path',
    ];

    protected $casts = [
        'whatsapp_enabled' => 'boolean',
    ];
}

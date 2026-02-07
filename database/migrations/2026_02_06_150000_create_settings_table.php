<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('org_name')->nullable();
            $table->string('org_email')->nullable();
            $table->string('org_phone')->nullable();
            $table->text('org_address')->nullable();
            $table->string('org_logo_path')->nullable();
            $table->string('timezone')->default('Asia/Jakarta');
            $table->string('locale')->default('id');
            $table->boolean('whatsapp_enabled')->default(false);
            $table->text('whatsapp_token')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->text('whatsapp_template')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

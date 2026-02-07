<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('management', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone', 20)->nullable();

        $table->string('jabatan');
        $table->enum('divisi', ['program', 'riset', 'media']);

        $table->enum('status', ['active', 'inactive'])->default('active');

        $table->date('joined_at')->nullable();
        $table->timestamps();
});

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('management');
    }
};

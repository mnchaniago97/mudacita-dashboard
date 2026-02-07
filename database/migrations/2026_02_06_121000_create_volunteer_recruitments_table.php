<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteer_recruitments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 20)->nullable();

            $table->text('alamat_lengkap')->nullable();
            $table->string('photo_path')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->text('motivasi')->nullable();

            $table->string('minat')->nullable();
            $table->text('skill')->nullable();
            $table->string('komitmen')->nullable();
            $table->text('harapan')->nullable();

            $table->enum('status_recruitment', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamp('applied_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteer_recruitments');
    }
};

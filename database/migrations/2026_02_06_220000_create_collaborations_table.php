<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('partner_name');
            $table->string('partner_type');
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete();
            $table->enum('pilar', ['pendidikan', 'sosial', 'lingkungan'])->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['planned', 'ongoing', 'completed', 'cancelled'])->default('planned');
            $table->string('pic_name')->nullable();
            $table->string('pic_phone')->nullable();
            $table->text('description')->nullable();
            $table->string('documentation_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};

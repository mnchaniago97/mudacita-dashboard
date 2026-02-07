<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('staff_performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('management_id')->constrained('management')->cascadeOnDelete();
            $table->unsignedTinyInteger('effectiveness');
            $table->unsignedTinyInteger('efficiency');
            $table->unsignedTinyInteger('impact');
            $table->unsignedTinyInteger('programs_success')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_performances');
    }
};

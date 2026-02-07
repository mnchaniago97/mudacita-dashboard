<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('program_id')
                ->constrained('programs')
                ->cascadeOnDelete();

            $table->foreignId('location_id')
                ->constrained('locations')
                ->cascadeOnDelete();

            $table->string('title');
            $table->date('activity_date');
            $table->dateTime('activity_datetime')->nullable();
            $table->string('person_in_charge')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->enum('status', ['planned', 'ongoing', 'completed'])->default('planned');
            $table->string('documentation_url')->nullable();
            $table->string('documentation_photo_path')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};

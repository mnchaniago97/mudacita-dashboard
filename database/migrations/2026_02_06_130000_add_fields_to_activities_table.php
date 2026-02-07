<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dateTime('activity_datetime')->nullable()->after('activity_date');
            $table->string('person_in_charge')->nullable()->after('activity_datetime');
            $table->string('short_description', 500)->nullable()->after('person_in_charge');
            $table->enum('status', ['planned', 'ongoing', 'completed'])->default('planned')->after('short_description');
            $table->string('documentation_url')->nullable()->after('status');
            $table->string('documentation_photo_path')->nullable()->after('documentation_url');
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn([
                'activity_datetime',
                'person_in_charge',
                'short_description',
                'status',
                'documentation_url',
                'documentation_photo_path',
            ]);
        });
    }
};

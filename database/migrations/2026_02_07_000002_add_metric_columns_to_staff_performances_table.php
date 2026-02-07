<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('staff_performances', function (Blueprint $table) {
            $table->unsignedTinyInteger('perencanaan')->after('management_id');
            $table->unsignedTinyInteger('pelaksanaan')->after('perencanaan');
            $table->unsignedTinyInteger('kualitas')->after('pelaksanaan');
            $table->unsignedTinyInteger('inovasi')->after('kualitas');
            $table->unsignedTinyInteger('evaluasi')->after('inovasi');
            $table->unsignedTinyInteger('analisis')->after('evaluasi');
            $table->unsignedTinyInteger('kolaborasi')->after('analisis');
            $table->unsignedTinyInteger('kepemimpinan')->after('kolaborasi');
            $table->unsignedTinyInteger('etika')->after('kepemimpinan');
            $table->unsignedTinyInteger('dampak')->after('etika');

            $table->dropColumn(['effectiveness', 'efficiency', 'impact']);
        });
    }

    public function down(): void
    {
        Schema::table('staff_performances', function (Blueprint $table) {
            $table->unsignedTinyInteger('effectiveness')->after('management_id');
            $table->unsignedTinyInteger('efficiency')->after('effectiveness');
            $table->unsignedTinyInteger('impact')->after('efficiency');

            $table->dropColumn([
                'perencanaan',
                'pelaksanaan',
                'kualitas',
                'inovasi',
                'evaluasi',
                'analisis',
                'kolaborasi',
                'kepemimpinan',
                'etika',
                'dampak',
            ]);
        });
    }
};

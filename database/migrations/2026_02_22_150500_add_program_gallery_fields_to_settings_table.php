<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $types = ['pendidikan', 'sosial', 'lingkungan', 'digital'];

            foreach ($types as $type) {
                $columns = [
                    'program_' . $type . '_gallery_title' => 'text',
                    'program_' . $type . '_gallery_subtitle' => 'text',
                    'program_' . $type . '_gallery_btn_text' => 'text',
                    'program_' . $type . '_gallery_btn_url' => 'text',
                ];

                for ($i = 1; $i <= 3; $i++) {
                    $columns['program_' . $type . '_gallery_item' . $i . '_title'] = 'text';
                    $columns['program_' . $type . '_gallery_item' . $i . '_description'] = 'text';
                    $columns['program_' . $type . '_gallery_item' . $i . '_image'] = 'text';
                    $columns['program_' . $type . '_gallery_item' . $i . '_url'] = 'text';
                }

                foreach ($columns as $name => $columnType) {
                    if (!Schema::hasColumn('settings', $name)) {
                        if ($columnType === 'text') {
                            $table->text($name)->nullable();
                        } else {
                            $table->string($name)->nullable();
                        }
                    }
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $types = ['pendidikan', 'sosial', 'lingkungan', 'digital'];

            foreach ($types as $type) {
                $columns = [
                    'program_' . $type . '_gallery_title',
                    'program_' . $type . '_gallery_subtitle',
                    'program_' . $type . '_gallery_btn_text',
                    'program_' . $type . '_gallery_btn_url',
                ];

                for ($i = 1; $i <= 3; $i++) {
                    $columns[] = 'program_' . $type . '_gallery_item' . $i . '_title';
                    $columns[] = 'program_' . $type . '_gallery_item' . $i . '_description';
                    $columns[] = 'program_' . $type . '_gallery_item' . $i . '_image';
                    $columns[] = 'program_' . $type . '_gallery_item' . $i . '_url';
                }

                $existing = array_values(array_filter($columns, fn ($col) => Schema::hasColumn('settings', $col)));
                if (count($existing) > 0) {
                    $table->dropColumn($existing);
                }
            }
        });
    }
};

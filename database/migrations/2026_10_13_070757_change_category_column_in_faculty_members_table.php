<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('faculty_members', function (Blueprint $table) {
            $table->dropIndex(['category']);
        });

        // Convert existing scalar category values to JSON arrays
        DB::table('faculty_members')->get()->each(function ($row) {
            $cat = $row->category;
            if ($cat && ! str_starts_with((string) $cat, '[')) {
                $mapped = match ($cat) {
                    'dosen_klinis' => ['dosen_spesialis'],
                    'dosen_biomedik' => ['dosen_biomedik'],
                    'pimpinan' => ['pimpinan'],
                    default => [$cat],
                };

                DB::table('faculty_members')
                    ->where('id', $row->id)
                    ->update([
                        'category' => json_encode($mapped),
                    ]);
            }
        });

        Schema::table('faculty_members', function (Blueprint $table) {
            $table->text('category')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faculty_members', function (Blueprint $table) {
            $table->string('category', 50)->default('pimpinan')->change();
            $table->index('category');
        });
    }
};

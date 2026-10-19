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
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->text('name');
            $table->string('stage')->default('sarjana')->index(); // 'sarjana' (S.Ked) or 'profesi' (dr.)
            $table->unsignedTinyInteger('semester')->nullable()->index(); // 1 - 8
            $table->string('academic_phase')->nullable(); // 'Fase I', 'Fase II', 'Fase III', 'Fase IV'
            $table->unsignedTinyInteger('sks')->default(1);
            $table->string('type')->default('Blok Inti'); // 'Blok Inti', 'Skills Lab', 'MKDU', 'Riset', 'Stase Mayor', etc.
            $table->string('duration')->nullable(); // e.g. '10 Minggu', '4 Minggu'
            $table->string('location')->nullable(); // e.g. 'RSUD Praya', 'Kampus UBG'
            $table->text('description')->nullable();
            $table->string('api_id')->nullable()->index();
            $table->timestamp('synced_at')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculums');
    }
};

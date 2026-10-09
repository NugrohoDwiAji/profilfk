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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('degree', 20)->default('S1'); // S1, Profesi
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description');
            $table->text('curriculum_summary')->nullable();
            $table->json('career_prospects')->nullable();
            $table->unsignedSmallInteger('duration_semesters')->default(8);
            $table->string('degree_title', 50)->nullable(); // S.Ked, dr.
            $table->string('accreditation', 50)->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

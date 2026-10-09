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
        Schema::create('faculty_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('academic_title')->nullable();
            $table->string('position'); // Dekan, Wakil Dekan, Dosen, dsb.
            $table->string('category', 50)->default('dosen'); // pimpinan, dosen_klinis, dosen_biomedik
            $table->string('specialization');
            $table->string('department')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('email')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_members');
    }
};

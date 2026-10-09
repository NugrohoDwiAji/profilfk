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
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category', 50)->default('Penelitian'); // Penelitian, Pengabdian Masyarakat, Publikasi Ilmiah
            $table->string('leader_name');
            $table->text('summary');
            $table->longText('description')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('partner_institution')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('status', 20)->default('published'); // published, draft
            $table->timestamps();

            $table->index(['status', 'publication_date']);
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_projects');
    }
};

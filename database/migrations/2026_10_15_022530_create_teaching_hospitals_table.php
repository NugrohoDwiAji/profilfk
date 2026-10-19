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
        Schema::create('teaching_hospitals', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->unique();
            $table->string('type', 50)->default('utama');
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->default('Nusa Tenggara Barat');
            $table->string('phone', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('website_url')->nullable();
            $table->text('google_maps_url')->nullable();
            $table->string('accreditation', 100)->nullable();
            $table->string('capacity', 100)->nullable();
            $table->string('director_name')->nullable();
            $table->json('departments')->nullable();
            $table->json('facilities')->nullable();
            $table->string('mou_number')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(1);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_hospitals');
    }
};

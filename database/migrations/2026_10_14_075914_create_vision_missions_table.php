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
        Schema::create('vision_missions', function (Blueprint $table) {
            $table->id();
            $table->string('scope')->unique();
            $table->json('name');
            $table->json('eyebrow');
            $table->json('vision_title');
            $table->json('vision');
            $table->json('highlights')->nullable();
            $table->json('mission_title');
            $table->json('missions');
            $table->string('theme_color')->default('blue');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vision_missions');
    }
};

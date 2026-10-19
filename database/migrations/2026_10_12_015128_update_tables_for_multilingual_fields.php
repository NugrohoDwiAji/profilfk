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
        Schema::table('programs', function (Blueprint $table) {
            $table->text('name')->change();
            $table->text('tagline')->nullable()->change();
        });

        Schema::table('faculty_members', function (Blueprint $table) {
            $table->text('name')->change();
            $table->text('academic_title')->nullable()->change();
            $table->text('position')->change();
            $table->text('specialization')->nullable()->change();
            $table->text('department')->nullable()->change();
        });

        Schema::table('facilities', function (Blueprint $table) {
            $table->text('name')->change();
        });

        Schema::table('research_projects', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('leader_name')->change();
            $table->text('partner_institution')->nullable()->change();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->text('title')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

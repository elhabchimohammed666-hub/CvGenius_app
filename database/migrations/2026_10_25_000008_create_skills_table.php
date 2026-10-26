<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->nullable()->constrained('cvs')->cascadeOnDelete();
            $table->foreignId('portfolio_id')->nullable()->constrained('portfolios')->cascadeOnDelete();
            $table->string('name');
            $table->string('category')->nullable();
            $table->unsignedTinyInteger('level')->nullable();
            $table->timestamps();

            $table->index(['cv_id', 'category']);
            $table->index(['portfolio_id', 'category']);
        });

        DB::statement(
            'ALTER TABLE skills ADD CONSTRAINT chk_skills_owner '
            . 'CHECK ((cv_id IS NOT NULL AND portfolio_id IS NULL) OR (cv_id IS NULL AND portfolio_id IS NOT NULL))'
        );
        DB::statement(
            'ALTER TABLE skills ADD CONSTRAINT chk_skills_level CHECK (level IS NULL OR level BETWEEN 1 AND 5)'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};

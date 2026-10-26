<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->nullable()->constrained('cvs')->cascadeOnDelete();
            $table->foreignId('portfolio_id')->nullable()->constrained('portfolios')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->text('project_url')->nullable();
            $table->text('github_url')->nullable();
            $table->json('technologies')->nullable();
            $table->timestamps();

            $table->index(['cv_id', 'created_at']);
            $table->index(['portfolio_id', 'created_at']);
        });

        DB::statement(
            'ALTER TABLE projects ADD CONSTRAINT chk_projects_owner '
            . 'CHECK ((cv_id IS NOT NULL AND portfolio_id IS NULL) OR (cv_id IS NULL AND portfolio_id IS NOT NULL))'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

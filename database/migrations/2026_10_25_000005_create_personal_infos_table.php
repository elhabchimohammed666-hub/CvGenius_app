<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->nullable()->unique()->constrained('cvs')->cascadeOnDelete();
            $table->foreignId('portfolio_id')->nullable()->unique()->constrained('portfolios')->cascadeOnDelete();
            $table->string('full_name');
            $table->string('job_title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('website')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('github')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });

        DB::statement(
            'ALTER TABLE personal_infos ADD CONSTRAINT chk_personal_infos_owner '
            . 'CHECK ((cv_id IS NOT NULL AND portfolio_id IS NULL) OR (cv_id IS NULL AND portfolio_id IS NOT NULL))'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};

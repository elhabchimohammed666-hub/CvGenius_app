<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->nullable()->constrained('cvs')->cascadeOnDelete();
            $table->foreignId('portfolio_id')->nullable()->constrained('portfolios')->cascadeOnDelete();
            $table->string('institution');
            $table->string('degree');
            $table->string('field_of_study')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['cv_id', 'start_date']);
            $table->index(['portfolio_id', 'start_date']);
        });

        DB::statement(
            'ALTER TABLE educations ADD CONSTRAINT chk_educations_owner '
            . 'CHECK ((cv_id IS NOT NULL AND portfolio_id IS NULL) OR (cv_id IS NULL AND portfolio_id IS NOT NULL))'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};

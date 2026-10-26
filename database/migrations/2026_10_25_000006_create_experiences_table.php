<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_id')->nullable()->constrained('cvs')->cascadeOnDelete();
            $table->foreignId('portfolio_id')->nullable()->constrained('portfolios')->cascadeOnDelete();
            $table->string('company');
            $table->string('position');
            $table->string('location')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['cv_id', 'start_date']);
            $table->index(['portfolio_id', 'start_date']);
        });

        DB::statement(
            'ALTER TABLE experiences ADD CONSTRAINT chk_experiences_owner '
            . 'CHECK ((cv_id IS NOT NULL AND portfolio_id IS NULL) OR (cv_id IS NULL AND portfolio_id IS NOT NULL))'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};

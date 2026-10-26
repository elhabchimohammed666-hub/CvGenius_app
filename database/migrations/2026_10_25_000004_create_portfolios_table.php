<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->foreignId('template_id')->nullable()->constrained('templates')->nullOnDelete();
            $table->json('theme')->nullable();
            $table->string('slug')->unique();
            $table->string('custom_domain')->nullable()->unique();
            $table->text('bio')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

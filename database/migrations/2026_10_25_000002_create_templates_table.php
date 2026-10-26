<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['cv', 'portfolio']);
            $table->string('thumbnail')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->string('view_path');
            $table->timestamps();

            $table->index(['type', 'is_premium']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};

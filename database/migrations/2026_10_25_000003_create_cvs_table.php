<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->foreignId('template_id')->nullable()->constrained('templates')->nullOnDelete();
            $table->string('primary_color', 7)->default('#2563EB');
            $table->string('font_family')->default('Inter');
            $table->string('language', 10)->default('fr');
            $table->string('public_slug')->nullable()->unique();
            $table->boolean('is_public')->default(false);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navbar_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path')->nullable();
            $table->boolean('show_contact_button')->default(false);
            $table->string('contact_phone')->nullable();
            $table->json('social_links')->nullable(); // Almacenará links de redes sociales como JSON
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navbar_settings');
    }
};

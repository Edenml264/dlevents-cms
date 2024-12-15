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
        Schema::table('navbar_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('navbar_settings', 'contact_button_text')) {
                $table->string('contact_button_text')->nullable();
            }
            if (!Schema::hasColumn('navbar_settings', 'show_contact_button')) {
                $table->boolean('show_contact_button')->default(false);
            }
            if (!Schema::hasColumn('navbar_settings', 'social_links')) {
                $table->json('social_links')->nullable();
            }
            if (!Schema::hasColumn('navbar_settings', 'logo')) {
                $table->string('logo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('navbar_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_button_text',
                'show_contact_button',
                'social_links',
                'logo'
            ]);
        });
    }
};

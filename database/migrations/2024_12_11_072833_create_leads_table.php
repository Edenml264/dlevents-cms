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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('event_type');
            $table->date('event_date');
            $table->text('message');
            $table->enum('status', ['nuevo', 'contactado', 'en_seguimiento', 'convertido', 'perdido'])
                  ->default('nuevo');
            $table->text('notes')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->integer('guests_count')->nullable();
            $table->timestamp('last_contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

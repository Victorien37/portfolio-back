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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('zipcode')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->foreignId('image_id')->nullable()->constrained();
            $table->string('qualification');
            $table->string('qualification_short');
            $table->string('option')->nullable();
            $table->string('option_short')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};

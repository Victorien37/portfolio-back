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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('contract', ['CDI', 'CDD', 'Freelance', 'Stage', 'Alternance'])->nullable();
            $table->string('job_title');
            $table->boolean('linked_job')->default(false);
            $table->foreignId('company_id')->constrained()->nullable();
            $table->foreignId('school_id')->constrained()->nullable();
            $table->string('qualification')->nullable();
            $table->string('qualification_short')->nullable();
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
        Schema::dropIfExists('experiences');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Homepage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Homepage::create([
            'messages' => 'Bienvenue sur mon site',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Homepage::first()->delete();
    }
};

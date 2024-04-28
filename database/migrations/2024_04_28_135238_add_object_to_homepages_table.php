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
        Schema::table('homepages', function (Blueprint $table) {
            $table->foreignId('image_id')->nullable()->change();
        });

        Homepage::create([
            'messages'  => 'Welcome to my website!',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->foreignId('image_id')->nullable(false)->change();
        });

        Homepage::first()->delete();
    }
};

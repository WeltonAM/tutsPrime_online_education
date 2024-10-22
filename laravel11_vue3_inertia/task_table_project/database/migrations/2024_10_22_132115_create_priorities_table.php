<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('priorities')->insert([
            ['name' => 'low', 'description' => 'This task is not important', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'medium', 'description' => 'This task is important', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'high', 'description' => 'This task is very important', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priorities');
    }
};

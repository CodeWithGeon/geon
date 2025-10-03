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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    // public function down(Blueprint $table): void
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         // 
    //     });
    // }
    public function down(): void
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        
    }
};

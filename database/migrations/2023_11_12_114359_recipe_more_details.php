<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('recipe_more_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->string('duration', 20);
            $table->string('good_for', 20);
            $table->string('difficulty', 20);
            $table->string('budget', 20);
            $table->timestamps();

            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('recipe_more_infos');
    }
};

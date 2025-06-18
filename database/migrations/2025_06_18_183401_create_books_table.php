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
    /*
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }*/
    {
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->integer('year');
        $table->text('details')->nullable(); // Can be empty
        $table->string('picture')->nullable(); // Stores the path to the image
        $table->timestamps(); // Adds created_at and updated_at columns
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

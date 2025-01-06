<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->bigInteger('id_plants')->unsigned(); // Foreign key referencing content table

            // Reviews attributes
            $table->text('name');
            $table->text('rating');
            $table->text('comment');

            $table->timestamps(); // Created and updated at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_plants', function (Blueprint $table) {
            $table->id(); // Primary key

            // Reviews attributes
            $table->text('history');
            $table->text('videos');
            $table->text('image');

            $table->timestamps(); // Created and updated at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_plants');
    }
};

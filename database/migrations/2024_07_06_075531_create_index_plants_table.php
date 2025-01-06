<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('index_plants', function (Blueprint $table) {
            $table->id(); // Primary key
            
            // Index Plant attributes
            $table->text('name');
            $table->text('genus');
            $table->text('species');

            $table->timestamps(); // Created and updated at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('index_plants');
    }
};

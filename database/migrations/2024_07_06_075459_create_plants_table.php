<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id(); // Primary key

            // Plant attributes
            $table->bigInteger('id_index_plants')->unsigned(); // Foreign key referencing index_plant table
            $table->bigInteger('id_content_plants')->unsigned(); // Foreign key referencing content table
            $table->double('tall');
            $table->double('round');
            $table->text('location');
            $table->dateTime('date_plant');
            $table->text('source_fund');
            $table->text('qr_code');

            $table->timestamps(); // Created and updated at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};

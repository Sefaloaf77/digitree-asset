<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id('id')->primary();
            $table->integer('code_asset');
            $table->integer('id_content_asset');
            $table->double('large');
            $table->string('value')->nullable();
            $table->integer('age')->nullable();
            $table->string('location', 100);
            $table->string('date_open')->nullable();
            $table->string('organizer')->nullable();
            $table->text('address')->nullable();
            $table->integer('id_village')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};

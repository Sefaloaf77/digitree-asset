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
        Schema::create('record_scans', function (Blueprint $table) {
            $table->id('id')->primary(true);
            $table->integer('code_asset');
            $table->string('ip_address', 100)->nullable();
            $table->string('location')->nullable();
            $table->dateTime('scan_date')->nullable();

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
        Schema::dropIfExists('record_scans');
    }
};

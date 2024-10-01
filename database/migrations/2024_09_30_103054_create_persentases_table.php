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
        Schema::create('persentases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('satuans_id');
            $table->string('persentase')->nullable();
            $table->timestamps();

            $table->foreign('satuans_id')->references('id')->on('satuans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persentases');
    }
};

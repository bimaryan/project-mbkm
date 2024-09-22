<?php

use App\Models\Kategori;
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
        Schema::create('spo_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('Kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spo_dokumens');
    }
};

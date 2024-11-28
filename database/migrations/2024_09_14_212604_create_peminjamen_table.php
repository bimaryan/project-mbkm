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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->unsignedBigInteger('matkul_id');
            $table->unsignedBigInteger('dosen_id');
            $table->string('tgl_pinjam');
            $table->string('waktu_pinjam');
            $table->string('waktu_kembali');
            $table->string('SPO')->nullable();
            $table->enum('status_pengembalian', ['Belum', 'Diserahkan', 'Habis'])->default('Belum');
            $table->enum('aprovals', ['Ya', 'Tidak', 'Belum']);
            $table->enum('status', ['Dipinjam', 'Dikembalikan', 'Menunggu Persetujuan']);
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreign('matkul_id')->references('id')->on('mata_kuliahs')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};

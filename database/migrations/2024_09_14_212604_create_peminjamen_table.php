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
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('spo_id');
            $table->unsignedBigInteger('rooms_id');
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->string('matkul');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->string('keterangan')->nullable();
            $table->enum('diserahkan', ['Sudah', 'Belum'])->nullable();
            $table->enum('aprovals', ['Ya', 'Tidak','Belum']);
            $table->enum('status', ['Dipinjam', 'Dikembalikan','Menunggu Persetujuan']);
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
            $table->foreign('spo_id')->references('id')->on('spo_dokumens')->onDelete('cascade');
            $table->foreign('rooms_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');
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

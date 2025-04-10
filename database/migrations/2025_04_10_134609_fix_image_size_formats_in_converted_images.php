<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus semua record yang sudah ada, karena datanya sudah tidak valid
        // (Karena sudah menyimpan string, bukan angka)
        DB::table('converted_images')->truncate();
        
        // Mengubah tipe data kolom di tabel converted_images
        Schema::table('converted_images', function (Blueprint $table) {
            // Ubah tipe data menjadi bigInteger
            $table->bigInteger('original_size')->nullable()->change();
            $table->bigInteger('converted_size')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan tipe data kolom ke string jika diperlukan
        Schema::table('converted_images', function (Blueprint $table) {
            $table->string('original_size')->nullable()->change();
            $table->string('converted_size')->nullable()->change();
        });
    }
};

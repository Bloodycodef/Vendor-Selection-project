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
        Schema::create('item_price_histories', function (Blueprint $table) {
            $table->id();

            // Perbaikan: Merujuk ke tabel 'vendor' dan kolom 'id_vendor'
            $table->foreignId('id_vendor')
                ->constrained('vendor', 'id_vendor')
                ->cascadeOnDelete();

            // Perbaikan: Merujuk ke tabel 'item' dan kolom 'id_item'
            $table->foreignId('id_item')
                ->constrained('item', 'id_item')
                ->cascadeOnDelete();

            $table->decimal('harga_sebelum', 20, 2); // Menggunakan 20,2 sesuai ERD awal
            $table->decimal('harga_sekarang', 20, 2);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_price_histories');
    }
};

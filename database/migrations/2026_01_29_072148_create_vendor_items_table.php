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
        Schema::create('vendor_item', function (Blueprint $table) {
            $table->id('id_vendor_item');
            $table->foreignId('id_vendor')->constrained('vendor', 'id_vendor')->onDelete('cascade');
            $table->foreignId('id_item')->constrained('item', 'id_item')->onDelete('cascade');
            $table->decimal('harga_sebelum', 20, 2);
            $table->decimal('harga_sekarang', 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_items');
    }
};

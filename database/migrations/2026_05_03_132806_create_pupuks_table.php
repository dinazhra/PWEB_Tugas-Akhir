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
        Schema::create('pupuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();        // PRD-001
            $table->string('nama');                  // Urea Granul
            $table->enum('kategori', ['Kimia', 'Organik', 'Cair']);
            $table->integer('stok');
            $table->decimal('harga', 10, 2);
            $table->date('tanggal_masuk');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pupuks');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('nama_penerima');

            $table->string('no_hp');

            $table->text('alamat');

            $table->string('metode_pembayaran');

            $table->text('catatan')->nullable();

            $table->decimal('total', 12, 2);

            $table->string('status')
                  ->default('diproses');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
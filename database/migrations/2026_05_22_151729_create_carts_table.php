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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // user customer
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // produk pupuk
            $table->foreignId('pupuk_id')
                ->constrained('pupuks')
                ->onDelete('cascade');

            // jumlah item
            $table->integer('qty')->default(1);

            $table->timestamps();

            // biar user tidak punya produk duplicate
            $table->unique([
                'user_id',
                'pupuk_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
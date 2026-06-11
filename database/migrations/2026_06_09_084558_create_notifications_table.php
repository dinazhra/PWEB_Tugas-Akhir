<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // Penerima notifikasi
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Tipe notif: 'new_order' | 'low_stock' | 'order_status'
            $table->string('type');

            // Pesan yang ditampilkan
            $table->string('message');

            // Data tambahan (opsional): order_id, pupuk_id, dll
            $table->json('data')->nullable();

            // Sudah dibaca atau belum
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
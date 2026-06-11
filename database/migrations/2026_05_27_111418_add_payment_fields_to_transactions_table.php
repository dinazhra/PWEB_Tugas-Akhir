<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'transactions',
            function (Blueprint $table) {

                $table->string(
                    'nama_pengirim'
                )->nullable();

                $table->string(
                    'bank_pengirim'
                )->nullable();

                $table->bigInteger(
                    'nominal_transfer'
                )->nullable();

                $table->string(
                    'bukti_transfer'
                )->nullable();

            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'transactions',
            function (Blueprint $table) {

                $table->dropColumn([
                    'nama_pengirim',
                    'bank_pengirim',
                    'nominal_transfer',
                    'bukti_transfer',
                ]);
            }
        );
    }
};
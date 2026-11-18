<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lindungi buku agar tidak ikut terhapus ketika author dihapus.
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::table('books', function (Blueprint $table) {
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->restrictOnDelete();
        });

        // Lindungi riwayat transaksi agar tidak ikut terhapus
        // ketika akun customer dihapus.
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::table('books', function (Blueprint $table) {
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->cascadeOnDelete();
        });
    }
};
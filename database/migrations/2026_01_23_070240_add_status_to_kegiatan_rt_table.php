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
        Schema::table('kegiatan_rt', function (Blueprint $table) {
            $table->enum('status', ['Akan Datang', 'Selesai', 'Batal'])->default('Akan Datang')->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_rt', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

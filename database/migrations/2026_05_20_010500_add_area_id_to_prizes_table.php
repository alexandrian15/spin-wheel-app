<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prizes', function (Blueprint $table) {

            // nullable dulu agar data lama aman
            $table->unsignedBigInteger('area_id')
                  ->nullable()
                  ->after('id');

        });

        // isi default area_id = 1 untuk data lama
        DB::table('prizes')
            ->whereNull('area_id')
            ->update([
                'area_id' => 1
            ]);

        Schema::table('prizes', function (Blueprint $table) {

            // baru buat foreign key
            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('prizes', function (Blueprint $table) {

            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');

        });
    }
};
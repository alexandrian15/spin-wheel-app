<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('history_spin', function (Blueprint $table) {

            $table->unsignedBigInteger('area_id')
                  ->nullable()
                  ->after('id');

        });

        DB::table('history_spin')->update([
            'area_id' => 1
        ]);

        Schema::table('history_spin', function (Blueprint $table) {

            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('history_spin', function (Blueprint $table) {

            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');

        });
    }
};
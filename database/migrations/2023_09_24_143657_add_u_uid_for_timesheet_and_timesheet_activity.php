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
        Schema::table('timeSheet', function (Blueprint $table) {
            $table->uuid()->nullable();
        });

        Schema::table('timeSheetActivity', function (Blueprint $table) {
            $table->uuid()->nullable();
        });

        Schema::table('timeSheet_submit', function (Blueprint $table) {
            $table->uuid()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timeSheet', function (Blueprint $table) {
            $table->removeColumn("uuid");
        });

        Schema::table('timeSheetActivity', function (Blueprint $table) {
            $table->removeColumn("uuid");
        });

        Schema::table('timeSheet_submit', function (Blueprint $table) {
            $table->removeColumn("uuid");
        });
    }
};

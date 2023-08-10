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
        Schema::table('group_timeline', function (Blueprint $table) {
            $table->foreignId("idProject")->nullable()->references("id")->on("projects")->onDelete("cascade")->onUpdate("cascade");
            $table->integer("order")->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_timeline', function (Blueprint $table) {
            $table->removeColumn("idProject");
            $table->removeColumn("order");
        });
    }
};

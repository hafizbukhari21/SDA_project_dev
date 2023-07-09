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
        Schema::create('group_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('Group');
        });

        Schema::table('projects_timeline', function (Blueprint $table) {
           $table->foreignId("idGroup")->nullable()->references("id")->on("group_timeline")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};

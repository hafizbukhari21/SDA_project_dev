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
        Schema::create('projects_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->foreignId('project_id')->references('id')->on('projects');
            $table->dateTime("from");
            $table->dateTime("to");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_timeline');
    }
};

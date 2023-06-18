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
        
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            
            //PIC
            $table->unsignedBigInteger('pic_id');
            $table->foreign('pic_id')->references('id')->on('users');

            $table->string('category');
            $table->text('status');
            $table->float('time');
            $table->integer('urgensi');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

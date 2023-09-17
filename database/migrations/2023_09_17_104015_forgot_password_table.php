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
        Schema::create('forget_password', function (Blueprint $table) {
           $table->id();
           $table->foreignId("idUser")->nullable()->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
           $table->string("hash");
           $table->dateTime("expiredTime");
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

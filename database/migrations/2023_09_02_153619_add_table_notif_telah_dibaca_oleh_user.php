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
        Schema::create('notif_read', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('id_notif')->references('id')->on('notification')->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId('id_user')->references('id')->on('users')->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notif_read');
    }
};

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
        Schema::create('timeSheet', function (Blueprint $table) {
            $table->id();
            $table->foreignId("idUser")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->softDeletes();
        });

        Schema::create('timeSheetActivity', function (Blueprint $table) {
            $table->id();
            $table->foreignId("timeSheet_id")->references("id")->on("timeSheet")->onDelete("cascade")->onUpdate("cascade");
            $table->string("title");
            $table->text("detail Activity");
            $table->enum("status",["rej","apv","rev","new"]);
            $table->enum("status_present",["present","sick","noreason"]);
            $table->softDeletes();
        });

        Schema::create('timeSheet_submit', function (Blueprint $table) {
            $table->id();
            $table->foreignId("timeSheet_id")->references("id")->on("timeSheet")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("idUser_Head_approval")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->enum("status_submit",["rej","apv","rev","new"]);
            $table->text("message");
            $table->date("submitDate");
            $table->softDeletes();
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

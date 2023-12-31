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
        Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->enum("group",["timeline","timesheet"]);
            $table->foreignId("timelineId")->nullable()->references("id")->on("projects_timeline")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("timesheetsubmitId")->nullable()->references("id")->on("timeSheet_submit")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');

    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teamleader', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('class_id')->on('team')->onUpdate('cascade')->cascadeOnDelete();;
//            $table->unsignedBigInteger('team_id');
//            $table->foreign('team_id')->references('team_number')->on('team')->onUpdate('cascade')->cascadeOnDelete();;
            $table->unsignedBigInteger('leader_id');
            $table->foreign('leader_id')->references('teammate_id')->on('team')->onUpdate('cascade')->cascadeOnDelete();;
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leader');
    }
};

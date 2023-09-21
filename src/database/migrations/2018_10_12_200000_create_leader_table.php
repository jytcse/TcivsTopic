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
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('team')->onUpdate('cascade')->cascadeOnDelete();
//            $table->unsignedBigInteger('team_id');
//            $table->foreign('team_id')->references('team_number')->on('team')->onUpdate('cascade')->cascadeOnDelete();;
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('teammate')->onUpdate('cascade')->cascadeOnDelete();;
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

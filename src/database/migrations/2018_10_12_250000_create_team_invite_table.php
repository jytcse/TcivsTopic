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

        Schema::create('team_invite', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->comment('發送組別');
            $table->foreign('team_id')->references('id')->on('team')->onUpdate('cascade')->cascadeOnDelete();
            $table->foreignId('recipient')->comment('接受者')->constrained('users')->onUpdate('cascade')->cascadeOnDelete();
            $table->boolean('accept_state')->comment('接受狀態')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_invite');
    }
};

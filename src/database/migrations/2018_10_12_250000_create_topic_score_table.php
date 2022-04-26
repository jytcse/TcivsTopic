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

        Schema::create('topic_score', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->comment('哪個專題')->constrained('topic')->onUpdate('cascade')->cascadeOnDelete();
            $table->integer("score")->comment("分數");
//            $table->integer("scorer")->comment("評分者");
            $table->foreignId('user_id')->comment('評分者')->constrained('users')->onUpdate('cascade')->cascadeOnDelete();
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
        Schema::dropIfExists('topic_score');
    }
};

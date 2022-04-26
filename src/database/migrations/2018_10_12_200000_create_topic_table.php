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
        Schema::create('topic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id')->comment("指導老師");
            $table->foreign('teacher_id')->references('id')->on('users')->onUpdate('cascade')->cascadeOnDelete();
            $table->unsignedBigInteger('belong_to')->comment("屬於哪個隊長的隊伍");
            $table->foreign('belong_to')->references('id')->on('teamleader')->onUpdate('cascade')->cascadeOnDelete();
            $table->string("topic_name")->comment("專題名稱");
            $table->text('topic_motivation')->comment("動機")->nullable();
            $table->text('topic_content')->comment("內容")->nullable();

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
        Schema::dropIfExists('topic');
    }
};

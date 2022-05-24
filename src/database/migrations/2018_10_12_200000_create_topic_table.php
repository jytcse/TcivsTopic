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
            $table->unsignedBigInteger('team_id')->comment("屬於哪個隊伍")->nullable();
            $table->foreign('team_id')->references('id')->on('team')->onUpdate('cascade')->onDelete('set null');
            $table->string("topic_name")->comment("專題名稱");
            $table->longText("topic_thumbnail")->nullable()->comment("專題封面圖");
            $table->text('topic_motivation')->comment("動機")->nullable();
            $table->text('topic_content')->comment("內容")->nullable();
            $table->timestamps();
            $table->softDeletes();
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

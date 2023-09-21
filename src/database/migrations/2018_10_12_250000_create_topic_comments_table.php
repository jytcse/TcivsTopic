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

        Schema::create('topic_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->comment('哪個專題')->constrained('topic')->onUpdate('cascade')->cascadeOnDelete();
            $table->text("comment")->comment("評論");
            $table->foreignId('user_id')->comment('評論者')->constrained('users')->onUpdate('cascade')->cascadeOnDelete();
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
        Schema::dropIfExists('topic_comments');
    }
};

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

        Schema::create('topic_doc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->comment('哪個專題')->constrained('topic')->onUpdate('cascade')->cascadeOnDelete();
            $table->string("file_name")->comment("檔案名稱");
            $table->longText("file_path")->comment("檔案路徑");
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
        Schema::dropIfExists('topic_doc');
    }
};

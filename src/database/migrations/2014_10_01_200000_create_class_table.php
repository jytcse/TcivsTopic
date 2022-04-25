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
        Schema::create('class', function (Blueprint $table) {
            $table->id();
            $table->string("years")->comment("入學年度");
            $table->enum("class_type", ["甲", "乙","老師"])->comment("班別(甲乙)");
//            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table("class")->insert(["years"=>"老師","class_type"=>"老師"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class');
    }
};

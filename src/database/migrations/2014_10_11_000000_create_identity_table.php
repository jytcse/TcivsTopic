<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique()->comment("身份");
//            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table("identity")->insert(["type"=>"學生"]);
        \Illuminate\Support\Facades\DB::table("identity")->insert(["type"=>"老師"]);
        \Illuminate\Support\Facades\DB::table("identity")->insert(["type"=>"系統管理員"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity');
    }
};

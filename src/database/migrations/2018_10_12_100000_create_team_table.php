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
//        $teamNumber = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"];

        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->comment('班級')->constrained('class')->onUpdate('cascade')->cascadeOnDelete();
            $table->enum("team_number",[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20])->comment('班級中第幾隊');
            $table->foreignId('teammate_id')->unique()->comment('隊員')->constrained('users')->onUpdate('cascade')->cascadeOnDelete();
//            $table->foreignId('teamleader_id')->comment('隊長')->constrained('users')->onUpdate('cascade')->nullOnDelete();
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
        Schema::dropIfExists('team');
    }
};

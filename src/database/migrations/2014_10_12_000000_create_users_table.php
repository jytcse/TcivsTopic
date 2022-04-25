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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique()->comment('學號');
            $table->string('name')->comment('姓名');
            $table->string('email')->comment('信箱')->unique();
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('密碼');
            $table->foreignId('identity_id')->comment('身份')->constrained('identity')->onUpdate('cascade')->cascadeOnDelete();
            $table->foreignId('class_id')->comment('學年班級')->constrained('class')->onUpdate('cascade')->cascadeOnDelete();

            //            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique()->comment('學號');
            $table->string('name')->comment('姓名');
            $table->string('email')->comment('信箱')->unique()->nullable();
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('密碼');
            $table->foreignId('identity_id')->comment('身份')->constrained('identity')->onUpdate('cascade')->cascadeOnDelete();
            $table->foreignId('class_id')->comment('學年班級')->constrained('class')->onUpdate('cascade')->cascadeOnDelete();

            //            $table->rememberToken();
            $table->timestamps();
        });
//        \Illuminate\Support\Facades\DB::table("users")->insert(["student_id" => '810612', 'email' => 'u810612@tcivs.tc.edu.tw', "name" => "王鈞霖", 'password' => '$2y$10$uGrmPQX3Z2aedkQ44lRFOegZ7CW4qy/nzRK2xq6rmImU7SATXDgVO', 'identity_id' => 1, 'class_id' => 8]);
//        \Illuminate\Support\Facades\DB::table("users")->insert(["student_id" => '810650', 'email' => 'u810650@tcivs.tc.edu.tw', "name" => "福旺來", 'password' => '$2y$10$uGrmPQX3Z2aedkQ44lRFOegZ7CW4qy/nzRK2xq6rmImU7SATXDgVO', 'identity_id' => 1, 'class_id' => 8]);
        \Illuminate\Support\Facades\DB::table("users")->insert(["student_id" => '老師', 'email' => null, "name" => "劉老師", 'password' => '$2y$10$uGrmPQX3Z2aedkQ44lRFOegZ7CW4qy/nzRK2xq6rmImU7SATXDgVO', 'identity_id' => 2, 'class_id' => 1]);
        \Illuminate\Support\Facades\DB::table("users")->insert(["student_id" => 'admin', 'email' => null, "name" => "admin", 'password' => '$2y$10$P20pdrO/bOJVxvCLeTYVeuhL4Qh6d0jEO4nNsOT3pEK3Lo75Rokj.', 'identity_id' => 3, 'class_id' => 1]);

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

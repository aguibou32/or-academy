<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticalModuleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practical_module_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('practical_id');
            $table->unsignedBigInteger('module_user_id');
            $table->string('mark');
            $table->string('practical_submission_file');
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
        Schema::dropIfExists('practical_module_user');
    }
}

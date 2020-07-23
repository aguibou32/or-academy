<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_notices', function (Blueprint $table) {
            $table->id();
            $table->string('notice_title');
            $table->longText("notice_body");
            $table->unsignedBigInteger('module_id');
            $table->timestamps();

            $table->timestamp('deleted_at')->nullable();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_notices');
    }
}

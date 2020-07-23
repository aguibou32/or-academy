<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_notes', function (Blueprint $table) {
            $table->id();
            $table->string('lecture_name');
            $table->string('file_name')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('module_notes');
    }
}

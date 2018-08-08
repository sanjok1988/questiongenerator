<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');           
            $table->integer('exam_type_id');  
            $table->integer("fm"); 
            $table->integer("pm");
            $table->integer("subject_id");
            $table->string("semester");
            $table->string("duration");
            $table->string('date');  
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
        Schema::dropIfExists('exams');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id'); // autoincrement id field
            $table->string('text', 500);   // string field
            $table->string('image_url', 500);   // string field
            $table->string('information', 5000);   // string field
            $table->string('answer', 100);   // string field
            $table->string('answer_type', 15);   // string field
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
        Schema::dropIfExists('questions');
    }
}

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
        // Create answers table
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer', 255);
            $table->bigInteger('question_id')->nullable()->unsigned();
            $table->bigInteger('guest_id')->nullable()->unsigned();
            $table->timestamps();

            // foreign keys
            //with questions table
            $table->foreign('question_id')->references('id')->on('questions');
            //with guest table
            $table->foreign('guest_id')->references('id')->on('guests');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
};

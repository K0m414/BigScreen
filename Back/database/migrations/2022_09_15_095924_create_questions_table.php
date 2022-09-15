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
        // Create questions table 
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question', 255);
            $table->enum('question_type', ['A', 'B', 'C']);
            $table->string('answer_choice', 255)->nullable();
            $table->bigInteger('survey_id')->nullable()->unsigned();
            $table->timestamps();
            
            // forein key with surveys table
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');

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
};

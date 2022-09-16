<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [ "question","question_type", "answer_choice", "survey_id"];

    // many questions has one survey  
    public function survey()
    {
        //create the relation many to one 
        return $this->hasMany(Survey::class);
    }

    // many answers belongs to one question
        public function answer()
    {
        //create the relation many to one 
        return $this->belongsTo(Answer::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['answer', "question_id", "guest_id"];

    //one quetion has many answers
    public function question()
    {
        //create the relation one to many 
        return $this->hasMany(Question::class);
    }
    //one guest has many answers
    public function guest()
    {
        //create the relation one to many 
        return $this->hasMany(Guest::class);
    }

}

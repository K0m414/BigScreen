<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['email', "link"];

    // many answers belongs to one guest
    public function answer()
    {
        //create the relation many to one 
        return $this->belongsTo(Answer::class);
    }
}

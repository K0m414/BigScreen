<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    // one survey belongs to many questions  
    public function question()
    {
        //create the relation many to one 
        return $this->belongsTo(Question::class);
    }
}

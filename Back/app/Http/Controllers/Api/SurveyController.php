<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Guest;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\Question;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $survey = Survey::all();
        // return all data in survey table
        // dd($survey);
        return response()->json([
            'status' => true,
            'surveys'=> $survey,
        ]);
    }

   
    
    
 
    
}

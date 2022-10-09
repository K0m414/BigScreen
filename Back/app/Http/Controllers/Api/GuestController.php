<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all data in guest table
        $guest = Guest::all();
        return response()->json([
            'status' => true,
            'guests'=> $guest,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
// user answer link
    public function show($link)
    { //test id 1 = link 4e3ce2d3-c29e-4f4c-bde9-e164ca799194
        $guest = Guest::all()->where("link", $link); //search guest data with the link
        $guest_id = Guest::all()->where("link", $link)->pluck('id')->implode('0 => ', ); // get guest id
        $email=Guest::all()->where("link", $link)->pluck('email')->implode('0 => ', );
        $question_id = Answer::where('guest_id', $guest_id)->pluck('question_id'); // search question id with guest id
        $answers = Answer::where('guest_id', $guest_id)->pluck('answer'); // search answer with guest id
        $data = ['answer' => $answers, 'question' => $question_id, 'guest_email' => $email]; // put all data iin array
        
        return response()->json([ 
            'status' => true,
            'message'=>"ok",
            'data'=> $data,
        ],200);

        
    }

   
}

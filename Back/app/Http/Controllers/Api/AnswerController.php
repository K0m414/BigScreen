<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Guest;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answer = Answer::all();
       // return all data in answer table

        // dd($answer);
        return response()->json([
            'status' => true,
            'answers'=> $answer,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'email'=> 'required|email',
        // ]);
        // search the email from the request
        $guestEmail = implode('"email" =>', $request->only(['email'])) ;
        //with the email find the id
        $guestId = Guest::all()->where("email", $guestEmail)->pluck("id")->implode('0 => ', );
        //create a unique id
        $link = Str::uuid()->toString();

        // if the id is find
        if($guestId){
            //then create an answer in the answer table
            $answer = Answer::create([
                'answer' => $request->answer,
                'question_id' => $request->question_id,
                'guest_id' => $guestId,
            ]);
        }
        //the id is null 
        else{
            // create a guest
            $guest = Guest::create([
                'email' => $request->email,
                'link' => $link,
            ]);
            // search the new guest id
            $guestId = Guest::all()->where("email", $guestEmail)->pluck("id")->implode('0 => ', );
            // dd($guestId);
            //then create an answer in the answer table
            $answer = Answer::create([
                'answer' => $request->answer,
                'question_id' => $request->question_id,
                'guest_id' => $guestId,
            ]);
        }
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Answer::find($id);
        dd($answer);
        // return response()->json([
        //     'status' => true,
        //     'message'=>"ok",
        //     'answer'=> $answer
        // ],200); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}

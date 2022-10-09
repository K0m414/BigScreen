<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Guest;
use Illuminate\Support\Facades\Validator;


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
        $validator = Validator::make(

            $request->all(),
            [
                'email'=> 'required|email',//check if email is ok
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    "status" => "401",
                    "errors" => $validator->errors()
                ],
                401
            );
        } else {
            $guestEmail = implode('"email" =>', $request->only(['email'])) ;
            //with the email find the id
            $guestId = Guest::all()->where("email", $guestEmail)->pluck("id")->implode('0 => ', );
            $link = Guest::all()->where("email", $guestEmail)->pluck("link")->implode('0 => ', );
    
            //create a unique id
    
            // if the id is find
            if($guestId){
                //then create an answer in the answer table
                $answer = Answer::create([
                    'answer' => $request->answer,
                    'question_id' => $request->question_id,
                    'guest_id' => $guestId,
                ]);
                return response()->json([
                    'status' => true,
                    'message'=>"Toute l’équipe de Bigscreen vous remercie pour votre engagement. Grâce à
                    votre investissement, nous vous préparons une application toujours plus
                    facile à utiliser, seul ou en famille.
                    Si vous désirez consulter vos réponse ultérieurement, vous pouvez consultez
                    cette adresse:",
                    'link'=> $link,
                ],200); 
            }
            //the id is null 
            else{
                $link = Str::uuid()->toString();
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
    
                return response()->json([
                    'status' => true,
                    'message'=>"Toute l’équipe de Bigscreen vous remercie pour votre engagement. Grâce à
                    votre investissement, nous vous préparons une application toujours plus
                    facile à utiliser, seul ou en famille.
                    Si vous désirez consulter vos réponse ultérieurement, vous pouvez consultez
                    cette adresse:",
                    'link'=> $link,
                ],200);              
    
            }
            

        }
        // search the email from the request
        
    }
    public function show($id)
    {
        $answer = Answer::find($id);
        // dd($answer);
        return response()->json([
            'status' => true,
            'message'=>"ok",
            'answer'=> $answer
        ],200); 
    }
    protected function getPieChart($id)
    {
        // check if id = question type a
        $answers =Answer::all()->where('question_id', $id)->groupBy('answer'); // all answer where question_id = $id are group by answer
        $answer_choice = Question::where('id', $id)->get(); // get all choice from question table
        $question = Question::where('id', $id)->pluck('question')->implode('0 => ', );
        $labels = explode(", ", $answer_choice[0]->answer_choice);
        $labelArray = [];
        $countArray = [];

        foreach ($labels as $key => $value) {
            if(isset($answers[$value])) { 
                $count = $answers[$value]->count();        
                array_push( $labelArray, $value );
                array_push( $countArray, $count );

            }
        }
        return ["question"=>$question, 'value' =>$labelArray, 'count' =>$countArray];
    }
    public function GetRadarChart() {

        $question_id =[11,12,13,14,15];
        $countArray = [];
        $labelArray = [];

        foreach ($question_id as $id) {
            $answer = round(Answer::where('question_id', $id)->get()->avg('answer'),2);
            $questions = Question::all()->where('id', $id)->pluck('question')->implode('0 => ', ); // get all choice from question table
            array_push($countArray, $answer);
            array_push($labelArray, $questions);

        }
        // dd($labelArray);

        return ['value' =>$labelArray, 'count' =>$countArray];
    }

}

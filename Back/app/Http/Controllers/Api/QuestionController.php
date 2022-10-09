<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all data in question table
        $question = Question::all();
        return response()->json([
            'status' => true,
            'questions'=> $question,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        // return the question find with data
        $question = Question::find($id);
        return response()->json([
            'status' => true,
            'questions'=> $question,
        ]);
    }
}

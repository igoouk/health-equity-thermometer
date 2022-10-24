<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;

class QuestionController extends Controller
{


    /**
     * Send verification code to user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkAnswer(Request $request)
    {
        $correctAnswer = explode(",", Question::where('id', $request->questionId)->first()->correct_answer);
        $arraysAreEqual = ($correctAnswer == $request->selectedOptions);
        $previouslySelectedOptions = session()->get('selectedOptions');
        if ($previouslySelectedOptions) {
            $tempOptions = strval(implode(",",$request->selectedOptions)).",". strval($previouslySelectedOptions);
        }else{
            $tempOptions = strval(implode(",",$request->selectedOptions));
        }
        
        session(['selectedOptions' => $tempOptions]);
        if ($arraysAreEqual) {
            return "1";
        }else{
            try {
                $result = Result::create([
                    'user_id' => session()->get('user_id'),
                    'selected_options' => session()->get('selectedOptions'),
                    'level' => $request->questionId
                ]);
            } catch (\Throwable $th) {
                return $th;
            }
            return "1";
        }
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}

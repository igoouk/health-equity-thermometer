<?php
namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use App\Models\UserSession;
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
        if (session()->get('quiz-completed') != true)
        {

            $arraysAreEqual = false;

            $questionCount = 0;
            foreach ($request->questionIds as $key => $questionID)
            {
                $correctAnswer = explode(",", Question::where('id', $questionID)->first()
                    ->correct_answer);
                $selectedOptions = [];
                foreach ($request->selectedOptions as $key => $option)
                {
                    if ($option["id"] == $questionID)
                    {
                        array_push($selectedOptions, $option["option"]);
                    }

                }

                $arraysAreEqual = !array_diff($correctAnswer, $selectedOptions);
                $previouslySelectedOptions = json_decode(session()->get('selected-options'));
                $selectedAnswerObject = json_encode(array(
                    "id" => $questionID,
                    "answers" => array_values($selectedOptions)
                ));
                $tempOptions = [];
                if ($previouslySelectedOptions)
                {
                    $tempOptions = $previouslySelectedOptions;
                }

                array_push($tempOptions, $selectedAnswerObject);

                $selectedOptionsString = json_encode($tempOptions);
                session(['selected-options' => $selectedOptionsString]);
                $questionCount++;

                if ($arraysAreEqual && $questionID != 7)
                {
                    if ($questionCount == count($request->questionIds))
                    {
                        return "1";
                    }

                }
                else
                {
                    try
                    {
                        $result = Result::create(['user_id' => session()->get('user-id') , 'selected_options' => $selectedOptionsString, 'level' => $questionID - 1]);

                        $userSession = UserSession::where("user_id", session()->get('user-id'))
                            ->orderByDesc('created_at')
                            ->get()
                            ->first();
                        $userSession->result_id = $result->id;
                        $userSession->save();
                        session(['selected-options' => null]);
                        session(['quiz-completed' => true]);

                    }
                    catch(\Throwable $th)
                    {
                        return $th;
                    }
                    return "1";
                }
            }

        }
        else
        {
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


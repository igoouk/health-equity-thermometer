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
        $question = Question::where('id', $request->questionIds[0])->first();
        $currentLevel = $question->level;
        session(['current-level' => $currentLevel]);
        if (session()->get('quiz-completed') != true)
        {

            $answeredCorrect = false;
            $exitQuiz = false;
            $questionCount = 0;
            foreach ($request->questionIds as $key => $questionID)
            {
                $question = Question::where('id', $questionID)->first();
                $answer = explode(",", $question->answer);
                $selectedOptions = [];
                $enteredValues = [];
                foreach ($request->selectedOptions as $key => $option)
                {
                    if ($option["id"] == $questionID)
                    {
                        array_push($selectedOptions, $option["option"]);
                        array_push($enteredValues, $option["value"]);
                    }

                }
                if ($question->answer_type == "exclude") {
                    $answeredCorrect = true;
                    foreach ($selectedOptions as $key => $value) {
                        if ($value == $answer[0]) {
                            $answeredCorrect = false;
                            $exitQuiz = true;
                        }
                    }
                }else if(strlen($answer[0]) > 0){
                    $answeredCorrect = $answer === $selectedOptions;
                }else{
                    $answeredCorrect = true;
                }
                
                $previouslySelectedOptions = json_decode(session()->get('selected-options'));
                $selectedAnswerObject = json_encode(array(
                    "id" => $questionID,
                    "answers" => array_values($selectedOptions),
                    "values" => array_values($enteredValues)
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

                if ($answeredCorrect && $questionID != 8)
                {
                    if ($questionCount == count($request->questionIds))
                    {
                        //session(['previous-level' => $currentLevel]);
                        session(['current-level' => $currentLevel+1]);
                        return "1";
                    }

                }
                else
                {
                    $level = ($question->level)-1;
                    if ($answeredCorrect && $questionID == 8) {
                        $level = $question->level;
                    }
                    try
                    {
                        session(['selected-options' => null]);
                        session(['quiz-completed' => true]);
                        if (!$exitQuiz) {
                            $result = Result::create(['user_id' => session()->get('user-id') , 'selected_options' => $selectedOptionsString, 'level' => $level]);

                            $userSession = UserSession::where("user_id", session()->get('user-id'))
                                ->orderByDesc('created_at')
                                ->get()
                                ->first();
                            $userSession->result_id = $result->id;
                            $userSession->save();
                            session(['current-level' => $currentLevel+1]);
                            return "1";
                        }else{
                            return "exit"; 
                        }
                        

                    }
                    catch(\Throwable $th)
                    {
                        return $th;
                    }

                    
                }
            }

        }
        else
        {
            session(['current-level' => $currentLevel+1]);
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


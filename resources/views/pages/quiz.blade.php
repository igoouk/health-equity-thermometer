
<?php
use App\Models\Question;
if (session()->get('verified') != "1") {
    redirect('/home');
 }

$nextQuestion = ($questionId != 6) ? $questionId + 1 : 6; 
$linkedQuestion = null;
if (is_array($question)) {
    $linkedQuestion = $question[1];
    $question = $question[0];
    $nextQuestion ++;
}

$type = $question->type;
if ($type == null) {
    $type = "checkbox";
}
?>

@section('header', 'Quiz page')
@extends('layouts.app', ['page' => __('Quiz'), 'pageSlug' => 'quiz'])
@section('content')
    <div class="" id="quiz-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="generic-container" id="questions-container">
                
                    
                    <div class="single-question @once enabled @endonce main-question" data-id="{{$questionId}}" >
                        <div class="p-6 bg-white border-gray-200" id="question-text" data-id="{{$questionId}}">
                            {{$question->text}}
                        </div>
                        <div class="p-6 bg-white border-gray-200" id="question-image">
                            <img src="{{ $question['image_url'] }}">
                        </div>
                        <div class="options-container">
                            @foreach ($question->options as $option)
                                @if ($type == "dropdown")
                                <select>
                                    @foreach ($question->options as $option)
                                    <option type="{{$type}}" id="option-{{$option['id']}}" class="{{$type}}-input" data-question-id="{{$questionId}}" data-option-id="{{$option['id']}}" name="question-options">{{$option["text"]}} - {{$option["id"]}}</option>
                                    @endforeach 
                                </select>  
                                @else
                                <div class="single-option">
                                    <div class="input-holder">
                                        <input type="{{$type}}" id="option-{{$option['id']}}" class="{{$type}}-input" data-question-id="{{$questionId}}" data-option-id="{{$option['id']}}" name="question-options">                            </input>
                                    </div>
                                    <div class="label-holder">
                                        <label for="option-{{$option['id']}}">{{$option["text"]}} - {{$option["id"]}}</label>
                                    </div>
                                </div>  
                                @endif
                               
                            @endforeach
                        </div>
                    </div>
                    @if ($linkedQuestion != null)
                        <div class="single-question linked-question" data-id="{{$linkedQuestion->id}}" >
                            <div class="p-6 bg-white border-gray-200" id="question-text" data-id="{{$linkedQuestion->id}}">
                                {{$linkedQuestion->text}}
                            </div>
                            <div class="p-6 bg-white border-gray-200" id="question-image">
                                <img src="{{ $linkedQuestion['image_url'] }}">
                            </div>
                            <div class="options-container">
                                @foreach ($linkedQuestion->options as $option)
                                    <div class="single-option">
                                        <div class="input-holder">
                                            <input type="{{$type}}"  id="option-{{$option['id']}}" class="{{$type}}-input" data-question-id="{{$linkedQuestion->id}}" data-option-id="{{$option['id']}}" name="linked-question-options"></input>
                                        </div>
                                        <div class="label-holder">
                                            <label for="option-{{$option['id']}}">{{$option["text"]}} - {{$option["id"]}}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                        </div>
                    @endif
                    <button id="submit-answer-button" data-route="{{url('check-answer')}}" class="button">Submit answer</button>  
            </div>
            
                
            <div id="information-popup" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="information-text">{!! $question["information"] !!}</div>
                @if ($questionId != 6)
                <button id="next-button" data-route="{{url('/quiz/')}}/<?php echo $nextQuestion ?>" class="button">Next question</button>
                @else
                <button data-route="{{url('/result/')}}" id="result-button" class="button">Show my results</button>
                @endif
            </div>
            
        </div>
    
       
  
    </div>
@endsection

<?php


?>
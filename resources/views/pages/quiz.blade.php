
<?php
use App\Models\Question;
if (session()->get('verified') != "1") {
    redirect('/home');
 }
//xdebug_break();

$nextLevel = ($currentLevel != 6) ? $currentLevel+ 1 : 6; 
$questionCount = 0;
?>

@section('header', 'Quiz page')
@extends('layouts.app', ['page' => __('Quiz'), 'pageSlug' => 'quiz'])
@section('content')
    <div class="" id="quiz-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="generic-container" id="questions-container">
                
                    @foreach ($questions as $question)
                        <div class="single-question @once enabled main-question @endonce @if ($questionCount > 0 ) second-question @endif " data-id="{{$question->id}}" >
                            <div class="p-6 bg-white border-gray-200" id="question-text" data-id="{{$question->level}}">
                                {{$question->text}}
                            </div>
                            <div class="p-6 bg-white border-gray-200" id="question-image">
                                <img src="{{ $question['image_url'] }}">
                            </div>
                            <div class="options-container">
                                @foreach ($question->options as $option)
                                    @if ($question->type == "dropdown")
                                    <select>
                                        @foreach ($question->options as $option)
                                        <option type="{{$question->type}}" id="option-{{$option['id']}}" class="{{$question->type}}-input" data-question-id="{{$question->id}}" data-option-id="{{$option['id']}}" name="question-options-{{$question->id}}">{{$option["text"]}} - {{$option["id"]}}</option>
                                        @endforeach 
                                    </select>  
                                    @else
                                    <div class="single-option">
                                        <div class="input-holder">
                                            <input type="{{$question->type}}" id="option-{{$option['id']}}" class="{{$question->type}}-input" data-question-id="{{$question->id}}" data-option-id="{{$option['id']}}" name="question-options-{{$question->id}}">                            </input>
                                        </div>
                                        <div class="label-holder">
                                            <label for="option-{{$option['id']}}">{{$option["text"]}} - {{$option["id"]}}</label>
                                        </div>
                                    </div>  
                                    @endif
                                
                                @endforeach
                            </div>
                        </div>   
                        @php
                        $questionCount++;   
                        @endphp    
                    @endforeach
                    
                   
                    <button id="submit-answer-button" data-route="{{url('check-answer')}}" class="button">Submit answer</button>  
            </div>
            
                
            <div id="information-popup" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="information-text">{!! $questions[0]["information"] !!}</div>
                @if ($currentLevel != 6)
                <button id="next-button" data-route="{{url('/quiz/')}}/<?php echo $nextLevel ?>" class="button">Next question</button>
                @else
                <button data-route="{{url('/result/')}}" id="result-button" class="button">Show my results</button>
                @endif
            </div>
            
        </div>
    
       
  
    </div>
@endsection

<?php


?>
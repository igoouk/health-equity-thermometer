
<?php
use App\Models\Question;
if (session()->get('verified') != "1") {
    redirect('/home');
 }

$nextQuestion = ($questionId != 6) ? $questionId + 1 : 6; 
?>

@section('header', 'Quiz page')
@extends('layouts.app', ['page' => __('Quiz'), 'pageSlug' => 'quiz'])
@section('content')
    <div class="py-12" id="quiz-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg object-center" id="questions-container">
                
                    
                    <div class="single-question @once enabled @endonce" data-id="{{$questionId}}">
                        <div class="p-6 bg-white border-gray-200" id="question-text">
                            Quiz here!
                        </div>
                        <div class="p-6 bg-white border-gray-200" id="question-image">
                            <img src="{{ $question['image_url'] }}">
                        </div>
                        <div class="options-container">
                            @foreach ($question->options as $option)
                                <input type="checkbox" class="checkbox-input" data-option-id="{{$option['id']}}">{{$option["text"]}} - {{$option["id"]}}</input>
                            @endforeach
                        </div>
                        <div class="question-information">
                            
                        </div>
                    </div>

 
                    
                
            </div>
            
                <div id="submit-answer-button" data-route="{{url('check-answer')}}">Submit answer</div>
           
            
        </div>
    
        <div id="information-popup" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{$question["information"]}}
            @if ($questionId != 6)
            <div id="next-button" data-route="{{url('/quiz/')}}/<?php echo $nextQuestion ?>">Next question</div>
            @else
            <a href="{{url('/result/')}}" id="result-button" >Show my results</div>
            @endif
        </div>
  
    </div>
@endsection

<?php


?>
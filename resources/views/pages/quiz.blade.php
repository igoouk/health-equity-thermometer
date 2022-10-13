
<?php
use App\Models\Question;
if (session()->get('verified') != "1") {
    redirect('/home');
 }

$question = Question::find($questionId);
?>

@section('header', 'Quiz page')
@extends('layouts.app', ['page' => __('Quiz'), 'pageSlug' => 'quiz'])
@section('content')
    <div class="py-12">
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
                                <input type="radio" data-question-id="{{$question['id']}}">{{$option["text"]}}</input>
                            @endforeach
                        </div>
                        <div class="question-information">
                            {{$question["information"]}}
                        </div>
                    </div>

 
                    <!--<a id="start-quiz" href="{{ url('/quiz/') }}">Start Quiz</a>-->
                
            </div>
            <div id="next-question">Next question</div>
        </div>
    </div>
@endsection

<?php


?>
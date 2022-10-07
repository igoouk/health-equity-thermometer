
<?php
use App\Models\Question;

?>

<x-app-layout>
@section('header', 'Quiz page')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg object-center" id="questions-container">
                
                

                    @foreach ($questions as $question)
                    
                    <div class="single-question @once enabled @endonce">
                        <div class="p-6 bg-white border-gray-200" id="question-text">
                            Quiz here!
                        </div>
                        <div class="p-6 bg-white border-gray-200" id="question-image">
                            <img src="{{ $question['image_url'] }}">
                        </div>
                        @foreach (Question::find($question["id"])->options as $option)
                            {{$option["text"]}}
                        @endforeach
                    </div>
                    @endforeach
 
                    <!--<a id="start-quiz" href="{{ url('/quiz/') }}">Start Quiz</a>-->
                
            </div>
            <div id="next-question">Next question</div>
        </div>
    </div>
</x-app-layout>
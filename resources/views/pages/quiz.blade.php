
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
                                        <option type="{{$question->type}}" id="option-{{$option['id']}}" class="{{$question->type}}-input" value="{{$option["text"]}}" data-question-id="{{$question->id}}" data-option-id="{{$option['id']}}" name="question-options-{{$question->id}}" data-additional-field="{{$option['optional_type']}}">{{$option["text"]}}</option>
                                        @endforeach 
                                    </select>  
                                    @else
                                        @php
                                        $questionType = $question->type;
                                        @endphp
                                        <div class="single-option  {{$questionType}}-option">
                                            <div class="input-holder" >
                                                <input type="{{$questionType}}" id="option-{{$option['id']}}" class="{{$questionType }}-input" value="{{$option["text"]}}" data-question-id="{{$question->id}}" data-option-id="{{$option['id']}}" name="question-options-{{$question->id}}" data-additional-field="{{$option['optional_type']}}">                            </input>
                                            </div>
                                            <div class="label-holder">
                                                <label for="option-{{$option['id']}}">{{$option["text"]}}</label>
                                            </div>
                                        @if($option['optional_type'] != null)
                                            <div class="input-holder-{{$option['optional_type']}}" >
                                                <input type="{{$option['optional_type']}}" id="option-{{$option['id']}}-{{$option['optional_type']}}" class="{{$option['optional_type'] }}-input" data-question-id="{{$question->id}}" data-option-id="{{$option['id']}}" name="question-options-{{$question->id}}">                            </input>
                                            </div>
                                        @endif
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
                <div id="exit-text">The Health Equity and Screening Tool aims to support the implementation of an equity lens in health research. 
                    From your response to the last question it seems that your current work/research doesn’t directly relate to the conditions in which people are born, grow, live, work and age and is thus outside the scope of health research, which is why the Health Equity Screening Tool has been terminated. 
                    <br><br>
                    If you would like to find out more about the work we do aiming to reduce health inequalities please visit our website  https://arc-nwc.nihr.ac.uk/  
                    You can also hear about the vision of health equity and the challenges academics, clinicians, patients and the public, or those from the voluntary sector involved in this area of work are faced with by listening to our podcast (link will be available end of Nov. so I will share).
                    <br><br> 
                    Did we get it wrong? Fear not, you can always go back and give the Health Equity Thermometer and Screening Tool another go.
                </div>
                
                @if ($currentLevel != 6)
                <button id="next-button" data-route="{{url('/quiz/')}}/<?php echo $nextLevel ?>" class="button">Next question</button>
                @else
                <button data-route="{{url('/result/')}}" id="result-button" class="button">Show my results</button>
                @endif
                
            </div>
        </div>
    
       
  
    </div>
    <div id="footer-container" class="generic-container">
        <img src="/img/funded-by-nihr-logo.png">
    </div>
    
@endsection

<?php


?>
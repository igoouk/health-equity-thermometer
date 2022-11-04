
@extends('layouts.app', ['page' => __('Result'), 'pageSlug' => 'result'])
@section('header', 'Result Page')
@section('content')
<?php

?>

    <div id="result-container" class="level level--{{$latestResult->level}}">
        Your level : {{$latestResult->level}}
        <div class="container-header">What is your health equity temperature?</div>
        <div id="result-content">

            <div id="information-container">
                <div class="level-info level--6 @if ($latestResult->level >= 6) enabled @else disabled @endif" >
                    <div class="level-indicator"></div>
                    <div class="level-text">Patients and the public are involved and engaged at all stages of research. Their contribution is valued and its impact is recorded.</div>
                </div>
                <div class="level-info level--5 @if ($latestResult->level >= 5) enabled @else disabled @endif" >
                    <div class="level-indicator"></div>
                    <div class="level-text">All policies, systems, and practices are applied through an equity lens</div>
                </div>
                <div class="level-info level--4 @if ($latestResult->level >= 4) enabled @else disabled @endif" >
                    <div class="level-indicator"></div>
                    <div class="level-text">Some policies, practices are applied through an equity lens. Additional support to apply that more widely would be welcomed.</div>
                </div>
                <div class="level-info level--3 @if ($latestResult->level >= 3) enabled @else disabled @endif" >
                    <div class="level-indicator"></div>
                    <div class="level-text">Identification of health inequalities is straightforward, but application of an equity lens in practice is challenging</div>
                </div>
                <div class="level-info level--2 @if ($latestResult->level >= 2) enabled @else disabled @endif" >
                    <div class="level-indicator"></div>
                    <div class="level-text">Health equity is important, but there is uncertainty about its relevance to a given piece of work</div>
                </div>
                <div class="level-info level--1 @if ($latestResult->level >= 1) enabled @else disabled @endif" >
                    <div class="level-indicator"></div>
                    <div class="level-text">Health equity and health inequalities are confusing concepts</div>
                </div>
                <div class="level-info level--0 @if ($latestResult->level >= 0) enabled @else disabled @endif" >
                    <div class="level-indicator"></div>
                </div>
            </div>
            
        </div>
        
    </div>
    
              

   
@endsection
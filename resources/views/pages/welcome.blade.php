
@extends('layouts.app', ['page' => __('Welcome'), 'pageSlug' => 'welcome'])
@section('header', 'Welcome Page')
@section('content')
<?php

session(['selectedOptions' => null]);
session(['user_id' => null]);
session(['user_id' => null]);
?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div id="welcome-container" class="generic-container align-items-sm-center">
                    <div class="container-header">
                        Find out what your health equity temperature is
                    </div>
                    <div class="container-text">
                        Reducing health inequalities is a vision shared by many individuals, organisations, and sectors. However, deciding what actions are appropriate in each context is more of a challenge. Making sense of and implementing an equity lens can be a non-linear journey whilst collaborating individuals/groups may be at different stages of that journey.<br><br>

                        The Health Equity Thermometer and Screening Tool is a free tool that was developed collaboratively by academics and members of the public with lived experience of health inequalities at the NIHR ARC NWC primarily aiming to support health equity research. It can be used flexibly to apply to individuals, teams or whole organizations and it can be employed as a quick diagnostic tool.<br><br>

                        offer a simple way to communicate the journey to equity and prompt the development of action plans and strategies be used as an impact measure allowing the monitoring of progress.<br><br>

                        If you would like to know more about the story behind the development of the Health Equity Thermometer and Screening tool click here.
                    </div>
                    <div class="p-6 bg-white border-gray-200" id="instruction-image">
                        Explanation image
                    </div>
                    <button id="get-started-button" class="btn-primary" >Get Started</button>
                </div>    
                <div id="login-container">
                    <input type="text" id="email-input" placeholder="Enter email" value="yasin@igoo.co.uk"></input>
                    <input type="text" id="code-input" placeholder="Enter verification code"></input>
                    <a id="send-code-button" class="button" data-route="{{url('send-code')}}">Get verification code</a>
                    <a id="verify-code-button" class="button" data-route="{{url('verify-code')}}">Verify code</a>
                </div>
                
                <div>
                    <!--<a id="start-quiz" href="{{ url('/demographics') }}">Start</a>-->
                </div>
            </div>
        </div>
    </div>
@endsection
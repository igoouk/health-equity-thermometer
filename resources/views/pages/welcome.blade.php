
@extends('layouts.app', ['page' => __('Welcome'), 'pageSlug' => 'welcome'])
@section('header', 'Welcome Page')
@section('content')
<?php

session(['selectedOptions' => null]);
session(['user_id' => null]);

?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div id="login-container">
                    <input type="text" id="email-input" placeholder="Enter email" value="yasin@igoo.co.uk"></input>
                    <input type="text" id="code-input" placeholder="Enter verification code"></input>
                    <a id="send-code-button" data-route="{{url('send-code')}}">Get verification code</a>
                    <a id="verify-code-button" data-route="{{url('verify-code')}}">Verify code</a>
                </div>
                <div class="p-6 bg-white border-gray-200" id="instruction-image">
                    Explanation image
                </div>
                <div>
                    <a id="start-quiz" href="{{ url('/quiz/1') }}">Start Quiz</a>
                </div>
            </div>
        </div>
    </div>
@endsection
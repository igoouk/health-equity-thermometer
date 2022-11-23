
@extends('layouts.app', ['page' => __('Welcome'), 'pageSlug' => 'welcome'])
@section('header', 'Welcome Page')
@section('content')


<div id="welcome-container" class="generic-container">
    <div class="container-header">
        Find out what your health equity temperature is
    </div>
    <div class="container-text">
        Reducing health inequalities is a vision shared by many individuals, organisations, and sectors. However, deciding what actions are appropriate in each context is more of a challenge. Making sense of and implementing an equity lens can be a non-linear journey whilst collaborating individuals/groups may be at different stages of that journey. 
        <br><br>
The Health Equity Thermometer and Screening Tool is a free tool that was developed collaboratively by academics and members of the public with lived experience of health inequalities at the NIHR ARC NWC primarily aiming to support health equity research. It can be used flexibly to apply to individuals, teams or whole organizations and it can:<br>
<ul>
<li>be employed as a quick diagnostic tool</li>    
<li>offer a simple way to communicate the journey to equity and prompt the development of action plans and strategies</li>    
<li>be used as an impact measure allowing the monitoring of progress</li>    
</ul><br>
 
If you would like to know more about the story behind the development of the Health Equity Thermometer and Screening tool click here: link to be provided
<br><br>
If you would like to go ahead and explore the Health Equity Thermometer and Screening tool, by providing your email below you will be creating an account that will offer you access to the tool. Your results will be recorded in your personal account so that you can revisit them as needed.
<br><br>
This project is supported by the National Institute for Health and Care Research Applied Research Collaboration North West Coast (ARC NWC). The views expressed in this publication are those of the author(s) and not necessarily those of the National Institute for Health Research or the Department of Health and Social Care.  </div>
    <div id="instruction-image">
       
    </div>
    <button id="get-started-button" class="button" >Get Started</button>
</div>    
<div id="send-code-container" class="generic-container">
    <div class="container-header">
        Email Address
    </div>
    <div class="container-text">
        If you would like to go ahead and explore the Health Equity Thermometer and Screening tool, by providing your email below you will be creating an account that will offer you access to the tool. Your results will be recorded in your personal account so that you can revisit them as needed.
    </div>
    <div class="input-container">
        <label for="email-input">Email</label>
        <input type="text" id="email-input" name="email-input" placeholder="Enter email" value=""></input>
        <button id="send-code-button" class="button" data-route="{{url('send-code')}}">Submit</button>
    </div>
</div>
<div id="verify-code-container" class="generic-container">
    <div class="container-header">
        Verify Email
    </div>
    <div class="container-text">
        Please enter the verification code below sent to your email. Please check your spam folder too if you can’t find it.
    </div>
    <div class="input-container">
        <label for="code-input">Verification code</label>
        <input type="text" id="code-input" name="code-input" placeholder="Enter verification code"></input>
        <button id="verify-code-button" class="button" data-route="{{url('verify-code')}}">Verify</button>
    </div>
    
</div>

<div id="footer-container" class="generic-container">
    <img src="/img/funded-by-nihr-logo.png">
</div>


@endsection
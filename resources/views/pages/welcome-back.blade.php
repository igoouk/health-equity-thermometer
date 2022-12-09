
<?php

use App\Models\Country;
use App\Models\City;
use App\Models\Question;
use App\Http\Controllers\UserController;
if (session()->get('verified') != "1") {
    redirect('/home');
 }

?>

@section('header', 'Welcome Back Page')
@extends('layouts.app', ['page' => __('Welcome Back'), 'pageSlug' => 'welcome-back'])
@section('content')


<div id="welcome-back-container" class="generic-container">


    <div class="container-header">Welcome back to the Health Equity Thermometer and Screening Tool! </div>
    <div class="container-text">What would you like to do today?</div>

    <div id="information-button-container" class="button-container">
       
        <button id="previous-results-button" data-route="{{ 'previous-results' }}" class="button">See Previous Results</button>
        <button id="start-new-button" data-route="{{ 'demographics' }}" class="button">Start a new session of the screening tool</button>
        <button id="download-thermometer" data-route="/blank-template.pdf"class="button">Download a copy of the thermometer</button>
    </div>

</div>
          

  

@endsection

<?php


?>
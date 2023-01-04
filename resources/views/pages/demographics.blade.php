<?php

use App\Models\Country;
use App\Models\City;
use App\Models\Question;
use App\Http\Controllers\UserController;

if (session()->get('verified') != "1") {
    redirect('/home');
}
//xdebug_break();
if ($resultCount > 0) {
    $userSession = UserController::getDemographics(session()->get('user-id'));
    $resultDemographics = json_decode($userSession["session_values"]);

    foreach ($resultDemographics as $key => $value) {
        switch ($key) {
            case 'interest':
                $interest   = $value;
                break;
            case 'country':
                $countryName   = $value;
                break;
            case 'city':
                $cityName   = $value;
                break;
            case 'jobRole':
                $jobRole   = $value;
                break;
            case 'organisation':
                $organisation   = $value;
                break;
            case 'target':
                $target   = $value;
                break;
            default:
                # code...
                break;
        }
    }
} else {
    $interest       =   "";
    $countryName    =   "";
    $cityName       =   "";
    $jobRole        =   "";
    $organisation   =   "";
    $target   =   "";
}
//echo $userSession;
?>

@section('header', 'Demographics Page')
@extends('layouts.app', ['page' => __('Demographics'), 'pageSlug' => 'demographics'])
@section('content')

<div id="demographics-container">
    <div id="interest-section" class="generic-container">
        <div class="container-header">Are you interested in the Health Equity Thermometer and Screening tool as part of your work?</div>
        <form id="interest-selection">
            <div>
                <input type="radio" class="radio-input" id="interest-work" name="interest" value="Work" @if ($interest=="Work" ) checked @endif>
                <label for="interest-work">Yes</label>
            </div>
            <div>
                <input type="radio" class="radio-input" id="interest-personal" name="interest" value="Personal" @if ($interest=="Personal" ) checked @endif>
                <label for="interest-personal">No, just personal interest in health research</label>
            </div>
        </form>
        <div class="break-line"></div>
        <div id="interest-options-work" class="input-container">
            <div>
                <label for="work-role">Job Role:</label>
                <input type="text" id="work-role">
            </div>
            <div>
                <label for="work-organisation">Organisation:</label>
                <input type="text" id="work-organisation">
            </div>
            <div>
                <label for="work-country">Country: {{$countryName}}</label>
                <select id="work-country" data-route="{{url('get-states')}}"> @foreach ($countries as $country) <option name="{{$country->name}}" data-id="{{$country->id}}" @if ($country->name == $countryName) selected @endif>{{$country->name}}</option> @endforeach </select>
            </div>
            <div>
                <label for="work-city">County/Area:</label>
                <select id="work-city">
                    <option>Please select a country first</option>
                </select>
            </div>
        </div>
        <div id="interest-options-personal" class="input-container">
            <div>
                <label for="personal-country">I am based in:</label>
                <select id="personal-country" data-route="{{url('get-states')}}"> @foreach ($countries as $country) <option name="{{$country->name}}" data-id="{{$country->id}}">{{$country->name}}</option> @endforeach </select>
            </div>
            <select id="personal-city">
                <option>Please select a country first</option>
            </select>

            <div>
                <label for="personal-reason">My interest in this is because:</label>
                <input type="text" id="personal-reason">
            </div>
        </div>

        <button id="next-button" class="button">Next</button>
    </div>

    <div id="activity-section" class="generic-container  hidden">
        <p class="container-header">What do you want to do today?</p>
        <form id="activity-selection">
            @if($resultCount > 0)
            <!--<input type="radio" class="radio-input" id="activity-test" name="activity" value="Test" selected>
                    <label for="activity-test">Test the health equity temperature of:</label>
                    <input type="radio" class="radio-input" id="activity-review" name="activity" value="Review">
                    <label for="activity-review">Review your previous scores</label>-->
            @else

            @endif
        </form>
        <p class="container-text">Test the health equity temperature of:</p>
        <form id="activity-target" class="enabled input-container">
            <div>
                <input type="radio" class="radio-input" id="target-self" class="target-input" value="self" data-input-id="self-name" name="target">
                <label for="target-self">Your own research project</label>
            </div>
            <input class="target-text" type="text" id="self-name" placeholder="Name of the project">
            <div>
                <input type="radio" class="radio-input" id="target-project" class="target-input" value="project" data-input-id="project-name" name="target">
                <label for="target-project">A specific project team</label>
            </div>
            <input class="target-text" type="text" id="project-name" placeholder="Name of the project or team">
            <div>
                <input type="radio" class="radio-input" id="target-organisation" class="target-input" value="organisation" data-input-id="organisation-name" name="target">
                <label for="target-organisation">An organisation</label>
            </div>
            <input class="target-text" type="text" id="organisation-name" placeholder="Name of the organisation">
        </form>
        <div id="activity-button-container" class="button-container">
            <button id="back-button" class="button back">Back</button>
            <button id="next-button" class="button next">Next</button>
        </div>
    </div>
    <div id="information-section" class="generic-container hidden">
        <div class="container-header">There are only 7 questions until you find out your health equity temperature… </div>
        <div class="container-text">For each of them <b>tick as many as you think are applicable</b></div>
        <div id="information-button-container" class="button-container">
            <button id="back-button" class="button back">Back</button>
            <button id="start-button" data-route="{{ 'save-demographics' }}" class="button ">Start</button>
        </div>
    </div>
</div>

@endsection

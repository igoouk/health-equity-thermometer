
<?php

use App\Models\Country;
use App\Models\City;
use App\Models\Question;
use App\Http\Controllers\UserController;
if (session()->get('verified') != "1") {
    redirect('/home');
 }

if ($resultCount > 0 ) {
    $userSession = UserController::getDemographics(session()->get('user-id'));
    $resultDemographics = json_decode($userSession["session_values"]);
    $interest       =   $resultDemographics[0]->value;
    $countryName    =   $resultDemographics[1]->value;
    $cityName       =   $resultDemographics[2]->value;
    $jobRole        =   $resultDemographics[3]->value;
    $organisation   =   $resultDemographics[4]->value;
}else{
    $interest       =   "";
    $countryName    =   "";
    $cityName       =   "";
    $jobRole        =   "";
    $organisation   =   "";
}
//echo $userSession;
?>

@section('header', 'Demographics Page')
@extends('layouts.app', ['page' => __('Demographics'), 'pageSlug' => 'demographics'])
@section('content')


<div id="demographics-container">

        <div id="interest-section" class="generic-container @if($resultCount > 0) hidden @endif">
            <div class="container-header">Are you interested in the Health Equity Thermometer and Screening tool as part of your work?</div>
            <form id="interest-selection">
                
                    <input type="radio" class="radio-input" id="interest-work" name="interest" value="Work" @if ($interest == "Work") checked @endif>
                    <label for="interest-work">Yes</label><br>
                    <input type="radio" class="radio-input" id="interest-personal" name="interest" value="Personal" @if ($interest == "Personal") checked @endif >
                    <label for="interest-personal">No, just personal interest</label><br>

                
            </form>
            <div id="interest-options-work">
                <label for="work-role">Job Role:</label><br>
                <input type="text" id="work-role" ><br>
                <label for="work-organisation">Organisation:</label><br>
                <input type="text" id="work-organisation"><br>
                <label for="work-country">Country: {{$countryName}}</label><br>
                <select id="work-country" data-route="{{url('get-cities')}}">
                    @foreach ($countries as $country)
                        <option name="{{$country->name}}" data-id="{{$country->country_id}}" @if ($country->name == $countryName) selected @endif>{{$country->name}}</option>
                    @endforeach
                </select><br>
                <label for="work-city">City:</label><br>
                <select id="work-city"><option>Please select a country first</option>
                </select><br>

            </div>
            <div id="interest-options-personal">
                <label for="personal-country">I am based in:</label><br>
                <select  id="personal-country" data-route="{{url('get-cities')}}">
                    @foreach ($countries as $country)
                        <option name="{{$country->name}}" data-id="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select><br>
                <select id="personal-city"><option>Please select a country first</option></select><br>
                <label for="personal-reason">My interest in this is because:</label><br>
                <input type="text" id="personal-reason"><br>
            </div>

            <button id="next-button" class="button">Next</button>
        </div>



        <div id="activity-section" class="generic-container  hidden">
            <form id="activity-selection">
                <p class="container-header">What do you want to do today?</p>
                
                @if($resultCount > 0)  
                    <input type="radio" class="radio-input" id="activity-test" name="activity" value="Test">
                    <label for="activity-test">Test the health equity temperature of:</label><br>
                    <input type="radio" class="radio-input" id="activity-review" name="activity" value="Review">
                    <label for="activity-review">Review your previous scores</label><br>
                @else
                    <div>Test the health equity temperature of:</div>
                @endif
                
            </form>
            <form id="activity-target" @if($resultCount == 0)  class="enabled" @endif  >
                        <input type="radio" class="radio-input" id="target-self" class="target-input" value="self" data-input-id="self-name" name="target">
                        <label for="target-self">Yourself</label>
                        <input class="target-text" type="text" id="self-name"><br>
                        <input type="radio" class="radio-input" id="target-project" class="target-input" value="project" data-input-id="project-name" name="target">
                        <label for="target-project">A specific project team</label>
                        <input class="target-text" type="text" id="project-name"><br>
                        <input type="radio" class="radio-input" id="target-organisation" class="target-input" value="organisation" data-input-id="organisation-name" name="target">
                        <label for="target-organisation">An organisation</label>
                        <input class="target-text" type="text" id="organisation-name"><br>
            </form>
            <div id="activity-button-container">
                <button id="back-button" class="button">Back</button>
                <button id="next-button" class="button">Next</button>
            </div>
        </div>
        <div id="information-section" class="generic-container @if($resultCount > 0) show @else hidden @endif">
            <div class="container-header">There are only 7 questions until you find out your health equity temperature… For each of them tick as many as you think are applicable to you or your team</div>
            <div id="information-button-container">
                <button id="back-button" class="button @if($resultCount > 0) hidden @else show @endif">Back</button>
                <button id="start-button" data-route="{{ 'save-demographics' }}" class="button @if($resultCount > 0) hidden @else show @endif">Start</button>
                <button id="start-new-button" class="button @if($resultCount > 0) show @else hidden @endif">Start with new session data</button>
                <button id="previous-results-button" data-route="{{ 'previous-results' }}" class="button @if($resultCount > 0) show @else hidden @endif">See Previous Results</button>
                <button id="start-previous-button" data-route="{{ 'use-previous-demographics' }}" class="button @if($resultCount > 0) show @else hidden @endif">Start with previous session data</button>
            </div>
        </div>

        
    
</div>
          

  

@endsection

<?php


?>
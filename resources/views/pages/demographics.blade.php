
<?php

use App\Models\Country;
use App\Models\City;
use App\Models\Question;
use App\Http\Controllers\UserController;
if (session()->get('verified') != "1") {
    redirect('/home');
 }
//xdebug_break();
if ($resultCount > 0 ) {
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

}else{
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

        <div id="interest-section" class="generic-container @if($resultCount > 0) hidden @endif">
            <div class="container-header">Are you interested in the Health Equity Thermometer and Screening tool as part of your work?</div>
            <form id="interest-selection">
                    <div>
                        <input type="radio" class="radio-input" id="interest-work" name="interest" value="Work" @if ($interest == "Work") checked @endif>
                        <label for="interest-work">Yes</label>
                    </div>
                    <div>
                        <input type="radio" class="radio-input" id="interest-personal" name="interest" value="Personal" @if ($interest == "Personal") checked @endif >
                        <label for="interest-personal">No, just personal interest</label>
                    </div>
            </form>
            <div class="break-line"></div>
            <div id="interest-options-work">
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
                  <select id="work-country" data-route="{{url('get-cities')}}"> @foreach ($countries as $country) <option name="{{$country->name}}" data-id="{{$country->country_id}}" @if ($country->name == $countryName) selected @endif>{{$country->name}}</option> @endforeach </select>
                </div>
                <div>
                  <label for="work-city">City:</label>
                  <select id="work-city">
                    <option>Please select a country first</option>
                  </select>
                </div>
            </div>
            <div id="interest-options-personal">
                <div>
                    <label for="personal-country">I am based in:</label>
                    <select id="personal-country" data-route="{{url('get-cities')}}"> @foreach ($countries as $country) <option name="{{$country->name}}" data-id="{{$country->id}}">{{$country->name}}</option> @endforeach </select>
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
            <form id="activity-target" class="enabled"   >
                        <div>
                            <input type="radio" class="radio-input" id="target-self" class="target-input" value="self" data-input-id="self-name" name="target">
                            <label for="target-self">Yourself</label>
                        </div>
                        <input class="target-text" type="text" id="self-name">
                        <div>
                            <input type="radio" class="radio-input" id="target-project" class="target-input" value="project" data-input-id="project-name" name="target">
                            <label for="target-project">A specific project team</label>
                        </div>
                        <input class="target-text" type="text" id="project-name">
                        <div>
                            <input type="radio" class="radio-input" id="target-organisation" class="target-input" value="organisation" data-input-id="organisation-name" name="target">
                            <label for="target-organisation">An organisation</label>
                        </div>
                        <input class="target-text" type="text" id="organisation-name">
            </form>
            <div id="activity-button-container">
                <button id="back-button" class="button back">Back</button>
                <button id="next-button" class="button next">Next</button>
            </div>
        </div>
        <div id="information-section" class="generic-container @if($resultCount > 0) show @else hidden @endif">
            <div class="container-header">There are only 7 questions until you find out your health equity temperature… </div>
            <div class="container-text">For each of them <b>tick as many as you think are applicable</b> to you or your team</div>
            <div id="information-button-container">
                <button id="back-button" class="button back @if($resultCount > 0) hidden @else show @endif">Back</button>
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
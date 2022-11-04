
<?php

use App\Models\Country;
use App\Models\City;
use App\Models\Question;
if (session()->get('verified') != "1") {
    redirect('/home');
 }


?>

@section('header', 'Demographics Page')
@extends('layouts.app', ['page' => __('Demographics'), 'pageSlug' => 'demographics'])
@section('content')


<div id="demographics-container">

        <div id="interest-section" class="generic-container">
            <div class="container-header">Are you interested in the Health Equity Thermometer and Screening tool as part of your work?</div>
            <form id="interest-selection">
                
                    <input type="radio" id="interest-work" name="interest" value="Work">
                    <label for="interest-work">Yes</label><br>
                    <input type="radio" id="interest-personal" name="interest" value="Personal">
                    <label for="interest-personal">No, just personal interest</label><br>

                
            </form>
            <div id="interest-options-work">
                <label for="work-role">Job Role:</label><br>
                <input type="text" id="work-role" ><br>
                <label for="work-organisation">Organisation:</label><br>
                <input type="text" id="work-organisation"><br>
                <label for="work-country">Country:</label><br>
                <select id="work-country" data-route="{{url('get-cities')}}">
                    @foreach ($countries as $country)
                        <option name="{{$country->name}}" data-id="{{$country->country_id}}">{{$country->name}}</option>
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
                <select  id="personal-city"><option>Please select a country first</option></select><br>
                <label for="personal-reason">My interest in this is because:</label><br>
                <input type="text" id="personal-reason"><br>
            </div>

            <button id="next-button" class="button">Next</button>
        </div>



        <div id="activity-section" class="generic-container">
            <form id="activity-selection">
                <p>What do you want to do today?</p>
                
                @if(count($userResults)>0)  
                    <input type="radio" id="activity-test" name="activity" value="Test">
                    <label for="activity-test">Test the health equity temperature of:</label><br>
                    <input type="radio" id="activity-review" name="activity" value="Review">
                    <label for="activity-review">Review your previous scores</label><br>
                @else
                    <div>Test the health equity temperature of:</div>
                @endif
                
            </form>
            <form id="activity-target" @if(count($userResults)==0)  class="enabled" @endif  >
                        <input type="radio" id="target-self" class="target-input" value="self" data-input-id="self-name" name="target">
                        <label for="target-self">Yourself</label>
                        <input class="target-text" type="text" id="self-name"><br>
                        <input type="radio" id="target-project" class="target-input" value="project" data-input-id="project-name" name="target">
                        <label for="target-project">A specific project team</label>
                        <input class="target-text" type="text" id="project-name"><br>
                        <input type="radio" id="target-organisation" class="target-input" value="organisation" data-input-id="organisation-name" name="target">
                        <label for="target-organisation">An organisation</label>
                        <input class="target-text" type="text" id="organisation-name"><br>
            </form>
            <button id="back-button" class="button">Back</button>
            <button id="start-button" data-route="{{ 'save-demographics' }}" class="button">Start</button>
        </div>
        

        
    
</div>
          

  

@endsection

<?php


?>
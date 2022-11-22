<?php
use App\Models\QuestionOption;
use App\Models\Result;
use App\Models\UserSession;

//xdebug_break();
?>

@extends('layouts.app', ['page' => __('Previous Results'), 'pageSlug' => 'previous-results'])

@section('content')
<div class="row">
  
  <div class="col-md-12">
    <div class="card  card-plain">
      <div class="card-header">
        <h4 class="card-title">Previous Results</h4>
        <!--<p class="category"> Here is a subtitle for this table</p>-->
      </div>
      <div class="card-body" id="previous-results-container">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                
                <th>
                  Level
                </th>
     

                <th>Interest</th>
                <th>Country</th>
                <th>City</th>
                <th>Job Role</th>
                <th>Organisation/Person</th>
                <th>Target</th>
                <th>Date</th>
                <th>Result</th>
                
              </tr>
             
            </thead>
            <tbody>
            @foreach ($previousResults as $result)
              @php
                        
                $userSession = UserSession::where("result_id", $result->id)->first();
                $resultDemographics = json_decode($userSession["session_values"]);
              @endphp  
              <tr>
                <td>
                  Level: {{$result["level"]}}
                </td>    
                <td>{{$resultDemographics->interest}}</td>
                <td>{{$resultDemographics->country}}</td>
                <td>{{$resultDemographics->city}}</td>
                <td>{{($resultDemographics->jobRole)?$resultDemographics->jobRole:"-"}}</td>
                <td>{{($resultDemographics->organisation)?$resultDemographics->organisation:"-"}}</td>
                <td>{{$resultDemographics->target}}</td>
                <td>{{$userSession["created_at"]}}</td>
                <td><button class="button" data-route="{{url('/result/')}}/<?php echo $result->id?>">View Result</button></td> 
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

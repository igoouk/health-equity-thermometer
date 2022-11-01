<?php

use App\Models\QuestionOption;
use App\Models\Result;

$results = Result::where("user_id", $user->id)->orderByDesc('created_at')->get();
$question_options = QuestionOption::all();
$question_count = QuestionOption::select("question_id")->distinct()->get();

?>

@extends('layouts.app', ['page' => __('User Detail'), 'pageSlug' => 'user-detail'])

@section('content')
<div class="row">
  
  <div class="col-md-12">
    <div class="card  card-plain">
      <div class="card-header">
        <h4 class="card-title">User Detail for User ID {{$user->id}}</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                 Level 
                </th>
                <th>
                  Answers
                </th>
              </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
              
              <tr>
                <td>
                  {{$result["level"]}}
                </td>
                <td>
                  @php
                    $selectedOptions = json_decode($result["selected_options"]);
                  @endphp
                  
                  @foreach ($selectedOptions as $option)
                    Question : {{json_decode($option)->id}}<br>
                    @foreach (json_decode($option)->answers as $answer)
                      @php
                      $answerText = QuestionOption::find($answer)
                      @endphp
                      {{$answerText->text}}
                      <br>
                    @endforeach

                  @endforeach
                  
                    
                </td>
                
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

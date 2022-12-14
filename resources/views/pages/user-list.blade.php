<?php
use App\Models\Result;

?>

@extends('layouts.app', ['page' => __('User List'), 'pageSlug' => 'user-list'])

@section('content')
<div class="row">
  
  <div class="col-md-12">
    <div class="card  card-plain">
      <div class="card-header">
        <h2 class="card-title">User List</h2>
        <!--<p class="category"> Here is a subtitle for this table</p>-->
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                  Email
                </th>
                <th>
                  Latest Score
                </th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                    
              <tr>
                <td>
                  <a href="/userdetail/{{$user['id']}}">{{$user["email"]}}</a>
                </td>
                <td>
                  @php
                    $result = Result::where('user_id', $user['id'])->orderByDesc('created_at')->limit(1)->first();
                  @endphp
                  @if($result)
                    {{$result->level}}
                  @endif
                  
                  
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

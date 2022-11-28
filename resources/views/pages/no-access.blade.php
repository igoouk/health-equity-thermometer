
@extends('layouts.app', ['page' => __('No Access'), 'pageSlug' => 'no-access'])
@section('header', 'No Access Page')
@section('content')


<div id="welcome-container" class="generic-container">
    <div class="container-header">
        You do not have access to view this page.
    </div>
    <div class="container-text">
        
        <br><br>
    </div>
</div>

<div id="footer-container" class="generic-container">
    <img src="/img/funded-by-nihr-logo.png">
</div>


@endsection
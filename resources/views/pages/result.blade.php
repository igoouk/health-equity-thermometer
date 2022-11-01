
@extends('layouts.app', ['page' => __('Result'), 'pageSlug' => 'result'])
@section('header', 'Result Page')
@section('content')
<?php

?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div id="login-container">
                    
                </div>
                <div class="p-6 bg-white border-gray-200" id="instruction-image">
                    {{$latestResult}}
                </div>
                <div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
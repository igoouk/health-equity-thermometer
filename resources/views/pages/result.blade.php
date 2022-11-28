
@extends('layouts.app', ['page' => __('Result'), 'pageSlug' => 'result'])
@section('header', 'Result Page')
@section('content')
<?php
$levelTexts = [
    "",
    "Health equity and health inequalities are <span>confusing</span> concepts",
    "Health equity is important, but there is <span>uncertainty about its relevance</span> to a given piece of work",
    "Identification of health inequalities is straightforward, but application of an equity lens in <span>practice is challenging</span>",
    "Some policies, practices are applied through an equity lens. Additional support to <span>apply that more widely</span> would be welcomed.",
    "<span>All policies, systems, and practices</span> are applied through an equity lens",
    "<span>Patients and the public</span> are involved and engaged at all stages of research. Their contribution is valued and its impact is recorded."]
?>

    <div id="result-container" class="level level--{{$result->level}}">
        <div class="container-header">What is your health equity temperature?</div>
        <div class="container-text">The indicated health equity temperature is based on the first question of the screening tool you didn’t tick all applicable options for, even if you correctly did so for following questions</div>
        <div id="result-content">

            <div id="information-container">

                @for ($i = count($levelTexts)-1; $i > -1; $i--)

                    
                    @php
                        $levelClass = "";

                    if ($result->level >= $i)
                        {
                            $levelClass .= " enabled";
                        }else{
                            $levelClass .= " disabled";
                        }
                    
                    if ($result->level == $i)
                        {
                            $levelClass .= " top";
                        }
                    
                    @endphp
                    <div class="level-info level--{{$i}} {{$levelClass}}" id="level--{{$i}}">
                        <div class="level-indicator"></div>
                        <div class="level-text"><div>{!!$levelTexts[$i]!!}</div></div>
                    </div>
                @endfor
              
                
            </div>
            
        </div>
        <button id="save-pdf-button" class="button" data-route="{{url('/result-pdf/')}}" data-result-id="{{$result->id}}">Save the result as PDF</button>
        <div id="note">Written by Panagaki, K. and the NIHR ARC NWC HEMS PAs Group, Copyright © Lancaster University and the University of Liverpool, 2022
        </div>
    </div>
    
    <div id="footer-container" class="generic-container">
        <img src="/img/funded-by-nihr-logo.png">
    </div>
               

   
@endsection
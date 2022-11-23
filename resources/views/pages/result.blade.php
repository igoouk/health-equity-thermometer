
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
                    <div class="level-info level--{{$i}} {{$levelClass}}" >
                        <div class="level-indicator"></div>
                        <div class="level-text"><div>{!!$levelTexts[$i]!!}</div></div>
                    </div>
                @endfor
                
                
            </div>
            
        </div>
        <button id="save-pdf-button" class="button">Save the result as PDF</button>
        <div id="note">Written by Panagaki, K. and the NIHR ARC NWC HEMS PAs Group, Copyright © Lancaster University and the University of Liverpool, 2022
        </div>
    </div>
    
    <div id="footer-container" class="generic-container">
        <img src="/img/funded-by-nihr-logo.png">
    </div>
               

   
@endsection

@extends('layouts.app', ['page' => __('Result'), 'pageSlug' => 'result'])
@section('header', 'Result Page')
@section('content')
<?php
//xdebug_break();
$levelTexts = [
    "",
    "Health equity and health inequalities are <span>confusing</span> concepts",
    "Health equity is important, but there is <span>uncertainty about its relevance</span> to a given piece of work",
    "Identification of health inequalities is straightforward, but application of an equity lens in <span>practice is challenging</span>",
    "Some policies, practices are applied through an equity lens. Additional support to <span>apply that more widely</span> would be welcomed.",
    "<span>All policies, systems, and practices</span> are applied through an equity lens",
    "<span>Patients and the public</span> are involved and engaged at all stages of research. Their contribution is valued and its impact is recorded."];
$target = "";
$targetS = "s";
switch ($userSession->target) {
    case 'self':
        $target = "you";
        $targetS = "";
        break;
    case 'project':
        $target = "your team";
        break;
    case 'organisation':
        $target = "your organisation";
        break;
    default:
        # code...
        break;
}
?>

    <div id="result-container" class="level level--{{$result->level}}">
        
        <div class="container-header">What is your health equity temperature?</div>
   
        <div class="container-text" id="result-info">
            <span>The indicated health equity temperature is based on the first question of the screening tool you didn’t tick all applicable options for, even if you correctly did so for following questions.</span><br>
        </div>
        <div class="break-line"></div>
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
        <div class="break-line"></div>
        <div id="text-level" class="level-border--{{$result->level}}"><b>According to the answers you provided, {{$target}} appear{{$targetS}} to be on <span class="level--{{$result->level}}">level {{$result->level}}</span>. </b></div>
        <div class="break-line"></div>
        <div class="container-text" id="result-info">
           
            <span>We have compiled a list of resources that we thought you might find useful: <a href="/pdf/Further-Resources.pdf" target="_blank">Download Further Resources</a> </span><br>
            <span>Was this what you expected to get or did the scoring surprise you? </span><br><br>
            
            <span>To find out about research in health inequalities conducted by NIHR ARC NWC and how you can be involved check our <a href="https://arc-nwc.nihr.ac.uk/" target="_blank">website</a></span><br><br>
            
            <span>If you want to find out more about the Health Equity Mainstreaming Strategy and actions NIHR ARC NWC has planned visit our dedicated part of the <a href="https://arc-nwc.nihr.ac.uk/midas/overview/health-equity-mainstreaming-strategy-2020-2024/" target="_blank">website</a></span><br><br>
            
            <span>To discuss how NIHR ARC NWC can support you in implementing an equity lens contact: <a href="mailto:k.panagaki@lancaster.ac.uk" target="_blank">k.panagaki@lancaster.ac.uk</a></span><br><br>
            
            <span>You can also find us on social media <a href="https://twitter.com/arc_nwc" target="_blank">@arc_nwc</a> <a href="https://twitter.com/search?q=%23ImplementEquity&src=typed_query" target="_blank">#ImplementEquity</a></span><br>
        </div>
        <div id="button-container" class="button-container">
            <button id="save-pdf-button" class="button" data-route="{{url('/result-pdf/')}}" data-result-id="{{$result->id}}">Save the result as PDF</button>
            <button id="read-more-button" class="button">Read more here</button>
            <button id="download-thermometer-button" class="button">Download blank thermometer</button>
        </div>
        <div id="note">Written by Panagaki, K. and the NIHR ARC NWC HEMS PAs Group, Copyright © Lancaster University and the University of Liverpool, 2022
        </div>
    </div>
    


   
@endsection
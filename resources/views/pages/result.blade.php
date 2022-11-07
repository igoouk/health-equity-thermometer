
@extends('layouts.app', ['page' => __('Result'), 'pageSlug' => 'result'])
@section('header', 'Result Page')
@section('content')
<?php
$levelTexts = [
    "",
    "Health equity and health inequalities are confusing concepts",
    "Health equity is important, but there is uncertainty about its relevance to a given piece of work",
    "Identification of health inequalities is straightforward, but application of an equity lens in practice is challenging",
    "Some policies, practices are applied through an equity lens. Additional support to apply that more widely would be welcomed.",
    "All policies, systems, and practices are applied through an equity lens",
    "Patients and the public are involved and engaged at all stages of research. Their contribution is valued and its impact is recorded."]
?>

    <div id="result-container" class="level level--{{$latestResult->level}}">
        Your level : {{$latestResult->level}}
        <div class="container-header">What is your health equity temperature?</div>
        <div id="result-content">

            <div id="information-container">

                @for ($i = count($levelTexts)-1; $i > -1; $i--)

                    
                    @php
                        $levelClass = "";

                    if ($latestResult->level >= $i)
                        {
                            $levelClass .= " enabled";
                        }else{
                            $levelClass .= " disabled";
                        }
                    
                    if ($latestResult->level == $i)
                        {
                            $levelClass .= " top";
                        }
                    
                    @endphp
                    <div class="level-info level--{{$i}} {{$levelClass}}" >
                        <div class="level-indicator"></div>
                        <div class="level-text">{{$levelTexts[$i]}}</div>
                    </div>
                @endfor
                
                
            </div>
            
        </div>
        
    </div>
    
              

   
@endsection
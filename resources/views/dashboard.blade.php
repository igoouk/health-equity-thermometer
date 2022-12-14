@extends('layouts.app', ['pageSlug' => 'dashboard'])

@php
use App\Models\Result;

//xdebug_break();
$data_total = Result::all()->count();

$chart_data = DB::table('results')
                 ->select('level', DB::raw('count(*) as total'))
                    ->groupBy('level')
                    ->orderBy('level','asc')
                    ->get();


@endphp

@section('content')


    <div class="card card-chart">
        <div class="card-header ">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h2 class="card-title">Level Distribution</h2>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <div class="chart-area">
                <div id="canvas-container">
                    <canvas id="chartBig1"></canvas> 
                </div>
                
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
            //charts.initDashboardPageCharts();
        });
       
        var chart_data = [];
        var chart_labels = []
        var baseBackgroundColors = [
                    '#a4a5a5',
                    '#E7514C',
                    '#EB9A3F',
                    '#E5B94D',
                    '#99BC76',
                    '#5D748D',
                    '#8D22C4',
                    ]
        var backgroundColorsToUse = [];
            @foreach ($chart_data as $data)
                chart_data.push({{$data->total}});
                chart_labels.push("Level "+ "{{ $data->level }} ");
                backgroundColorsToUse.push(baseBackgroundColors[{{ $data->level }}])
            @endforeach
        var ctx = document.getElementById("chartBig1").getContext('2d');


        var config = {
            type: 'pie',
            
            data: {
                labels: chart_labels,
                datasets: [{
                    
                    label: "Results",
                    fill: true,
                    data: chart_data,
                    backgroundColor: backgroundColorsToUse
                    
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: "left",
                    labels: {
                        boxWidth: 50,
                        padding: 30,
                        fontSize: 16
                    }
                },

                tooltips: {
                    enabled:true,
                    backgroundColor: '#f5f5f5',
                    titleFontColor: '#333',
                    bodyFontColor: '#666',
                    bodySpacing: 4,
                    xPadding: 12,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest"
                }
                ,
                responsive: true,
                title: {
                    display: true,
                    text: 'Total {{$data_total}}',
                    fontSize: 24,
                    position: "bottom"
                }
            
            },
            plugins: [{
                beforeInit: function(chart, args,options) {
                    chart.legend.afterFit = function() {
                        
                        this.legendItems.forEach(element => {
                            element.height = "60px";
                        });
                        
                    };
                }
            }]
        };
        var myChartData = new Chart(ctx, config);
        //# sourceURL=chartSetup.js
    </script>
@endpush

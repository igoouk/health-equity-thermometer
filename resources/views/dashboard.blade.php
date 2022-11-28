@extends('layouts.app', ['pageSlug' => 'dashboard'])

@php
use App\Models\Result;

xdebug_break();

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
                <canvas id="chartBig1"></canvas>
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
        var options = {
            maintainAspectRatio: true,
            legend: {
                display: true
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
            responsive: true
            /*plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                    
                    let sum = 0;
                    let dataArr = ctx.chart.data.datasets[0].data;
                    dataArr.map(data => {
                        sum += data;
                    });
                    let percentage = (value*100 / sum).toFixed(2)+"%";
                    return percentage;

                
                    },
                    color: '#fff',
                        }
            },*/
           
            };
        var chart_labels = ['Level 0', 'Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5', 'Level 6'];
        var chart_data = [0,0,0,0,0,0,0];
            @foreach ($chart_data as $data)
                chart_data[{{ $data->level }}] = {{$data->total}};
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
                    backgroundColor: [
                    '#FFF',
                    '#E7514C',
                    '#EB9A3F',
                    '#E5B94D',
                    '#99BC76',
                    '#5D748D',
                    '#8D22C4',
                    ]
                    
                }]
            },
            options: options
        };
        var myChartData = new Chart(ctx, config);
    </script>
@endpush

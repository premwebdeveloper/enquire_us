@extends('layouts.auth_app')

@section('content')

<link href="{{ asset('resources/assets/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Employee's Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('employees') }}">Employees</a>
            </li>
            <li class="active">
                <strong>Employee's Clients</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 text-right">&nbsp;</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	          
                @foreach($total_emps_clients as $key => $employee)
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>{{ $employee['emp_name'] }}'s Clients </h5>                          
                        </div>
                        <div class="ibox-content">
                            <div id="morris-chart-{{ $employee['emp_uid'] }}"></div>
                        </div>
                    </div>
                </div>

                @endforeach

	        </div>
    	</div>
    </div>
</div>

<script src="{{ asset('resources/assets/js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/plugins/morris/morris.js') }}"></script>

@foreach($total_emps_clients as $t_key => $employee)

    <script type="text/javascript">
        var data = [
            <?php 
                foreach ($employee['month_clients'] as $m_key => $value) {
                    echo json_encode($value).','; 
                }
            ?>

        ],
        config = {
            data: data,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Total Clients'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red']
        };
        // config.element = 'area-chart';
        // Morris.Area(config);
        // config.element = 'line-chart';
        // Morris.Line(config);
        // config.element = 'bar-chart';
        // Morris.Bar(config);
        config.element = 'morris-chart-<?= $employee['emp_uid']; ?>';
        config.stacked = true;
        Morris.Bar(config);
        /*Morris.Donut({
            element: 'pie-chart',
            data: [
                {label: "Friends", value: 30},
                {label: "Allies", value: 15},
                {label: "Enemies", value: 45},
                {label: "Neutral", value: 10}
            ]
        });*/
    </script>

@endforeach


@endsection

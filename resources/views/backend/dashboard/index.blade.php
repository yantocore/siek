@extends('layouts.master')
@section('title','Beranda')
@section('content')
<div class="section-header">
    <h1>Dashboard</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Beranda</div>
    </div>
</div>
<div class="section-body">
    <div class="alert alert-light">
        <div class="row">
            <div class="col-md-6">
                <h6>{{ $greetings }}, {{ Auth::user()->name }}</h6>
            </div>
            <div class="col-md-6">
                <h6 class="text-right">{{ $date->toRfc850String() }}</h6>
            </div>
        </div>
    </div>
    <div class="row">
        @can('cards dashboard')
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Admin</h4>
                </div>
                <div class="card-body">
                    {{ $admins }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengguna Alumni</h4>
                </div>
                <div class="card-body">
                    {{ $users }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Kuesioner</h4>
                </div>
                <div class="card-body">
                    {{ $questionnaires }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Pertanyaan</h4>
                </div>
                <div class="card-body">
                    {{ $questions }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Kriteria</h4>
                </div>
                <div class="card-body">
                    {{ $criterias }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                <i class="fas fa-file"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Himpunan Fuzzy</h4>
                </div>
                <div class="card-body">
                    {{ $sets }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Aturan Fuzzy</h4>
                </div>
                <div class="card-body">
                    {{ $rules }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Responden</h4>
                </div>
                <div class="card-body">
                    {{ $surveys }}
                </div>
                </div>
            </div>
        </div>
        @endcan
    @can('variable charts dashboard')
        @if($variables->count()!=0)
        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="card">
                <div class="card-header" data-step="2" data-intro="Pilih Periode terlebih dahulu lalu Pilih Softskill Periode (Tahun) kemudian tekan Show." data-position='right'>
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <select id="selectSoftskill" class="custom-select">
                                <option selected>Pilih Periode!</option>
                                @foreach ($variables as $variable)
                                    <option value="{{ $variable->softskill }}">Softskill Periode {{ $variable->questionnaire->period }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <input type="button" value="Show" id="showSoftskill" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="gaugeSoftskill"></div>
                </div>
            </div>
        </div>
        @endif
    @endcan
    @can('variable charts dashboard')
        @if($variables->count()!=0)
        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <select id="selectHardskill" class="custom-select">
                                <option selected>Pilih Periode!</option>
                                @foreach ($variables as $variable)
                                    <option value="{{ $variable->hardskill }}">Hardskill Periode {{ $variable->questionnaire->period }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <input type="button" value="Show" id="showHardskill" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="gaugeHardskill"></div>
                </div>
            </div>
        </div>
        @endif
    @endcan
    @can('variable charts dashboard')
        @if($results->count()!=0)
        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <select id="selectPerformance" class="custom-select">
                                <option selected>Pilih Periode!</option>
                                @foreach ($results as $result)
                                    <option value="{{ $result->performance }}">Kinerja Periode {{ $result->variable->questionnaire->period }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <input type="button" value="Show" id="showPerformance" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="gaugePerformance"></div>
                </div>
            </div>
        </div>
        @endif
    @endcan
    @can('variable charts dashboard')
        @if($variables->count()!=0)
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <strong>Diagram Hasil Perhitungan Kuesioner</strong>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="barchart" class="responsivechart"></div>
                </div>
            </div>
        </div>
        @endif
    @endcan
    @can('result charts dashboard')
        @if($results->count()!=0)
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <strong>Diagram Hasil Perhitungan Evaluasi Kinerja</strong>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="resultbarchart" class="responsivechart"></div>
                </div>
            </div>
        </div>
        @endif
    @endcan
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

//Barchart
    var databars = <?php echo $databars; ?>;
    console.log(databars);
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBarChart);
    function drawBarChart() {
        var databar = google.visualization.arrayToDataTable(databars);
        var options = {
            chart: {
            title: 'Hasil Kuesioner',
            subtitle: 'Perhitungan Softskill & Hardskill Berdasarkan Periode',
            },
            bars: 'vertical' // Required for Material Bar Charts.
        };
        var chart = new google.charts.Bar(document.getElementById('barchart'));
        chart.draw(databar, options);
    }

//ResultBarchart
    var dataresultbars = <?php echo $dataresultbars; ?>;
    console.log(dataresultbars);
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawResultBarChart);
    function drawResultBarChart() {
        var dataresultbar = google.visualization.arrayToDataTable(dataresultbars);
        var options = {
            chart: {
            title: 'Evaluasi Kinerja Alumni',
            subtitle: 'Evaluasi Kinerja Berdasarkan Periode',
            },
            bars: 'vertical' // Required for Material Bar Charts.
        };
        var chart = new google.charts.Bar(document.getElementById('resultbarchart'));
        chart.draw(dataresultbar, options);
    }

//Gauge Softskill
$(function () {

    $('#gaugeSoftskill').highcharts({

	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },

        credits: {
            enabled: false
        },

	    title: {
	        text: 'Softskill'
	    },

	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },

	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 100,

	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',

	        tickPixelInterval: 30,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Softskill'
	        },
	        plotBands: [{
	            from: 0,
	            to: 60,
	            color: '#DF5353' // red
	        }, {
	            from: 60,
	            to: 80,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 80,
	            to: 100,
	            color: '#55BF3B' // green
	        }]
	    },

	    series: [{
	        name: 'Softskill',
	        data: [0],
	        tooltip: {
	            valueSuffix: ' '
	        }
	    }]

	});

    $('#selectSoftskill').change(function(){
        x = document.getElementById("selectSoftskill").value;
    });


    $('#showSoftskill').click(function(){
        var point = $('#gaugeSoftskill').highcharts().series[0].points[0];
        point.update(parseFloat(x));
    });
});

//Gauge Hardskill
$(function () {

    $('#gaugeHardskill').highcharts({

	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },

        credits: {
            enabled: false
        },

	    title: {
	        text: 'Hardskill'
	    },

	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },

	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 100,

	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',

	        tickPixelInterval: 30,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Hardskill'
	        },
	        plotBands: [{
	            from: 0,
	            to: 60,
	            color: '#DF5353' // red
	        }, {
	            from: 60,
	            to: 80,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 80,
	            to: 100,
	            color: '#55BF3B' // green
	        }]
	    },

	    series: [{
	        name: 'Hardskill',
	        data: [0],
	        tooltip: {
	            valueSuffix: ' '
	        }
	    }]

	});

    $('#selectHardskill').change(function(){
        x = document.getElementById("selectHardskill").value;
    });


    $('#showHardskill').click(function(){
        var point = $('#gaugeHardskill').highcharts().series[0].points[0];
        point.update(parseFloat(x));
    });
});

//Gauge Performance
$(function () {

    $('#gaugePerformance').highcharts({

	    chart: {
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },

        credits: {
            enabled: false
        },

	    title: {
	        text: 'Performance'
	    },

	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },

	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 100,

	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',

	        tickPixelInterval: 30,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Performance'
	        },
	        plotBands: [{
	            from: 0,
	            to: 60,
	            color: '#DF5353' // red
	        }, {
	            from: 60,
	            to: 80,
	            color: '#DDDF0D' // yellow
	        }, {
	            from: 80,
	            to: 100,
	            color: '#55BF3B' // green
	        }]
	    },

	    series: [{
	        name: 'Performance',
	        data: [0],
	        tooltip: {
	            valueSuffix: ' '
	        }
	    }]

	});

    $('#selectPerformance').change(function(){
        x = document.getElementById("selectPerformance").value;
    });


    $('#showPerformance').click(function(){
        var point = $('#gaugePerformance').highcharts().series[0].points[0];
        point.update(parseFloat(x));
    });
});

document.getElementById('startButton').onclick = function() {
    introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
        window.location.href = 'users?multipage=true';
    });
};

</script>
@endpush

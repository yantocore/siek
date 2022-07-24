@extends('layouts.master')
@section('title','Hasil Kuesioner')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('variables.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Kuesioner Periode {{ $period }}</h1>
    {{-- <div class="section-header-button">
        <a href="{{ url('variables/'.$variable->questionnaire->id.'/export-pdf') }}" class="btn btn-icon icon-left btn-primary fas fa-print" title="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak PDF"> Cetak PDF</a>
    </div> --}}
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('variables.index') }}">Kelola Variabel</a></div>
      <div class="breadcrumb-item">Kuesioner Periode {{ $period }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary shadow">
                <div class="card-header">
                <h4>Perhitungan Kuesioner Periode {{ $period }}</h4>
                {{-- <fieldset>
                    <form action="{{ url('variables/'.$variable->questionnaire->id.'/evaluate') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-icon icon-left btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hitung Fuzzy Sugeno"><i class="fas fa-calculator"></i> Hitung Fuzzy Sugeno</button>
                    </form>
                </fieldset> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="variables_softskill">
                            <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kriteria</th>
                                <th>Pertanyaan</th>
                                <th>Pilihan Jawaban</th>
                                <th>Jumlah</th>
                                <th>Skor</th>
                                <th>Total Skor</th>
                                <th>Rumus Index %</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sum_index_softskill = 0
                            @endphp
                            @foreach ($softskills as $key=> $question)
                                <tr class="text-center align-middle">
                                    <td class="align-middle">{{ $key+1 }}</td>
                                    <td class="align-middle">{{ $question->criteria->name }}</td>
                                    <td class="align-middle">{{ $question->name }}</td>
                                    <td>
                                        @foreach ($question->answers as $key=> $answer)
                                            @if($key!=0)
                                                <hr>
                                            @endif
                                            {{ $answer->name }}
                                        @endforeach
                                    </td>
                                    <td >
                                        @foreach ($question->answers as $key=> $answer)
                                            @if($key!=0)
                                                <hr>
                                            @endif
                                            {{ $answer->surveyresponses->count() }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $sum_skor = 0
                                        @endphp
                                        @foreach ($question->answers as $key=> $answer)
                                            @if($key!=0)
                                                <hr>
                                            @endif
                                            {{ $answer->surveyresponses->count()*$answer->value }}
                                        @php
                                            $sum_skor += $answer->surveyresponses->count()*$answer->value
                                        @endphp
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        {{ $sum_skor}}
                                    </td>
                                    <td class="align-middle">
                                        {{ number_format($softskill_index = ($sum_skor/($max_answer_value*$question->questionnaire->surveys->count()))*100, 2, '.', '') }} %
                                    </td>
                                </tr>
                            @php
                                $sum_index_softskill += $softskill_index
                            @endphp
                            @endforeach
                            @php
                                $softskill = $sum_index_softskill/$count_question_softskill
                            @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                    <div>
                        <h6>Rata-Rata Softskill : {{ number_format($softskill, 2, '.', '') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary shadow">
                <div class="card-header">
                <h4>Perhitungan Kuesioner Periode {{ $period }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped calculate" id="variables_hardskill">
                            <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kriteria</th>
                                <th>Pertanyaan</th>
                                <th>Pilihan Jawaban</th>
                                <th>Jumlah</th>
                                <th>Skor</th>
                                <th>Total Skor</th>
                                <th>Rumus Index %</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sum_index_hardskill = 0
                            @endphp
                            @foreach ($hardskills as $key=> $question)
                                <tr class="text-center align-middle">
                                    <td class="align-middle">{{ $key+1 }}</td>
                                    <td class="align-middle">{{ $question->criteria->name }}</td>
                                    <td class="align-middle">{{ $question->name }}</td>
                                    <td>
                                        @foreach ($question->answers as $key=> $answer)
                                            @if($key!=0)
                                                <hr>
                                            @endif
                                            {{ $answer->name }}
                                        @endforeach
                                    </td>
                                    <td >
                                        @foreach ($question->answers as $key=> $answer)
                                            @if($key!=0)
                                                <hr>
                                            @endif
                                            {{ $answer->surveyresponses->count() }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $sum_skor = 0
                                        @endphp
                                        @foreach ($question->answers as $key=> $answer)
                                            @if($key!=0)
                                                <hr>
                                            @endif
                                            {{ $answer->surveyresponses->count()*$answer->value }}
                                        @php
                                            $sum_skor += $answer->surveyresponses->count()*$answer->value
                                        @endphp
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        {{ $sum_skor}}
                                    </td>
                                    <td class="align-middle">
                                        {{ number_format($hardskill_index = ($sum_skor/($max_answer_value*$question->questionnaire->surveys->count()))*100, 2, '.', '') }} %
                                    </td>
                                </tr>
                                @php
                                    $sum_index_hardskill += $hardskill_index
                                @endphp
                            @endforeach
                            @php
                                $hardskill = $sum_index_hardskill/$count_question_hardskill
                            @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                    <div>
                        <h6>Rata-Rata Hardskill : {{ number_format($hardskill, 2, '.', '') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary shadow">
                <div class="card-header">
                    <h4>Grafik Hasil Perhitungan Kuesioner {{ $period }}</h4>
                </div>
                <div class="card-body">
                    <div id="gaugechart"></div>
                    <p>Hasil Perhitungan Kuesioner (Softskill & Hardskill) Periode {{ $period }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

// Gauge Chart
    var datavariables = <?php echo $datavariables; ?>;
    console.log(datavariables);
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(datavariables);
        var options = {
            title: 'Perhitungan Softskill & Hardskill Berdasarkan Periode',
            width: 400, height: 250,
            redFrom: 0, redTo: 60,
            yellowFrom: 60, yellowTo: 80,
            greenFrom: 80, greenTo: 100,
            majorTicks: ['0','10','20','30','40','50','60','70','80','90', '100'],
            minorTicks: 10

        };

        var chart = new google.visualization.Gauge(document.getElementById('gaugechart'));
        chart.draw(data, options);

    }

    $(window).resize(function(){
        drawChart();
    });

</script>
@endpush

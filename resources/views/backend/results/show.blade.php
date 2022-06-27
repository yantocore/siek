@extends('layouts.master')
@section('title','Evaluasi Fuzzy Sugeno Orde Nol')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('results.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Evaluasi Fuzzy Sugeno Orde Nol</h1>
    <div class="section-header-button">
        <a href="{{ url('results/'.$result->id.'/export-pdf') }}" class="btn btn-icon icon-left btn-primary fas fa-print" title="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak PDF"> Cetak PDF</a>
    </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('results.index') }}">Beranda</a></div>
      <div class="breadcrumb-item">Evaluasi Fuzzy Sugeno Orde Nol</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Data Variabel</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="results_variables">
                        <thead>
                        <tr class="text-center">
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Periode Kuesioner</th>
                            <th colspan="2" class="align-middle">Variabel</th>
                        </tr>
                        <tr class="text-center">
                            <th>Softskill</th>
                            <th>Hardskill</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($variables as $key=> $variable)
                        <tr class="text-center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $variable->questionnaire->period }}</td>
                            <td>{{ $variable->softskill }}</td>
                            <td>{{ $variable->hardskill }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Fuzzyfikasi (Fungsi Keanggotaan)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="fuzzyfication">
                        <thead>
                        <tr class="text-center">
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Periode Kuesioner</th>
                            @foreach ($criterias as $criteria)
                            <th colspan="3">{{ $criteria->name }}</th>
                            @endforeach
                        </tr>
                        <tr class="text-center">
                            <th>&micro; Kurang</th>
                            <th>&micro; Cukup</th>
                            <th>&micro; Baik</th>
                            <th>&micro; Kurang</th>
                            <th>&micro; Cukup</th>
                            <th>&micro; Baik</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($variables as $key=> $variable)
                        <tr class="text-center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $variable->questionnaire->period }}</td>
                            {{-- //softskill_kurang --}}
                                @if ($variable->softskill<=$set_kurang->right_up)
                                    <td>{{ $softskill_kurang = number_format(1, 2, '.', '') }}</td>
                                @elseif($set_kurang->right_up<=$variable->softskill && $variable->softskill<=$set_kurang->right_down)
                                    <td>{{ $softskill_kurang = number_format(($set_kurang->right_down - $variable->softskill)/($set_kurang->right_down - $set_kurang->right_up), 2, '.', '') }}</td>
                                @elseif($variable->softskill>=$set_kurang->right_down)
                                    <td>{{ $softskill_kurang = number_format(0, 2, '.', '') }}</td>
                                @endif
                            {{-- //softskill_cukup --}}
                                @if ($variable->softskill<=$set_cukup->left_up)
                                    <td>{{ $softskill_cukup = number_format(0, 2, '.', '') }}</td>
                                @elseif($set_cukup->left_down<=$variable->softskill && $variable->softskill<=$set_cukup->left_up)
                                    <td>{{ $softskill_cukup = number_format(($variable->softskill - $set_cukup->left_down)/($set_cukup->left_up - $set_cukup->left_down), 2, '.', '') }}</td>
                                @elseif($set_cukup->left_up<=$variable->softskill && $variable->softskill<=$set_cukup->right_up)
                                    <td>{{ $softskill_cukup = number_format(1, 2, '.', '') }}</td>
                                @elseif($variable->softskill>=$set_cukup->right_up)
                                    <td>{{ $softskill_cukup = number_format(0, 2, '.', '') }}</td>
                                @endif
                            {{-- //softskill_baik --}}
                                @if ($variable->softskill<=$set_baik->left_down)
                                    <td>{{ $softskill_baik = number_format(0, 2, '.', '') }}</td>
                                @elseif($set_baik->left_down<=$variable->softskill && $variable->softskill<=$set_baik->left_up)
                                    <td>{{ $softskill_baik = number_format(($variable->softskill - $set_baik->left_down)/($set_baik->left_up - $set_baik->left_down), 2, '.', '') }}</td>
                                @elseif($variable->softskill>=$set_baik->left_up)
                                    <td>{{ $softskill_baik = number_format(1, 2, '.', '') }}</td>
                                @endif

                            {{-- //hardskill_kurang --}}
                                @if ($variable->hardskill<=$set_kurang->right_up)
                                    <td>{{ $hardskill_kurang = number_format(1, 2, '.', '') }}</td>
                                @elseif($set_kurang->right_up<=$variable->hardskill && $variable->hardskill<=$set_kurang->right_down)
                                    <td>{{ $hardskill_kurang = number_format(($set_kurang->right_down - $variable->hardskill)/($set_kurang->right_down - $set_kurang->right_up), 2, '.', '') }}</td>
                                @elseif($variable->hardskill>=$set_kurang->right_down)
                                    <td>{{ $hardskill_kurang = number_format(0, 2, '.', '') }}</td>
                                @endif

                            {{-- //hardskill_cukup --}}
                                @if ($variable->hardskill<=$set_cukup->left_up)
                                    <td>{{ $hardskill_cukup = number_format(0, 2, '.', '') }}</td>
                                @elseif($set_cukup->left_down<=$variable->hardskill && $variable->hardskill<=$set_cukup->left_up)
                                    <td>{{ $hardskill_cukup = number_format(($variable->hardskill - $set_cukup->left_down)/($set_cukup->left_up - $set_cukup->left_down), 2, '.', '') }}</td>
                                @elseif($set_cukup->left_up<=$variable->hardskill && $variable->hardskill<=$set_cukup->right_up)
                                    <td>{{ $hardskill_cukup = number_format(1, 2, '.', '') }}</td>
                                @elseif($variable->hardskill>=$set_cukup->right_up)
                                    <td>{{ $hardskill_cukup = number_format(0, 2, '.', '') }}</td>
                                @endif

                            {{-- //hardskill_baik --}}
                                @if ($variable->hardskill<=$set_baik->left_down)
                                    <td>{{ $hardskill_baik = number_format(0, 2, '.', '') }}</td>
                                @elseif($set_baik->left_down<=$variable->hardskill && $variable->hardskill<=$set_baik->left_up)
                                    <td>{{ $hardskill_baik = number_format(($variable->hardskill - $set_baik->left_down)/($set_baik->left_up - $set_baik->left_down), 2, '.', '') }}</td>
                                @elseif($variable->hardskill>=$set_baik->left_up)
                                    <td>{{ $hardskill_baik = number_format(1, 2, '.', '') }}</td>
                                @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Aturan Fuzzy</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="rules">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Aturan</th>
                            <th>Softskill</th>
                            <th>Hardskill</th>
                            <th>Kinerja</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($rules as $key=> $rule)
                        <tr class="text-center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $rule->name }}</td>
                            <td>{{ $rule->first_set }}</td>
                            <td>{{ $rule->second_set }}</td>
                            <td>{{ $rule->performance }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>&alpha;-Predikat</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="alpha_predicate">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Periode Kuesioner</th>
                            @foreach ($rules as $key => $rule)
                                <th>&alpha;-Predikat ({{ $rule->name }})</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($variables as $key=> $variable)
                        <tr class="text-center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $variable->questionnaire->period }}</td>
                            <td>{{ $alpha_satu = min($softskill_kurang,$hardskill_kurang) }}</td>
                            <td>{{ $alpha_dua = min($softskill_kurang,$hardskill_cukup) }}</td>
                            <td>{{ $alpha_tiga = min($softskill_kurang,$hardskill_baik) }}</td>
                            <td>{{ $alpha_empat = min($softskill_cukup,$hardskill_kurang) }}</td>
                            <td>{{ $alpha_lima = min($softskill_cukup,$hardskill_cukup) }}</td>
                            <td>{{ $alpha_enam = min($softskill_cukup,$hardskill_baik) }}</td>
                            <td>{{ $alpha_tujuh = min($softskill_baik,$hardskill_kurang) }}</td>
                            <td>{{ $alpha_delapan = min($softskill_baik,$hardskill_cukup) }}</td>
                            <td>{{ $alpha_sembilan = min($softskill_baik,$hardskill_baik) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Nilai Z</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="z_value">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Periode Kuesioner</th>
                            @foreach ($rules as $key => $rule)
                                <th>Z{{ $key+1 }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($variables as $key=> $variable)
                        <tr class="text-center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $variable->questionnaire->period }}</td>
                            @foreach ($rules as $key => $rule)
                            <td>{{ $rule->performance  }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Defuzzyfikasi (Hasil Akhir/Kinerja)</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="defuzzification">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Periode Kuesioner</th>
                            <th>Kinerja</th>
                            <th>Predikat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sum_alpha_z = ($alpha_satu*$z_satu['performance']+$alpha_dua*$z_dua['performance']+$alpha_tiga*$z_tiga['performance']+$alpha_empat*$z_empat['performance']+$alpha_lima*$z_lima['performance']+$alpha_enam*$z_enam['performance']+$alpha_tujuh*$z_tujuh['performance']+$alpha_delapan*$z_delapan['performance']+$alpha_sembilan*$z_sembilan['performance']);
                            $sum_alpha = ($alpha_satu+$alpha_dua+$alpha_tiga+$alpha_empat+$alpha_lima+$alpha_enam+$alpha_tujuh+$alpha_delapan+$alpha_sembilan);
                        @endphp
                        @foreach ($variables as $key=> $variable)
                        <tr class="text-center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $variable->questionnaire->period }}</td>
                            @if ($sum_alpha>0 && $sum_alpha_z>0)
                                <td>{{ $nilai_z = round($sum_alpha_z/$sum_alpha,2) }}</td>
                            @else
                                <td>{{ $nilai_z = number_format(0, 2, '.', '') }}</td>
                            @endif
                            @if (round($sum_alpha_z/$sum_alpha,2) <= 60)
                            <td>Kurang</td>
                            @elseif (round($sum_alpha_z/$sum_alpha,2) >= 61 && round($sum_alpha_z/$sum_alpha,2) < 80)
                            <td>Cukup</td>
                            @elseif (round($sum_alpha_z/$sum_alpha,2) >= 81)
                            <td>Baik</td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Grafik Pengukur Hasil Perhitungan Evaluasi Kinerja</h4>
            </div>
            <div class="card-body">
                <div id="resultgaugechart"></div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

//ResultGaugeChart
    var dataresults = <?php echo $dataresults; ?>;
    console.log(dataresults);
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawResultChart);
    function drawResultChart() {
        var dataresult = google.visualization.arrayToDataTable(dataresults);
        var options = {
            title: 'Evaluasi Kinerja Alumni Berdasarkan Periode',
            redFrom: 0, redTo: 60,
            yellowFrom: 60, yellowTo: 80,
            greenFrom: 80, greenTo: 100,
            majorTicks: ['0','10','20','30','40','50','60','70','80','90', '100'],
            minorTicks: 10
        };

        var chart = new google.visualization.Gauge(document.getElementById('resultgaugechart'));
        chart.draw(dataresult, options);
    }

    $(window).resize(function(){
        drawResultChart();
    });

</script>
@endpush

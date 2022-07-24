<!DOCTYPE html>
<html>
  <head>
    <title>PDF Demo in Laravel 7</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}
    <style>
        table, td, th {
          border: 1px solid black;
          text-align: center;
        }

        table {
          border-collapse: collapse;
          width: 100%;
        }

        th {
          height: 50px;
        }
    </style>
</head>
  <body>
    @foreach ($variables as $variable)
        <h4 class="text-center">Laporan Hasil Perhitungan Evaluasi Kinerja Alumni Berdasarkan Tingkat Kepuasan Pengguna Alumni terhadap Stakeholder Periode {{ $variable->questionnaire->period }}.</h4>
    @endforeach
    <hr>
    <div>
        <h4>Data Variabel</h4>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center table-primary">
                    <th rowspan="2" class="align-middle">No</th>
                    <th rowspan="2" class="align-middle">Periode Kuesioner</th>
                    <th colspan="2" class="align-middle">Variabel</th>
                </tr>
                <tr class="text-center table-primary">
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
    <br>
    <div>
        <h4>Fuzzyfikasi (Fungsi Keanggotaan)</h4>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center table-primary">
                    <th rowspan="2" class="align-middle">No</th>
                    <th rowspan="2" class="align-middle">Periode Kuesioner</th>
                    @foreach ($criterias as $criteria)
                    <th colspan="3">{{ $criteria->name }}</th>
                    @endforeach
                </tr>
                <tr class="text-center table-primary">
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
                        @if ($variable->softskill <= $set_kurang->right_up)
                            <td>{{ $softskill_kurang = number_format(1, 2, '.', '') }}</td>
                        @elseif($set_kurang->right_up < $variable->softskill && $variable->softskill < $set_kurang->right_down)
                            <td>{{ $softskill_kurang = number_format(($set_kurang->right_down - $variable->softskill)/($set_kurang->right_down - $set_kurang->right_up), 2, '.', '') }}</td>
                        @elseif($variable->softskill >= $set_kurang->right_down)
                            <td>{{ $softskill_kurang = number_format(0, 2, '.', '') }}</td>
                        @endif
                    {{-- //softskill_cukup --}}
                        @if ($variable->softskill <= $set_cukup->left_down)
                            <td>{{ $softskill_cukup = number_format(0, 2, '.', '') }}</td>
                        @elseif($set_cukup->left_down < $variable->softskill && $variable->softskill<=$set_cukup->left_up)
                            <td>{{ $softskill_cukup = number_format(($variable->softskill - $set_cukup->left_down)/($set_cukup->left_up - $set_cukup->left_down), 2, '.', '') }}</td>
                        @elseif($set_cukup->left_up < $variable->softskill && $variable->softskill <= $set_cukup->right_up)
                            <td>{{ $softskill_cukup = number_format(1, 2, '.', '') }}</td>
                        @elseif($set_cukup->right_up < $variable->softskill && $variable->softskill < $set_cukup->right_down)
                            <td>{{ $softskill_cukup = number_format(($set_cukup->right_down - $variable->softskill)/($set_cukup->right_down - $set_cukup->right_up), 2, '.', '') }}</td>
                        @elseif($variable->softskill >= $set_cukup->right_down)
                            <td>{{ $softskill_cukup = number_format(0, 2, '.', '') }}</td>
                        @endif
                    {{-- //softskill_baik --}}
                        @if ($variable->softskill <= $set_baik->left_down)
                            <td>{{ $softskill_baik = number_format(0, 2, '.', '') }}</td>
                        @elseif($set_baik->left_down < $variable->softskill && $variable->softskill <= $set_baik->left_up)
                            <td>{{ $softskill_baik = number_format(($variable->softskill - $set_baik->left_down)/($set_baik->left_up - $set_baik->left_down), 2, '.', '') }}</td>
                        @elseif($variable->softskill >= $set_baik->left_up)
                            <td>{{ $softskill_baik = number_format(1, 2, '.', '') }}</td>
                        @endif

                    {{-- //hardskill_kurang --}}
                        @if ($variable->hardskill <= $set_kurang->right_up)
                            <td>{{ $hardskill_kurang = number_format(1, 2, '.', '') }}</td>
                        @elseif($set_kurang->right_up < $variable->hardskill && $variable->hardskill < $set_kurang->right_down)
                            <td>{{ $hardskill_kurang = number_format(($set_kurang->right_down - $variable->hardskill)/($set_kurang->right_down - $set_kurang->right_up), 2, '.', '') }}</td>
                        @elseif($variable->hardskill >= $set_kurang->right_down)
                            <td>{{ $hardskill_kurang = number_format(0, 2, '.', '') }}</td>
                        @endif
                    {{-- //hardskill_cukup --}}
                        @if ($variable->hardskill <= $set_cukup->left_down)
                            <td>{{ $hardskill_cukup = number_format(0, 2, '.', '') }}</td>
                        @elseif($set_cukup->left_down < $variable->hardskill && $variable->hardskill<=$set_cukup->left_up)
                            <td>{{ $hardskill_cukup = number_format(($variable->hardskill - $set_cukup->left_down)/($set_cukup->left_up - $set_cukup->left_down), 2, '.', '') }}</td>
                        @elseif($set_cukup->left_up < $variable->hardskill && $variable->hardskill <= $set_cukup->right_up)
                            <td>{{ $hardskill_cukup = number_format(1, 2, '.', '') }}</td>
                        @elseif($set_cukup->right_up < $variable->hardskill && $variable->hardskill < $set_cukup->right_down)
                            <td>{{ $hardskill_cukup = number_format(($set_cukup->right_down - $variable->hardskill)/($set_cukup->right_down - $set_cukup->right_up), 2, '.', '') }}</td>
                        @elseif($variable->hardskill >= $set_cukup->right_down)
                            <td>{{ $hardskill_cukup = number_format(0, 2, '.', '') }}</td>
                        @endif
                    {{-- //hardskill_baik --}}
                        @if ($variable->hardskill <= $set_baik->left_down)
                            <td>{{ $hardskill_baik = number_format(0, 2, '.', '') }}</td>
                        @elseif($set_baik->left_down < $variable->hardskill && $variable->hardskill <= $set_baik->left_up)
                            <td>{{ $hardskill_baik = number_format(($variable->hardskill - $set_baik->left_down)/($set_baik->left_up - $set_baik->left_down), 2, '.', '') }}</td>
                        @elseif($variable->hardskill >= $set_baik->left_up)
                            <td>{{ $hardskill_baik = number_format(1, 2, '.', '') }}</td>
                        @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <h4>Aturan Fuzzy</h4>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center table-primary">
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
    <br>
    <div>
        <h4>Alpha Predikat</h4>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center table-primary">
                    <th>No</th>
                    <th>Periode Kuesioner</th>
                    @foreach ($rules as $key => $rule)
                        <th>a-p ({{ $rule->name }})</th>
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
    <br>
    <div>
        <h4>Nilai Z</h4>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center table-primary">
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
    <br>
    <div>
        <h4>Defuzzyfikasi (Hasil Akhir/Kinerja)</h4>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center table-primary">
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
                        <td>{{ round($sum_alpha_z/$sum_alpha,2) }}</td>
                    @else
                        <td>{{ number_format(0, 2, '.', '') }}</td>
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
    <br>
  </body>
</html>

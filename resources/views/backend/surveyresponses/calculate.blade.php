@extends('layouts.master')
@section('title','Hasil Kuesioner')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('surveyresponses.show',$questionnaire_id) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Hitung Kuesioner</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('surveyresponses.show',$questionnaire_id) }}">Kelola Hasil Kuesioner</a></div>
      <div class="breadcrumb-item">Hitung Kuesioner</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary shadow">
                <div class="card-header">
                <h4>Perhitungan Kuesioner Periode {{ $period }} (Softskill)</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="softskill">
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
                                            {{ $answer->name }} <br>
                                        @endforeach
                                    </td>
                                    <td >
                                        @foreach ($question->answers as $key=> $answer)
                                            @if($key!=0)
                                                <hr>
                                            @endif
                                            {{ $answer->surveyresponses->count() }} <br>
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
                                            {{ $answer->surveyresponses->count()*$answer->value }} <br>
                                        @php
                                            $sum_skor += $answer->surveyresponses->count()*$answer->value
                                        @endphp
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        {{ $sum_skor}}
                                    </td>
                                    <td class="align-middle">
                                        {{ $softskill_index = ($sum_skor/($max_answer_value*$question->questionnaire->surveys->count()))*100 }} %
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
                <h4>Perhitungan Kuesioner Periode {{ $period }} (Hardskill)</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped calculate" id="hardskill">
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
                                            {{ $answer->name }} <br>
                                        @endforeach
                                    </td>
                                    <td >
                                        @foreach ($question->answers as $key=> $answer)
                                            @if($key!=0)
                                                <hr>
                                            @endif
                                            {{ $answer->surveyresponses->count() }} <br>
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
                                            {{ $answer->surveyresponses->count()*$answer->value }} <br>
                                        @php
                                            $sum_skor += $answer->surveyresponses->count()*$answer->value
                                        @endphp
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        {{ $sum_skor}}
                                    </td>
                                    <td class="align-middle">
                                        {{ $hardskill_index = ($sum_skor/($max_answer_value*$question->questionnaire->surveys->count()))*100 }} %
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
</div>
@endsection

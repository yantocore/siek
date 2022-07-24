@extends('layouts.master')
@section('title','Lihat Hasil Kuesioner')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('surveyresponses.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Lihat Hasil Kuesioner</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item"><a href="{{ route('surveyresponses.index') }}">Kelola Hasil Kuesioner</a></div>
      <div class="breadcrumb-item">Lihat Hasil Kuesioner</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
                <h4>Data Hasil Tahun {{ $period }}</h4>
                {{-- @can('calculate surveyresponses')
                <fieldset>
                    <form action="{{ url('surveyresponses/'.$questionnaire.'/calculate') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-icon icon-left btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hitung Kuesioner"><i class="fas fa-calculator"></i> Hitung</button>
                    </form>
                </fieldset>
                @endcan --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="surveyresponses_show">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Pengguna Alumni</th>
                            <th>Periode</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($surveys as $key => $survey)
                        <tr class="text-center">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $survey->user->name }}</td>
                            <td>{{ $survey->questionnaire->period }}</td>
                            <td>
                                @can('show by user surveyresponses')
                                <a href="{{ url('surveyresponses/'.$survey->questionnaire_id.'/users',$survey->user->id) }}" class="btn btn-sm btn-primary far fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"></a>
                                @endcan
                                @can('delete by user surveyresponses')
                                <form style="display:inline" action="{{ url('surveyresponses/'.$survey->questionnaire_id.'/users',$survey->user->id) }}" id="delete" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger far fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.master')
@section('title','Lihat Kuesioner')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('questionnaires.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Lihat Kuesioner</h1>
    @can('show surveys')
    <div class="section-header-button">
        <a href="{{ url('surveys',$questionnaire->id.'-'.Str::slug($questionnaire->title)) }}" class="btn btn-icon icon-left btn-primary fas fa-eye" title="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Preview Survey"> Preview</a>
    </div>
    @endcan
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item"><a href="{{ route('questionnaires.index') }}">Kelola Kuesioner</a></div>
      <div class="breadcrumb-item">Lihat Kuesioner</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="col-sm-6">{{ $questionnaire->title }}</h4>
                    @can('show surveys')
                    <pre class="language-javascript col-sm-6"><code>{{ $questionnaire->publicPath() }}</code></pre>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="section-title mt-0">Deskripsi</div>
                    <blockquote>{{ $questionnaire->purpose }}.</blockquote>

                @if(count($questionnaire->questions) != 7)
                    <form action="{{ route('questionnaires.assign_questions', $questionnaire->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary far fa-plus" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Pertanyaan"> Tambah Pertanyaan</button>
                    </form>
                @elseif(count($questionnaire->questions) == 7)
                    @foreach ($questionnaire->questions as $key => $question)
                    <div class="form-group">
                        <label class="d-block">{{$key+1}}. Bagaimana penilaian terhadap {{ $question->name }} alumni kami di instansi anda ?</label>
                        @if(count($question->answers) != 4)
                            <form action="{{ url('questionnaires/'.$questionnaire->id.'/questions',$question->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary far fa-plus" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Pilihan Jawaban"> Tambah Pilihan Jawaban</button>
                            </form>
                        @elseif(count($question->answers) == 4)
                            @foreach ($question->answers as $answer)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="answer{{ $answer->id }}" name="survey_responses[{{ $key }}][answer_id]" class="custom-control-input">
                                <label class="custom-control-label" for="answer{{ $answer->id }}">{{ $answer->name }}</label>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.master')
@section('title','Isi Kuesioner')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('surveys.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Isi Kuesioner</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item">Isi Kuesioner</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ $questionnaire->title }}</h4>
                </div>
                <div class="card-body">
                    <div class="section-title mt-0">Deskripsi</div>
                    <blockquote>{{ $questionnaire->purpose }}.</blockquote>
                </div>
                <form action="{{ url('surveys',$questionnaire->id.'-'.Str::slug($questionnaire->title)) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @foreach ($questionnaire->questions as $key => $question)
                            @error('survey_responses.' . $key . '.answer_id')
                                    <small class="text-danger">{{ $message }}</small>
                            @enderror
                        <div class="form-group">
                            <label class="d-block">{{$key+1}}. Bagaimana penilaian terhadap <b>{{ $question->name }}</b> alumni kami di instansi anda ?</label>
                            @foreach ($question->answers as $answer)
                            <div class="custom-control-inline custom-radio custom-control">
                                <input type="radio" id="answer{{ $answer->id }}" name="survey_responses[{{ $key }}][answer_id]" {{ (old('survey_responses.'.$key.'.answer_id') == $answer->id) ? 'checked' : '' }} value="{{ $answer->id }}" class="custom-control-input" required="">
                                <label class="custom-control-label" for="answer{{ $answer->id }}">{{ $answer->name }}</label>
                            </div>
                            <input type="hidden" name="survey_responses[{{ $key }}][question_id]" value="{{ $question->id }}">
                            @endforeach
                        </div>
                        @endforeach
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Nama Instansi</label>
                            <div class="col-sm-12 col-md-5">
                                <input class="form-control" type="text" name="surveys[agency]"  value="{{ old('surveys[agency]') }}" class="form-control" placeholder="Isikan Nama Instansi" required="">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Bidang Usaha</label>
                            <div class="col-sm-12 col-md-5">
                                <input class="form-control" type="text" name="surveys[agency_field]"  value="{{ old('surveys[agency_field]') }}" class="form-control" placeholder="Isikan Bidang Usaha" required="">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Alamat Instansi</label>
                            <div class="col-sm-12 col-md-5">
                                <textarea class="form-control" type="textarea" name="surveys[address]" value="{{ old('surveys[address]') }}" class="form-control" placeholder="Isikan Alamat Instansi" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Total Alumni Bekerja</label>
                            <div class="col-sm-12 col-md-5">
                                <input class="form-control" type="text" name="surveys[total_alumni]"  value="{{ old('surveys[total_alumni]') }}" class="form-control" placeholder="Isikan Total Alumni Bekerja" required="">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Minimal IPK diterima</label>
                            <div class="col-sm-12 col-md-5">
                                <input class="form-control" type="text" name="surveys[minimum_gpa]"  value="{{ old('surveys[minimum_gpa]') }}" class="form-control" placeholder="Isikan Minimal IPK diterima" required="">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">Masukan dan Saran</label>
                            <div class="col-sm-12 col-md-5">
                                <textarea class="form-control" type="textarea" name="surveys[feedback]" value="{{ old('surveys[feedback]') }}" class="form-control" placeholder="Isikan Masukan dan Saran" required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2"></label>
                            <div class="col-sm-12 col-md-8">
                                @can('store surveys')
                                <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Kirim</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

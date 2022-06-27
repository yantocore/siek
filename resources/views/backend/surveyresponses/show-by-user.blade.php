@extends('layouts.master')
@section('title','Lihat Hasil Kuesioner')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ url()->previous() }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Lihat Hasil Kuesioner</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item"><a href="{{ url()->previous() }}">Kelola Hasil Kuesioner</a></div>
      <div class="breadcrumb-item">Lihat Hasil Kuesioner</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Data Hasil Tahun {{ $period }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm text-justify col-sm-8">
                        @foreach ($surveys as $key => $survey)
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>: &nbsp; {{ $survey->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Nama Instansi</th>
                            <td>: &nbsp; {{ $survey->agency }}</td>
                        </tr>
                        <tr>
                            <th>Bidang Usaha</th>
                            <td>: &nbsp; {{ $survey->agency_field }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Instansi</th>
                            <td>: &nbsp; {{ $survey->address }}</td>
                        </tr>
                        <tr>
                            <th>Total Alumni Bekerja</th>
                            <td>: &nbsp; {{ $survey->total_alumni }}</td>
                        </tr>
                        <tr>
                            <th>Minimum IPK</th>
                            <td>: &nbsp; {{ $survey->minimum_gpa }}</td>
                        </tr>
                        <tr>
                            <th>Masukan dan Saran</th>
                            <td>: &nbsp; {{ $survey->feedback }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($survey->surveyresponses as $key => $surveyresponse)
                        <tr class="text-center">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-justify">Bagaimana penilaian terhadap {{ $surveyresponse->question->name }} alumni kami di instansi anda ?</td>
                            <td>{{ $surveyresponse->answer->name }}</td>
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

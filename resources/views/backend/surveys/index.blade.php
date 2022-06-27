@extends('layouts.master')
@section('title','Isi Kuesioner')
@section('content')
<div class="section-header">
    <h1>Isi Kuesioner</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Isi Kuesioner</div>
    </div>
</div>
<div class="section-body" data-intro="Pengguna Alumni akan mengisi penilaian disini. Tekan Next untuk melanjutkan tour." data-position='left'>
    <h2 class="section-title">Kuesioner Pengguna Alumni</h2>
    <p class="section-lead">Silahkan pilih kuesioner untuk mengisi penilaian.</p>

    <div class="row">

        @forelse ($questionnaires as $questionnaire)
        <div class="col-12 col-sm-7 col-md-7 col-lg-7">
            <div class="card card-primary">
                <div class="card-header text-justify">
                <h4>{{ $questionnaire->title }}</h4>
                </div>
                <div class="card-body text-justify">
                    <div class="table-responsive">
                        <table class="table table-sm text-justify col-sm-12">
                            <tr>
                                <th>Deskripsi</th>
                                <td>: &nbsp; {{ Str::limit($questionnaire->purpose, 20, ' ...(tekan Isi sekarang untuk selengkapnya)') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal di Buka</th>
                                <td>: &nbsp; {{ $questionnaire->start_date }}</td>
                            </tr>
                            <tr>
                                <th>Batas Pengisian</th>
                                <td>: &nbsp; {{ $questionnaire->due_date }}</td>
                            </tr>
                            <tr>
                                <th>Status Pengisian</th>
                                <td>: &nbsp; telah di {{ $questionnaire->status }}</td>
                            </tr>
                            <tr>
                                <th>Total Pertanyaan</th>
                                <td>: &nbsp; {{ $questionnaire->questions->count() }} Pertanyaan</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <a href="{{ url('surveys',$questionnaire->id.'-'.Str::slug($questionnaire->title)) }}" class="btn btn-primary">Isi Sekarang</a>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-light">
            <div class="row" class="col-md-12 col-12">
                <div class="text-justify">
                    <h6>Mohon maaf Bapak/Ibu {{ Auth::user()->name }}, Belum ada kuesioner yang perlu di isi. Silahkan kembali lagi nanti.</h6><br>
                    <p class="text-left">Terima kasih atas partisipasi Bapak/Ibu dalam penilaian kinerja alumni kami. Kami akan menghubungi Bapak/Ibu di kemudian hari.</p>
                </div>
            </div>
        </div>
        @endforelse


    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
if (RegExp('multipage', 'gi').test(window.location.search)) {
    introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
        window.location.href = 'surveyresponses?multipage=true';
    });
}
</script>
@endpush

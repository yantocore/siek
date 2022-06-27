@extends('layouts.master')
@section('title','Kelola Hasil Kuesioner')
@section('content')
<div class="section-header">
    <h1>Kelola Hasil Kuesioner</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item">Kelola Hasil Kuesioner</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4 data-intro="Untuk menghitung hasil kuesioner berupa variable Softskill dan Hardskill. Silahkan klik icon 'Show' pada salah satu periode kuesioner lalu tekan tombol 'Hitung' untuk memproses perhitungan." data-position='left'>Data Hasil Kuesioner</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="surveyresponses_index">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Periode</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($questionnaires as $key => $questionnaire)
                        <tr class="text-center">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $questionnaire->title }}</td>
                            <td>{{ $questionnaire->period }}</td>
                            <td>
                                @can('show surveyresponses')
                                <a href="{{ route('surveyresponses.show',$questionnaire->id) }}" class="btn btn-sm btn-primary far fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"></a>
                                @endcan
                                {{-- <form style="display:inline" action="#" id="delete" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger far fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></button>
                                </form> --}}
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
@push('scripts')
<script type="text/javascript">
if (RegExp('multipage', 'gi').test(window.location.search)) {
    introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
        window.location.href = 'variables?multipage=true';
    });
}
</script>
@endpush

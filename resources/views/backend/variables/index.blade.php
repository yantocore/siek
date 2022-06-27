@extends('layouts.master')
@section('title','Kelola Variabel')
@section('content')
<div class="section-header">
    <h1>Kelola Variabel</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item">Kelola Variabel</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4 data-intro="Untuk mengevaluasi kinerja alumni. Silahkan klik icon 'Show' pada salah satu periode kuesioner lalu tekan tombol 'Hitung' untuk memproses perhitungan fuzzy sugeno." data-position='left'>Data Variabel</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="results_variables">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kuesioner</th>
                            <th>Softskill</th>
                            <th>Hardskill</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($variables as $key=> $variable)
                        <tr class="text-center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $variable->questionnaire->period }}</td>
                            <td>{{ $variable->softskill }}</td>
                            <td>{{ $variable->hardskill }}</td>
                            <td>
                                <a href="{{ route('variables.show',$variable->id) }}" class="btn btn-sm btn-primary far fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"></a>
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
        window.location.href = 'results?multipage=true';
    });
}
</script>
@endpush

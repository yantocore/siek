@extends('layouts.master')
@section('title','Kelola Perhitungan')
@section('content')
<div class="section-header">
    <h1>Kelola Perhitungan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item">Kelola Perhitungan</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4 data-intro="Untuk melihat hasil perhitungan. Silahkan klik icon 'Show' pada salah satu periode kuesioner. Tour selesai, anda dapat memulai tour ini kembali dengan menekan tombol 'Perlu Bantuan' pada daftar menu. Terima kasih." data-position='left'>Data Perhitungan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="results_index">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Periode Kuesioner</th>
                            {{-- <th>Total Alpha</th>
                            <th>Total (Alpha x Z)</th> --}}
                            <th>Kinerja</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($results as $key=> $result)
                        <tr class="text-center">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $result->variable->questionnaire->period }}</td>
                            <td>{{ $result->performance }}</td>
                            @if ($result->performance <= 60)
                            <td>Kurang</td>
                            @elseif ($result->performance >= 60 && $result->performance <= 80)
                            <td>Cukup</td>
                            @elseif ($result->performance >= 80)
                            <td>Baik</td>
                            @endif
                            <td>
                                @can('show results')
                                <a href="{{ route('results.show',$result->id) }}" class="btn btn-sm btn-primary far fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"></a>
                                @endcan
                                <a href="{{ url('results/'.$result->id.'/export-pdf') }}" class="btn btn-sm btn-primary far fa-print" title="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cetak PDF"></a>
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
        window.location.href = 'dashboard?multipage=true';
    });
}
</script>
@endpush

@extends('layouts.master')
@section('title','Kelola Kuesioner')
@section('content')
<div class="section-header">
    <h1 data-intro="Menu Kelola Kuesioner." data-position='right'>Kelola Kuesioner</h1>
    @can('create users')
    <div class="section-header-button">
        <a href="{{ route('questionnaires.create') }}" class="btn btn-icon icon-left btn-primary fas fa-plus" title="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data"> Tambah</a>
    </div>
    @endcan
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item">Kelola Kuesioner</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Data Kuesioner</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="questionnaires_index">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Periode</th>
                            <th>Tanggal Buka</th>
                            <th>Tanggal Tutup</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($questionnaires as $key=> $questionnaire)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ Str::limit($questionnaire->title, 14, ' ....') }}</td>
                            <td>{{ Str::limit($questionnaire->purpose, 25, ' ....') }}</td>
                            <td>
                                <label class="custom-switch mt-2">
                                    <input data-id="{{$questionnaire->id}}" type="checkbox" {{ $questionnaire->status === 'buka' ? 'checked' : '' }} class="custom-switch-input status-questionnaire" name="status" data-on="buka" data-off="tutup">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{ $questionnaire->status }}</span>
                                </label>
                            </td>
                            <td>{{ $questionnaire->period }}</td>
                            <td>{{ $questionnaire->start_date }}</td>
                            <td>{{ $questionnaire->due_date }}</td>
                            <td>
                                @can('show questionnaires')
                                <a href="{{ route('questionnaires.show', $questionnaire->id) }}" class="btn btn-sm btn-primary far fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"></a>
                                @endcan
                                @can('edit questionnaires')
                                <a href="{{ route('questionnaires.edit', $questionnaire->id) }}" class="btn btn-sm btn-primary far fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></a>
                                @endcan
                                @can('destroy questionnaires')
                                <form style="display:inline" action="{{ route('questionnaires.destroy', $questionnaire->id) }}" id="delete" method="POST">
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
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $('.status-questionnaire').change(function() {
        var status = $(this).prop('checked') === true ? 'buka' : 'tutup';
        var questionnaire_id = $(this).data('id');
        var start_date;
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('questionnaires.change_status') }}',
            data: {'status': status, 'questionnaire_id': questionnaire_id, 'start_date' : start_date},
            success: function(data){
                console.log(data.message);
            //   window.location.href = 'questionnaires';
                window.location.reload(true);
                Toast.fire({
                    type: 'success',
                    title: 'Status Kuesioner telah di '+status+'. Tunggu sebentar halaman akan di muat ulang.'
                });
            },error:function(){
                alert("Silahkan refresh dan tunggu loading halaman selesai.");
            }
        });
    });
});

if (RegExp('multipage', 'gi').test(window.location.search)) {
    introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
        window.location.href = 'surveys?multipage=true';
    });
}
</script>
@endpush

@extends('layouts.master')
@section('title','Edit Kuesioner')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('questionnaires.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Kuesioner</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item"><a href="{{ route('questionnaires.index') }}">Kelola Kuesioner</a></div>
      <div class="breadcrumb-item">Edit Kuesioner</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary shadow">
            <div class="card-header">
                <h4>Edit Kuesioner</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('questionnaires.update',$questionnaire->id) }}" method="POST">
                    @method('put')
                    @csrf
                    @include('backend.questionnaires.partials.form', [
                        'submit_button' => 'Update',
                    ])
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$("#datepickers").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years"
});
</script>
@endpush

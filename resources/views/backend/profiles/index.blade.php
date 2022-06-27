@extends('layouts.master')
@section('title','Profil')
@section('content')
<div class="section-header">
    <h1>Profil</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Profil</div>
    </div>
</div>
<div class="section-body">
    @foreach ($profiles as $profile)
    <h2 class="section-title">Hi, {{ $profile->user->name }}</h2>
    <p class="section-lead">
        Change information about yourself on this page.
    </p>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-left">
                        <figure class="avatar mr-2 avatar-xl">
                            @if(!empty($profile->avatar))
                            <img src="{{ url('storage/users/'.$profile->avatar) }}" alt="image">
                            @else
                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image">
                            @endif
                            @if(Auth::user()->isOnline())
                            <i class="avatar-presence online"></i>
                            @else
                            <i class="avatar-presence offline"></i>
                            @endif
                        </figure>
                        <div class="clearfix"></div>
                        @can('edit profiles')
                        <a href="{{ route('profiles.edit',$profile->id) }}" class="btn btn-icon mt-3 icon-left btn-primary far fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"> Edit Profil</a>
                        @endcan
                    </div>
                    <div class="author-box-details">
                        <div class="author-box-name">
                            <h6>{{ $profile->user->name }}</h6>
                        </div>
                        <div class="author-box-job">{{ $profile->position }}</div>
                        <div class="author-box-description">
                            <div class="table-responsive">
                                <table class="table table-sm text-justify col-7">
                                    <tr>
                                        <th>Email</th>
                                        <td>: &nbsp; {{ $profile->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomer Telepon</th>
                                        <td>: &nbsp; {{ $profile->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>: &nbsp; {{ $profile->gender }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @can('show surveyresponse by profile')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                <h4>Histori Pengisian Kuesioner</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="surveyresponses_show">
                            <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Lengkap</th>
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
                                    <a href="{{ url('profiles/'.Auth::id().'/questionnaires',$survey->questionnaire_id) }}" class="btn btn-sm btn-primary far fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"></a>
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
    @endcan
</div>
@endsection

@extends('layouts.master')
@section('title','Edit Profil')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('profiles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Pengguna</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Kelola Pengguna</a></div>
      <div class="breadcrumb-item">Edit Pengguna</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary shadow">
            <div class="card-header">
                <h4>Edit Pengguna</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('profiles.update',$user->profile->id)}}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="name"  value="{{ old('name') ?? $user->name }}" class="form-control" placeholder="Fulan, S.Kom." required="" aria-describedby="nameHelpBlock">
                            <small id="nameHelpBlock" class="form-text text-muted">
                                Silahkan isi dengan nama lengkap (cantumkan gelar jika ada)
                            </small>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="email" name="email" value="{{ old('email') ?? $user->email }}" class="form-control" placeholder="fulan@gmail.com" required="" aria-describedby="emailHelpBlock">
                            <small id="emailHelpBlock" class="form-text text-muted">
                                Silahkan isi dengan email aktif.
                            </small>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="password" name="password" value="" class="form-control" placeholder="" aria-describedby="passwordHelpBlock">
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Silahkan isi dengan password minimal 6 karakter, kosongkan jika tidak ingin mengganti password.
                            </small>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telepon</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="phone"  value="{{ old('phone') ?? $user->profile->phone }}" class="form-control" placeholder="" required="" aria-describedby="phoneHelpBlock">
                            <small id="phoneHelpBlock" class="form-text text-muted">
                                Silahkan isi dengan no. handphone/whatsapp aktif
                            </small>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jabatan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="position"  value="{{ old('position') ?? $user->profile->position }}" class="form-control" placeholder="Staf HRD" required="" aria-describedby="positionHelpBlock">
                            <small id="positionHelpBlock" class="form-text text-muted">
                                Silahkan isi dengan jabatan di instansi.
                            </small>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                        <div class="col-sm-12 col-md-7">
                            @if ($user->profile->gender == "Perempuan")
                                <div class="custom-control-inline custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="gender" id="gender1" value="Laki-Laki">
                                    <label class="custom-control-label" for="gender1">
                                    Laki-Laki
                                    </label>
                                </div>
                                <div class="custom-control-inline custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="gender" id="gender2" value="Perempuan" checked>
                                    <label class="custom-control-label" for="gender2">
                                    Perempuan
                                    </label>
                                </div>
                            @else
                                <div class="custom-control-inline custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="gender" id="gender1" value="Laki-Laki" checked>
                                    <label class="custom-control-label" for="gender1">
                                    Laki-Laki
                                    </label>
                                </div>
                                <div class="custom-control-inline custom-radio custom-control">
                                    <input class="custom-control-input" type="radio" name="gender" id="gender2" value="Perempuan">
                                    <label class="custom-control-label" for="gender2">
                                    Perempuan
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="file" class="dropify" name="avatar" value="" data-default-file="{{ url('storage/users/'.Auth::user()->profile->avatar) }}" aria-describedby="avatarHelpBlock"/>
                            <small id="avatarHelpBlock" class="form-text text-muted">
                                Silahkan pilih foto profil berformat .jpg, .png, .gif. Lewati jika tidak ingin mengganti foto profil.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <a href="/profiles" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Batal</a>
                          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

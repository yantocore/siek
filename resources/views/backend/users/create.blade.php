@extends('layouts.master')
@section('title','Kelola Pengguna')
@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Kelola Pengguna</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Kelola Pengguna</a></div>
      <div class="breadcrumb-item">Tambah Pengguna</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary shadow">
            <div class="card-header">
                <h4>Tambah Pengguna</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="name"  value="{{ old('name') }}" class="form-control" placeholder="Isikan Nama Lengkap Pengguna" required="">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Isikan Email Pengguna" required="">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Minimal 6 Karakter" required="">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hak Akses</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="role" id="role" class="form-control custom-select" required="">
                                <option disabled selected>Pilih Hak Akses!</option>
                                @foreach ($roles as $role)
                                    @if (old('role') == $role->name)
                                        <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jabatan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="position" value="{{ old('position') }}" class="form-control" placeholder="Isikan Jabatan Pengguna" required="">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <a href="/users" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Batal</a>
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

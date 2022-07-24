@extends('layouts.master')
@section('title','Kelola User')
@section('content')
<div class="section-header">
    <h1>Kelola Pengguna</h1>
    @can('create users')
    <div class="section-header-button">
        <a href="{{ route('users.create') }}" class="btn btn-icon icon-left btn-primary fas fa-plus" title="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Data"> Tambah</a>
    </div>
    @endcan
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Beranda</a></div>
      <div class="breadcrumb-item">Kelola Pengguna</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card card-primary shadow">
            <div class="card-header">
              <h4>Data Pengguna</h4>
            </div>
            <div class="card-body">

                <ul class="col-12 nav nav-pills" id="myTab3" role="tablist">
                    <li class="col-6 nav-item">
                    <a class="nav-link active" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="true" title="Tekan untuk melihat Data Admin & Pimpinan" data-step="3" data-intro="Menu Kelola Admin dan Pimpinan." data-position='right'><i class="fas fa-user"></i> Admin/Pimpinan</a>
                    </li>
                    <li class="col-6 nav-item">
                    <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false" title="Tekan untuk melihat Data Pengguna Alumni" data-step="4" data-intro="Menu Kelola Pengguna Alumni." data-position='left'><i class="fas fa-user"></i> Pengguna Alumni</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="admins_index">
                                    <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Hak Akses</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($admins as $key=> $admin)
                                    <tr class="text-center">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->profile->position }}</td>
                                        <td>
                                            @foreach ($admin->getRoleNames() as $role)
                                                @if($role === 'admin')
                                                <div class="badge badge-pill badge-danger">
                                                    {{ $role }}
                                                </div>
                                                @else
                                                <div class="badge badge-pill badge-primary">
                                                    {{ $role }}
                                                </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <figure class="avatar mr-2 avatar-sm">
                                                @if(!empty($admin->profile->avatar))
                                                <img src="{{ url('storage/users/'.$admin->profile->avatar) }}" alt="image">
                                                @else
                                                <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image">
                                                @endif
                                                @if($admin->isOnline())
                                                <i class="avatar-presence online"></i>
                                                @else
                                                <i class="avatar-presence offline"></i>
                                                @endif
                                            </figure>
                                            @if($admin->isOnline())
                                                <p style="display: inline-block;">Online</p>
                                            @else
                                                <p style="display: inline-block;">Offline</p>
                                            @endif
                                        </td>
                                        <td>
                                            @can('edit users')
                                            <a href="{{ route('users.edit',$admin->id) }}" class="btn btn-sm btn-primary far fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></a>
                                            @endcan
                                            @can('destroy users')
                                                @if($admin->email == Auth::user()->email)

                                                @else
                                                <form style="display:inline" action="{{ route('users.destroy',$admin->id) }}" id="delete" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger far fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></button>
                                                </form>
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="users_index">
                                    <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Hak Akses</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $key=> $user)
                                    <tr class="text-center">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->profile->position }}</td>
                                        <td>
                                            @foreach ($user->getRoleNames() as $role)
                                            <div class="badge badge-pill badge-dark">
                                                {{ $role }}
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            <figure class="avatar mr-2 avatar-sm">
                                                @if(!empty($user->profile->avatar))
                                                <img src="{{ url('storage/users/'.$user->profile->avatar) }}" alt="image">
                                                @else
                                                <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image">
                                                @endif
                                                @if($user->isOnline())
                                                <i class="avatar-presence online"></i>
                                                @else
                                                <i class="avatar-presence offline"></i>
                                                @endif
                                            </figure>
                                            @if($user->isOnline())
                                                <p style="display: inline-block;">Online</p>
                                            @else
                                                <p style="display: inline-block;">Offline</p>
                                            @endif
                                        </td>
                                        <td>
                                            @can('edit users')
                                            <a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-primary far fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></a>
                                            @endcan
                                            @can('destroy users')
                                                <form style="display:inline" action="{{ route('users.destroy',$user->id)}}" id="delete" method="POST">
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
if (RegExp('multipage', 'gi').test(window.location.search)) {
    introJs().setOption('doneLabel', 'Next page').start().oncomplete(function() {
        window.location.href = 'questionnaires?multipage=true';
    });
}
</script>
@endpush

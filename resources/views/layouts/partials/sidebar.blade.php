<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="/"><p class="mt-2 mb-2 p-2">Sistem Informasi Evaluasi Kinerja Alumni</p></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="/">SIEKA</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->is('dashboard') ? ' active' : '' }}">
            <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Data Management</li>
    @can('users')
        <li class="{{ request()->is('users') ? ' active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users-cog"></i> <span>Kelola Pengguna</span></a></li>
    @endcan
    @can('questionnaires')
        <li class="{{ request()->is('questionnaires') ? ' active' : '' }}"><a class="nav-link" href="{{ route('questionnaires.index') }}"><i class="fas fa-list-ul"></i> <span>Kelola Kuesioner</span></a></li>
    @endcan
    @can('surveys')
        <li class="{{ request()->is('surveys') ? ' active' : '' }}"><a class="nav-link" href="{{ route('surveys.index') }}"><i class="fas fa-list-ul"></i> <span>Pengisian Kuesioner</span></a></li>
    @endcan
    @can('surveyresponses')
    <li class="{{ request()->is('surveyresponses') ? ' active' : '' }}"><a class="nav-link" href="{{ route('surveyresponses.index') }}"><i class="fas fa-tasks"></i> <span>Kelola Hasil Kuesioner</span></a></li>
    @endcan
    @can('variables')
        <li class="menu-header">Evaluation Process</li>
        <li class="{{ request()->is('variables') ? ' active' : '' }}"><a class="nav-link" href="{{ route('variables.index') }}"><i class="fas fa-clipboard-list"></i> <span>Kelola Variabel</span></a></li>
    @endcan
    @can('results')
        <li class="{{ request()->is('results') ? ' active' : '' }}"><a class="nav-link" href="{{ route('results.index') }}"><i class="fas fa-calculator"></i> <span>Kelola Perhitungan</span></a></li>
    @endcan
    @can('profile')
        <li class="{{ request()->is('profile') ? ' active' : '' }}"><a class="nav-link" href="{{ route('profile.index') }}"><i class="fas fa-list-ul"></i> <span>Profil</span></a></li>
    @endcan
    @can('questionnaire')
        <li class="{{ request()->is('questionnaire') ? ' active' : '' }}"><a class="nav-link" href="{{ route('questionnaire.index') }}"><i class="fas fa-list-ul"></i> <span>Kuesioner</span></a></li>
    @endcan
    </ul>
    @if(request()->is('dashboard'))
    @role('admin')
    <div class="mt-2 mb-2 p-3 hide-sidebar-mini">
        <a id="startButton" href="javascript:void(0);" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Perlu Bantuan
        </a>
    </div>
    @endrole
    @else
    @endif
    </aside>
  </div>

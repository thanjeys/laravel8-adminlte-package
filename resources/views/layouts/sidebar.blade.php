<aside class="main-sidebar sidebar-dark-primary elevation-4">
<<<<<<< HEAD
    <a href="{{ route('home') }}" class="brand-link">
        {{-- <span class="brand-text font-weight-light">{{ config('app.name') }}</span> --}}
        <img width="220" alt="{{ config('app.name') }}" width="250" src="{{ asset('images/logo_loanzzone.png') }}">
=======
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
>>>>>>> 0023d8cc7e91667d0dc8c6f56aa46ab09d9e2e51
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>

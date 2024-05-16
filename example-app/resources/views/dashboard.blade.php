@extends('template')

@section ('navbar')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active"> <a class="nav-link" href="/">Przegladaj pupile</a> </li>
                    <li class="nav-item active"> <a class="nav-link" href="/pet/add">Dodaj pupila</a> </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section ('content')
    <div class="container">
        @yield('table')
        @yield('form')
    </div>
@endsection
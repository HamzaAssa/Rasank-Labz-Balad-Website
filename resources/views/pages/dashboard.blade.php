@extends('layouts.app')

@section('title', 'Rasaank Labz Balad')

@section('content')
    <div class="container">
        <h1>This is Dashboard</h1>
        <p>This is the dashboard content.</p>
        @auth
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    @endauth
    </div>
@endsection

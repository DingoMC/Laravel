@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Witaj <b>{{ Auth::user()->name }}</b> w JS Explorer!</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>Twoje Role</div>
                    <span class="user-role role-{{ strtolower(Auth::user()->role->name) }}">{{ Auth::user()->role->name }}</span>
                    <div>Twoje Tagi</div>
                    <div class="user-tags">
                        @foreach($courses as $course)
                            <div class="course {{ strtolower($course->course->name) }}-tag">{{ $course->course->name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

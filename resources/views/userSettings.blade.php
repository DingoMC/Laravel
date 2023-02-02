@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card user-settings">
        <div class="card-header">Edytuj swoje dane</div>
        <div class="card-body">
            @if($success == false)
            <div class="{{ $message_type }}">{{ $message }}</div>
            @endif
            <div class="box box-primary ">
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('updateuser', Auth::user()) }}" id="user-form" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="form-text">Nazwa użytkownika</div>
                    <input class="form-control @error('name') is-invalid @enderror" minlength="4" maxlength="32" id="name" name="name" type="text" value="{{ Auth::user()->name }}"/>
                    <div class="form-text">Adres E-mail</div>
                    <div>{{ Auth::user()->email }}</div>
                    <div class="form-text">Rola</div>
                    <div class="user-role role-{{ strtolower(Auth::user()->role->name) }}">{{ Auth::user()->role->name }}</div>
                    <div class="form-bottom">
                        <button type="submit" class="btn btn-success">Zapisz</button>
                        <a href="{{ url('home') }}" onclick="return confirm('Wszelkie zmiany nie zostaną zapisane. Kontynuować?')" class="btn btn-danger">Anuluj</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card danger-zone">
        <div class="card-header">Strefa niebezpieczeństwa</div>
        <div class="card-body">
            <div class="danger-content">
                <span>Skasuj wszystkie moje opinie</span>
                <a href="{{ route('clearAllComments', Auth::user()) }}" class="danger-button" onclick="return confirm('Uwaga! Czynność ta jest nieodwracalna! Kontynuować?')">Skasuj</a>
            </div>
            <div class="danger-content">
                <span>Wypisz mnie ze wszystkich kursów</span>
                <a class="danger-button" href="{{ route('leaveAllCourses', Auth::user()) }}" onclick="return confirm('Uwaga! Czynność ta jest nieodwracalna! Kontynuować?')">Wypisz</a>
            </div>
            <div class="danger-content">
                <span>Usuń moje konto</span>
                <a class="danger-button" href="{{ route('deleteuser', Auth::user()) }}" onclick="return confirm('Uwaga! Czynność ta jest nieodwracalna! Wszystkie twoje opinie zostaną skasowane! Kontynuować?')">Usuń</a>
            </div>
        </div>
    </div>
</div>
@endsection

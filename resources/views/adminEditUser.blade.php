<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>JS Explorer - Edytuj Użytkownika</title>
        <link rel="stylesheet" href="/css/comment-edit-styles.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    </head>
    <body>
        <div class="main">
            <div class="title"><h3>Edytuj dane użytkownika</h3></div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="box box-primary ">
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('admin/updateuser', $user) }}" id="admin-edituser-form" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="form-text">Nazwa użytkownika</div>
                    <input class="form-control @error('name') is-invalid @enderror" minlength="4" maxlength="32" id="name" name="name" type="text" value="{{ $user->name }}"/>
                    <div class="form-text">Adres E-mail</div>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ $user->email }}"/>
                    <div class="form-text">Rola</div>
                    <select name="role" id="role">
                        <option value="1" @if($user->role_id == 1) selected @endif>User</option>
                        <option value="2" @if($user->role_id == 2) selected @endif>Moderator</option>
                    </select>
                    <div class="form-bottom">
                        <button type="submit" class="btn btn-success">Zapisz</button>
                        <a href="{{ url('admin') }}" onclick="return confirm('Wszelkie zmiany nie zostaną zapisane. Kontynuować?')" class="btn btn-danger">Anuluj</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

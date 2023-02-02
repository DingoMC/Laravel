<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>JS Explorer - Edytuj Opinię</title>
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
        @include('layouts.navbar')
        <div class="main">
            <div class="title"><h3>Edytuj swoją opinię</h3></div>
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
                <form role="form" action="{{ route('update', $comment) }}" id="comment-form" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="container">
                        <div class="box-body">
                        <div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="roles_box">
                        <label><b>Treść</b></label> <br>
                        <textarea name="message" id="message" cols="40" rows="7" required>{{$comment->message}}</textarea>
                        </div>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <button type="submit" class="btn btn-success">Zapisz</button>
                        <a href="{{ url('comments') }}" class="btn btn-danger" onclick="return confirm('Wszelkie zmiany nie zostaną zapisane. Kontynuować?')">Anuluj</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>JS Explorer - Dodaj Opinię</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/comment-add-styles.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
        <style>
            
        </style>
    </head>
    <body>
        @include('layouts.navbar')
        <div class="main">
            <div class="title"> <h3>Dodaj nową opinię</h3></div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form"  action="{{ route('store') }}" id="comment-form" method="post" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="container">
                        <div>
                            <div class="form-group{{ $errors->has('cselect')?'has-error':'' }}" id="course">
                                <label><b>Kurs</b></label>
                                <select name="cselect" id="cselect">
                                    @php($active_course_ids = array())
                                    @php($ccnt = 0)
                                    @foreach($commented as $c)
                                        @php(array_push($active_course_ids, $c->course->id))
                                    @endforeach
                                    @foreach($enrolled as $e)
                                        @if( !in_array($e->course->id, $active_course_ids) )
                                            @php($ccnt++)
                                            <option value="{{ $e->course->id }}">{{ $e->course->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($ccnt > 0)
                                <div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="message">
                                    <label><b>Treść</b></label>
                                    <textarea name="message" id="message" cols="40" rows="7" required></textarea>
                                </div>
                            @else
                                <script>
                                    $('#course').css("display", "none");
                                </script>
                                <span class="comment-error">Ups! Wygląda na to, że nie zapisałeś się jeszcze na żaden kurs lub opublikowałeś już opinie dla każdego kursu, na który jesteś zapisany.</span>
                            @endif
                        </div>
                        <div class="form-bottom">
                            @if ($ccnt > 0)
                                <div>
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Pamiętaj, że opinie są widoczne publicznie. Kontynuować?')">Dodaj</button>
                                    <a href="{{ url('comments') }}" onclick="return confirm('Wszelkie zmiany nie zostaną zapisane. Kontynuować?')" class="btn btn-danger">Anuluj</a>
                                </div>
                            @else
                                <div>
                                    <a href="{{ url('comments') }}" class="btn btn-danger">Powrót</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

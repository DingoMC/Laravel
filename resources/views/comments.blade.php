<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>JS Explorer - Opinie</title>
    <link href="/css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="/css/comment-styles.css" rel="stylesheet">
    <link href="/css/course-tags.css" rel="stylesheet">
    <link href="/css/user-styles.css" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')
    <div class="container px-4 px-lg-5 content">
        <div class="title">
            <h3>Opinie użytkowników</h3>
        </div>
        @auth
            <div class="comment-add">
                <a href="{{ route('create') }}" class="btn btn-success">Napisz</a>
            </div>
        @endauth
        @guest
            <div class="comment-add-guest">Zaloguj się aby dodać opinię.</div>    
        @endguest
        @if (count($comments) === 0) 
            <div class="no-comments">Nie ma jeszcze żadnych opinii.</div>
        @else
            @foreach($comments as $comment)
            <div class="comment">
                <div class="comment-header">
                    <div class="comment-left">
                        <!--<span class="comment-htext">Użytkownik:</span>-->
                        <div class="user-role role-{{ strtolower($comment->user->role->name) }}">{{$comment->user->role->name}}</div>
                        <div class="username">{{$comment->user->name}}</div>
                    </div>
                    <div class="comment-right">
                        <div class="creation-date">{{$comment->created_at}}</div>
                        @if ($comment->updated_at != $comment->created_at)
                            <div class="edit-date">Edytowany {{$comment->updated_at}}</div>
                        @endif
                    </div>
                </div>
                <div class="comment-subheader">
                    <span class="comment-htext">Kurs:</span>
                    <div class="course {{ strtolower($comment->course->name) }}-tag">{{$comment->course->name}}</div>
                </div>
                <div class="comment-content">{{$comment->message}}</div>
                @auth
                    <div class="comment-bottom">
                        <div class="bottom-left">
                            @if(\Auth::user()->role_id > 1)
                                @if($comment->user_id == \Auth::user()->id)
                                <img class="mod-icon blue" title="Twoje uprawnienia nie mają wpływu na twoją opinię" src="/zdjecia/mod-blue.png" alt="Mod" />
                                @else
                                    @if(\Auth::user()->role_id > $comment->user->role_id)
                                    <img class="mod-icon green" title="Twoje uprawnienia zezwalają na moderację tej opinii" src="/zdjecia/mod-green.png" alt="Mod" />
                                    @else
                                    <img class="mod-icon red" title="Twoje uprawnienia są niewystarczające na moderację tej opinii" src="/zdjecia/mod-red.png" alt="Mod" />
                                    @endif
                                @endif
                            @endif
                        </div>
                        <div class="bottom-right">
                            @if($comment->user_id == \Auth::user()->id)
                                <a href="{{ route('edit', $comment) }}" title="Edytuj"><img class="comment-icon" src="/zdjecia/edit.png" alt="Edytuj" /></a>
                                <a href="{{ route('delete', $comment->id) }}" onclick="return confirm('Jesteś pewien?')" title="Skasuj komentarz"><img class="comment-icon" src="/zdjecia/delete.png" alt="Usuń" /></a>
                            @else
                                @if(\Auth::user()->role_id > $comment->user->role_id)
                                    <a href="{{ route('delete', $comment->id) }}" onclick="return confirm('Usuwasz nieodwracalnie czyjś komentarz. Jesteś pewien?')" title="Skasuj komentarz"><img class="comment-icon" src="/zdjecia/delete-mod.png" alt="Skasuj" /></a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endauth
            </div>
            @endforeach
        @endif
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="/js/scripts.js"></script>
    <script src="/js/footer_loader.js"></script>
        <style>
            footer {
                position: fixed;
                z-index: 10;
                bottom: 0;
                left: 0;
                right: 0;
                display: grid;
                grid-auto-flow: column;
                place-items: center;
                text-align: center;
                font-family: Arial, Helvetica, sans-serif;
                color: #ffffff;
                height: fit-content;
                background: linear-gradient(0deg, rgba(52, 58, 64, 0.9), rgba(52, 58, 64, 0.7));
                box-shadow: 0 -0.5rem 0.2rem 0.2rem rgba(52, 58, 64, 0.7);
            }
            footer > span {padding: 0 0 0.5rem 0;}
            #bottom-redux {
                display: block;
                height: 3rem;
            }
            @media screen and (max-width: 720px) {
                footer {
                    font-size: 0.9rem;
                    box-shadow: 0 -0.33rem 0.15rem 0.15rem rgba(52, 58, 64, 0.7);
                }
                footer > span {padding: 0 0 0.33rem 0;}
            }
            @media screen and (max-width: 384px) {
                footer {
                    font-size: 0.75rem;
                    box-shadow: 0 -0.25rem 0.1rem 0.1rem rgba(52, 58, 64, 0.7);
                }
                footer > span {padding: 0 0 0.25rem 0;}
            }
        </style>
        <!-- Footer -->
        <div id="bottom-redux"></div>
        <footer></footer>
</body>
</html>

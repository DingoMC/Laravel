@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card active-courses">
                <div class="card-header">Moje kursy</div>
                <div class="card-body">
                    @php($active_course_ids = array())
                    @php($ccnt = 0)
                    @foreach($mycourses as $mycourse)
                        @php(array_push($active_course_ids, $mycourse->course->id))
                        @php($ccnt++)
                        <span>{{ $mycourse->course->name }}</span>
                        <a href="{{ route('leave', $mycourse->id) }}" class="btn btn-danger" onclick="return confirm('Czynność jest nieodwracalna. Jesteś pewien?')">Wypisz się</a>
                    @endforeach
                    @if($ccnt == 0)
                        <span class="no-active-courses">Nie jesteś zapisany jeszcze na żaden kurs.</span>
                    @endif
                </div>
            </div>
            <div class="card other-courses">
                <div class="card-header">Pozostałe kursy</div>
                <div class="card-body">
                    @php($oc_cnt = 0)
                    @foreach($all as $course) 
                        @if( !in_array($course->id, $active_course_ids) )
                            @php($oc_cnt++)
                            <span>{{ $course->name }}</span>
                            <a href="{{ route('enroll', $course->id) }}" class="btn btn-success" onclick="return confirm('Zapisując się na kurs akceptujesz jednocześnie regulamin oraz będziesz zobowiązany do uiszczenia opłaty za kurs. Kontynuować?')">Zapisz mnie</a>
                        @endif
                    @endforeach
                    @if($oc_cnt == 0)
                        <span class="no-other-courses">Hurra! Jesteś zapisany na wszystkie dostępne kursy!</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

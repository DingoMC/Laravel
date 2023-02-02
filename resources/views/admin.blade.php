@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card admin">
                <div class="card-header">Lista użytkowników</div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th class="centered">ID</th>
                                <th class="centered">Nazwa użytkownika</th>
                                <th class="centered">E-mail</th>
                                <th class="centered">Utworzono</th>
                                <th class="centered">Rola</th>
                                <th class="centered">Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($a_cnt = 0)
                            @php ($m_cnt = 0)
                            @php ($u_cnt = 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td class="centered"><span class="user-role role-{{ strtolower($user->role->name) }}">{{ $user->role->name }}</span></td>
                                    <td>
                                        @if($user->role->id < 3)
                                        <div class="tag-wrapper">
                                            <a href="{{ route('admin/edituser', $user) }}" class="btn btn-primary" title="Edytuj">Edytuj</a>
                                            <a href="{{ route('admin/deleteuser', $user) }}" class="danger-button" title="Usuń" onclick="return confirm('Uwaga! Czynność ta jest nieodwracalna! Wszystkie dane tego użytkownika zostaną skasowane! Kontynuować?')">Usuń</a>
                                        </div>
                                        @endif
                                    </td>
                                    @if($user->role_id == 1)
                                    @php($u_cnt++)
                                    @endif
                                    @if($user->role_id == 2)
                                    @php($m_cnt++)
                                    @endif
                                    @if($user->role_id == 3)
                                    @php($a_cnt++)
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="user-total">
                                        <div>Razem: {{ count($users) }}</div>
                                        <div class="tag-wrapper"><span class="user-role role-admin">Admin</span><span>{{ $a_cnt }}</span></div>
                                        <div class="tag-wrapper"><span class="user-role role-moderator">Moderator</span><span>{{ $m_cnt }}</span></div>
                                        <div class="tag-wrapper"><span class="user-role role-user">User</span><span>{{ $u_cnt }}</span></div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card admin">
                <div class="card-header">Lista zapisów na kursy</div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th class="centered">ID</th>
                                <th class="centered">Użytkownik</th>
                                <th class="centered">Kurs</th>
                                <th class="centered">Data zapisu</th>
                                <th class="centered">Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($enroll_array = array())
                            @foreach($courses as $course)
                                @php($enroll_array[$course->name] = 0)
                            @endforeach
                            @foreach($enrolls as $enroll)
                                @php($enroll_array[$enroll->course->name]++)
                                <tr>
                                    <td>{{ $enroll->id }}</td>
                                    <td class="centered">
                                        <div class="tag-wrapper">
                                            <span class="user-role role-{{ strtolower($enroll->user->role->name) }}">{{ $enroll->user->role->name }}</span>
                                            <span>{{ $enroll->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="centered"><span class="course {{ strtolower($enroll->course->name) }}-tag">{{$enroll->course->name}}</span></td>
                                    <td>{{ $enroll->created_at }}</td>
                                    <td class="centered"><a href="{{ route('admin/deleteenroll', $enroll) }}" class="danger-button" title="Usuń" onclick="return confirm('Uwaga! Czynność ta jest nieodwracalna! Kontynuować?')">Usuń</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="enrolls-total">
                                        <div>Razem: {{ count($enrolls) }}</div>
                                        @foreach($enroll_array as $key => $value)
                                        @if($value > 0)
                                            <div class="tag-wrapper">
                                                <span class="course {{ strtolower($key) }}-tag">{{$key}}</span>
                                                <span>{{ $value }}</span>
                                            </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

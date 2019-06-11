@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <a href="{{ route('users.add-form') }}" class="btn btn-info float-right">Добавить</a>
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Действия</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ url('/users/update/'.$user->id) }}" class="btn btn-primary float-right">Редактировать</a>
                        <a href="{{ url('/users/delete/'.$user->id) }}" class="btn btn-danger float-right">Удалить</a></td>
                    </tr>
                    @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <a href="{{ route('departments.add-form') }}" class="btn btn-info float-right">Добавить</a>
            <table class="table table-hover table-bordered">
                <tr>
                    <th>Название отдела</th>
                    <th>Описание</th>
                    <th>Логотип</th>
                    <th>Сотрудники</th>
                    <th>Действия</th>
                </tr>
                @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->description }}</td>
                        <td>
                            @if($department->logo != null)
                            <img src="{{ url('/storage/logo/'.$department->logo) }}" alt="" width="200px">
                            @endif
                        </td>
                        <td>
                            @if($department->users != null)
                                @foreach($department->users as $user)
                                    <p>{{ $user->name }}</p>
                                    @endforeach
                                @endif
                        </td>
                        <td><a href="{{ url('/departments/update/'.$department->id) }}" class="btn btn-primary float-right">Редактировать</a>
                            <a href="{{ url('/departments/delete/'.$department->id) }}" class="btn btn-danger float-right">Удалить</a></td>
                    </tr>
                @endforeach
            </table>
            {{ $departments->links() }}
        </div>
    </div>
@endsection

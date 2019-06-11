@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <form action="{{ route('departments.update') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $department->id }}">
                <div class="form-group">
                    <input type="text" name="name" value="{{ $department->name }}" class="form-control" placeholder="Введите название отдела" required>
                </div>
                <div class="form-group">
                    <textarea name="description" required placeholder="Введите описание отдела">{{ $department->description }}</textarea>
                </div>
                <div class="form-group">
                    @if($department->logo != null)
                        <img src="{{ url('/storage/logo/'.$department->logo) }}" alt="" width="150px">
                        @endif
                    <input type="file" name="logo" accept="image/*">
                </div>
                <div class="form-group">
                    <select name="users[]" class="custom-select" multiple>
                        @foreach($allUsers as $user)
                            @if(key_exists($user->id, $departmentsUser))
                                <option value="{{ $user->id }}"  selected="selected">{{ $user->name }}"</option>
                                @else
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
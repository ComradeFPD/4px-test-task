@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <form action="{{ route('departments.create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Введите название отдела" required>
                </div>
                <div class="form-group">
                    <textarea name="description" required placeholder="Введите описание отдела"></textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="logo" accept="image/*">
                </div>
                <div class="form-group">
                    <select name="users[]" class="custom-select" multiple>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
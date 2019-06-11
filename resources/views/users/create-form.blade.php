@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <form action="{{ route('users.create') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Введите ваше имя">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Введите ваш email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Введите ваш пароль">
            </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
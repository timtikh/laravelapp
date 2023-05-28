@extends('layout.app')

@section('title', 'Создание пользователя')

@section('content')
    <div class="card">
        <div class="card-header">
            Создание нового пользователя
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('user.store') }}">
                @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Имя пользователя</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="text" class="form-control" name="email" id="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="text" class="form-control" name="password" id="password">
                    </div>

                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="#">
                    <button type="button" class="btn btn-primary" onclick="history.go(-1);">Отмена</button>
                </a>
            </form>
        </div>
    </div>
@endsection

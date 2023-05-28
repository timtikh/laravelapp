@extends('layout.app')

@section('title', 'Изменение карточки пользователя')

@section('content')
    <div class="card">
        <div class="card-header">
            Пользователь
        </div>
        <div class="card-body">

            <form method="POST" action="{{route('user.update', $user->id)}}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="text" class="form-control" name="password" id="password" value="{{$user->password}}">
                </div>

                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="#">
                    <button type="button" class="btn btn-primary" onclick="history.go(-1);">Отмена</button>
                </a>
            </form>
        </div>
    </div>
@endsection

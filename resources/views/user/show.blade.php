@extends('layout.app')

@section('title', 'Карточка пользователя')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $user->name }}
        </div>
        <div class="card-body">
            <
            <p>Почта: {{$user->email}}</p>
            <p>Имя: {{$user->password}}</p>

            <button class="btn btn-primary" onclick="history.go(-1);">Назад</button>
        </div>
    </div>
@endsection

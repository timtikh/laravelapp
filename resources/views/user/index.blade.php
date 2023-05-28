@extends('layout.app')

@section('title', 'Пользователи')

@section('content')

        <a href="{{route('user.create')}}">
            <button class="btn btn-success">Создать пользователя</button>
        </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">эл. почта</th>
            <th scope="col">хэш пароля</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td>

                <td>


                    <a href="{{route('user.edit', $user->id)}}">
                        <button class="btn btn-info btn-sm">Изменить</button>
                    </a>

                    <form method="POST" action="{{route('user.destroy', $user->id)}}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

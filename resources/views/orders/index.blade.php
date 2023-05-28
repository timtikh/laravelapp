@extends('layout.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <td>Номер заказа</td>
            <td>Дата создания</td>
            <td>ID покупателя</td>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->user_id}}</td>
                <td>{{$order->status}}</td>

                <td>
                    <form method="POST" action="{{route('orders.destroy', $order->id)}}">
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


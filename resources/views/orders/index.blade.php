@extends('layout.app')

@section('content')
    <table class="table">
        <tbody>
        @foreach($orders as $order)
            <thead>
            <tr>
                <td><b>Номер заказа</b></td>
                <td><b>Дата создания</b></td>
                <td><b>ID покупателя</b></td>
                <td><b>Статус заказа</b></td>

            </tr>
            </thead>
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->user_id}}</td>
                <td>{{$order->status}}</td>
        <thead>
        <tr>
            <td><b>Название товара</b></td>
            <td><b>Количество в заказе</b></td>
        </tr>
        </thead>
        @foreach($order->getItems($order->id) as $product_collection)

            @foreach($product_collection as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$order->getProductInOrderQuantity($order->id,$product->id)}}</td>
                </tr>
            @endforeach
        @endforeach
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


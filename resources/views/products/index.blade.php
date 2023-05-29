@extends('layout.app')

@section('title', 'Карточка товара')

@section('content')
    @can('product.create')
        <a href="{{route('products.create')}}">
            <button class="btn btn-success">Создать товар</button>
        </a>
    @endcan
    <form method="GET" action="{{route('products.index')}}">
        @csrf
        <input type="text" class="form-control" name="search" id="search" placeholder="Поиск по названию">
        <button type="submit" class="btn">Поиск</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Категория</th>
            <th scope="col">Название</th>
            <th scope="col">Артикул</th>
            <th scope="col">Изображение</th>
            <th scope="col">Описание</th>
            <th scope="col">Цена</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->parent_category }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->article }}</td>
                <td><img src={{ $product->picture}} width="300"></td>
                <td>{{ $product->description  }}</td>
                <td>{{ $product->price  }}</td>

                <td>
                    @auth
                        @if($product->quantity > 0)
                            <form method="POST" action="{{route('cart.put', $product->id)}}">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                <button type="submit" class="btn btn-danger btn-sm">Добавить в корзину</button>
                            </form>
                        @endif
                        @if($product->quantity <= 0)
                            <p>Нет в наличии</p>
                        @endif
                    @endauth
                    <a href="{{route('products.show', $product->id)}}">
                        <button class="btn btn-primary btn-sm">Просмотреть</button>
                    </a>

                    @can('product.edit')

                        <a href="{{route('products.edit', $product->id)}}">
                            <button class="btn btn-info btn-sm">Изменить</button>
                        </a>
                    @endcan
                    @can('product.destroy')
                        <form method="POST" action="{{route('products.destroy', $product->id)}}">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    @endcan

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

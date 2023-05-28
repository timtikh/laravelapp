@extends('layout.app')

@section('title', 'Карточка товара')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $product->name }}
        </div>
        <div class="card-body">
            <p>{{$product->parent_category}}->{{$product->category}}</p>
            <p><img src={{ $product->picture}} width="300"></p>
            <p>Артикул: {{$product->article}}</p>
            <p>Цена: {{$product->price}}</p>
            <p>Описание: {{$product->description}}</p>
            @can('product.create')
                <p>Кто создал: {{$product->user->name}}</p>
            @endcan
            <button class="btn btn-primary" onclick="history.go(-1);">Назад</button>
        </div>
    </div>
@endsection

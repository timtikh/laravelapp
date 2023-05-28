@extends('layout.app')

@section('title', 'Изменение карточки товара')

@section('content')
    <div class="card">
        <div class="card-header">
            Товар
        </div>
        <div class="card-body">

            <form method="POST" action="{{route('products.update', $product->id)}}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Наименование</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$product->name}}">
                </div>

                <div class="mb-3">
                    <label for="article" class="form-label">Артикул</label>
                    <input type="text" class="form-control" name="article" id="article" value="{{$product->article}}">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{$product->price}}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{$product->description}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Ссылка на картинку</label>
                    <input type="text" class="form-control" name="picture" id="picture" value="{{$product->picture}}">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Родительская категория</label>
                    <input type="text" class="form-control" name="parent_category" id="parent_category" value="{{$product->parent_category}}">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Категория</label>
                    <input type="text" class="form-control" name="category" id="category" value="{{$product->category}}">
                </div>

                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="#">
                    <button type="button" class="btn btn-primary" onclick="history.go(-1);">Отмена</button>
                </a>
            </form>
        </div>
    </div>
@endsection

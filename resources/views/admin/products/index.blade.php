@extends('layouts.app')

@section('title', 'Товары')

@section('content')
    <div class="container">
        <h1 class="mt-5">Товары</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Создать</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(count($products) > 0)
            <div class="table-responsive">
                <table class="table mt-3">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Изображение</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ number_format($product->price, 2, ',', ' ') }} р.</td>
                            <td>
                                <img src="{{ get_image_path($product->image) }}" alt="{{ $product->name }}" width="200">
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">Изменить</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Удалить?') ? true : false">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h4 class="text-center">Товаров пока нет</h4>
        @endif
    </div>
@endsection

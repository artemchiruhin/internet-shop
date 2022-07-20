@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="container">
        <h1 class="my-5">Каталог</h1>
        @if(count($products) > 0)
        <div class="products row">
            @foreach($products as $product)
            <div class="card col-12 col-xl-3 col-lg-4 col-md-6 mb-3 p-0">
                <img src="{{ get_image_path($product->image)  }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">Категория: <span class="text-primary">{{ $product->category->name }}</span></p>
                    <p class="card-text">Цена: <span class="text-primary">{{ number_format($product->price, 2, ',', ' ') }} р.</span></p>
                    <a href="{{ route('user.products.show', $product) }}" class="btn btn-primary d-block mt-auto">Подробнее</a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <h4 class="text-center">Товаров пока нет</h4>
        @endif
    </div>
@endsection

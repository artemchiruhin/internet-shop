@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="my-5">Каталог</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Сравнение (2)</button>
        </div>
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
                    <div class="card-buttons mt-auto">
                        <form action="{{ route('user.products.addToCart', $product) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary d-block w-100">В корзину</button>
                        </form>
                        <a href="{{ route('user.products.show', $product) }}" class="btn btn-outline-primary d-block mt-2">Подробнее</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <h4 class="text-center">Товаров пока нет</h4>
        @endif
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Сравнение товаров</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div class="card mb-3 p-0 mx-1">
                            <img src="{{ get_image_path(null)  }}" class="card-img-top" alt="">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Название 1</h5>
                                <p class="card-text">Описание 1</p>
                                <p class="card-text">Категория: <span class="text-primary">Категоия 1</span></p>
                                <p class="card-text">Цена: <span class="text-primary">Цена 1 р.</span></p>
                            </div>
                        </div>
                        <div class="card mb-3 p-0 mx-1">
                            <img src="{{ get_image_path(null)  }}" class="card-img-top" alt="">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Название 2</h5>
                                <p class="card-text">Описание 2</p>
                                <p class="card-text">Категория: <span class="text-primary">Категоия 2</span></p>
                                <p class="card-text">Цена: <span class="text-primary">Цена 2 р.</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

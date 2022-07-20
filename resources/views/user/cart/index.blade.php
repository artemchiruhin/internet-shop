@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <div class="container">
        <h1 class="my-5">Корзина</h1>
        @if(count($products) > 0)
            @foreach($products as $product)
            <div class="row mt-5 border-bottom border-primary pb-2">
                <div class="col-12 col-md-4">
                    <img src="{{ get_image_path($product->image) }}" alt="{{ $product->name }}" style="width: 100%;">
                </div>
                <div class="col-12 col-md-8 d-flex flex-column">
                    <h4 class="text-primary">{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <p>Цена: <span class="text-primary">{{ number_format($product->price, 2, ',', ' ') }} р.</span></p>
                    <p>Категория: <span class="text-primary">{{ $product->category->name }}</span></p>
                    <form action="{{ route('user.products.removeFromCart', $product) }}" method="POST" class="mt-auto">
                        @csrf
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
            @endforeach
            <div class="py-5 mt-5">
                <h4>Стоимость: <span class="text-primary">{{ $cost }} р.</span></h4>
                <form action="{{ route('user.cart.makeOrder') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Оформить заказ</button>
                </form>
            </div>
        @else
            <h4 class="text-center text-primary mt-5">Корзина пуста.</h4>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-4">
                <img src="{{ get_image_path($product->image) }}" alt="{{ $product->name }}" style="width: 100%;">
            </div>
            <div class="col-12 col-md-8 d-flex flex-column">
                <h4 class="text-primary">{{ $product->name }}</h4>
                <p>{{ $product->description }}</p>
                <p>Цена: <span class="text-primary">{{ number_format($product->price, 2, ',', ' ') }} р.</span></p>
                <p>Категория: <span class="text-primary">{{ $product->category->name }}</span></p>
                <form action="{{ route('user.products.addToCart', $product) }}" method="POST" class="mt-auto">
                    @csrf
                    <button class="btn btn-primary">В корзину</button>
                </form>
            </div>
        </div>
    </div>
@endsection

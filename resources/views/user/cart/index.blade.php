@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <div class="container">
        @forelse($products as $product)
        <div class="row mt-2">
            <div class="col-12 col-md-4">
                <img src="{{ get_image_path($product->image) }}" alt="{{ $product->name }}" style="width: 100%;">
            </div>
            <div class="col-12 col-md-8">
                <h4 class="text-primary">{{ $product->name }}</h4>
                <p>{{ $product->description }}</p>
                <p>Цена: <span class="text-primary">{{ number_format($product->price, 2, ',', ' ') }} р.</span></p>
                <p>Категория: <span class="text-primary">{{ $product->category->name }}</span></p>
                <form action="" method="POST">
                    @csrf
                    <button class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
        @empty
            <h4 class="text-center text-primary mt-5">Корзина пуста.</h4>
        @endforelse
    </div>
@endsection

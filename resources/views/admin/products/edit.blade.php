@extends('layouts.app')

@section('title', 'Изменить товар')

@section('content')
    <div class="container pb-5">
        <h1 class="my-5">Изменить товар с id {{ $product->id }}</h1>
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="form-label">Введите название</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Название" required>
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Введите описание</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Описание" required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Введите цену</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Цена" required>
                @error('price')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Выберите категорию</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id || $product->category->id == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <p>Текущее изображение</p>
                <img src="{{ $product->image ? asset('/storage/' . $product->image) : 'https://thumbs.dreamstime.com/b/no-image-available-icon-photo-camera-flat-vector-illustration-132483097.jpg' }}" alt="{{ $product->name }}" width="200">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Выберите изображение (необязательно)</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" >
                @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Изменить</button>
        </form>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary mt-3">Назад</a>
    </div>
@endsection

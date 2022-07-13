@extends('layouts.app')

@section('title', 'Создать категорию')

@section('content')
    <div class="container">
        <h1 class="my-5">Создать категорию</h1>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Введите название</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Название" required>
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary mt-3">Назад</a>
    </div>
@endsection

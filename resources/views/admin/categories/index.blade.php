@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <div class="container">
        <h1 class="mt-5">Категории</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Создать</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(count($categories) > 0)
        <table class="table mt-3">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Название</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $category->name }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">Изменить</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" onclick="return confirm('Удалить?') ? true : false" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
            @else
        <h4 class="text-center">Категорий пока нет</h4>
            @endif
    </div>
@endsection

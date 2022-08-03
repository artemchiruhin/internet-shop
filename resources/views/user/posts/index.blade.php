@extends('layouts.app')

@section('title', 'Посты')

@section('content')
    <div class="container">
        <h1 class="my-5">Посты с jsonplaceholder</h1>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-4 p-4 mb-5 border-bottom border-primary">
                    <h4 class="text-primary mb-3">{{ $loop->index + 1 . '. ' . $post->title }}</h4>
                    <p>{{ $post->description }}</p>
                </div>
            @empty
                <h4 class="text-primary text-center">Постов пока нет</h4>
            @endforelse
        </div>
    </div>
@endsection

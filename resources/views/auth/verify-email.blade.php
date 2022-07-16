@extends('layouts.app')

@section('title', 'Подтверждение почты')

@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-info" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="alert alert-primary mt-5" role="alert">
            <h4 class="alert-heading">Регистрация прошла успешно!</h4>
            <p>На указанную при регистрации почту было выслано письмо с подтверждением электронного адреса.</p>
            <hr>
            <div class="d-flex align-items-center">
                <p class="mb-0">Письмо не пришло?</p>
                <form action="{{ route('verification.send') }}" method="POST" class="mx-2">
                    @csrf
                    <button class="btn alert-link p-0">Отправить повторно</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Сбросить пароль')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 mx-auto">
                @if(session('status'))
                    <div class="alert alert-info" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h1 class="text-center my-5">Сброс пароля</h1>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $token }}" name="token">
                    <div class="mb-3">
                        <label for="email" class="form-label">Введите ваш email</label>
                        <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Эл. адрес" required>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Введите новый пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Пароль" required>
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Повторите пароль</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Пароль" required>
                        @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Сбросить пароль</button>
                </form>
            </div>
        </div>
    </div>
@endsection

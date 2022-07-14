@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-4 mx-auto">
                <h1 class="my-5 text-center">Авторизация</h1>
                @error('incorrect_data')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="login" class="form-label">Введите логин</label>
                        <input type="text" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror" id="login" name="login" placeholder="Логин" required autofocus>
                        @error('login')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Введите пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Пароль" required>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
@endsection

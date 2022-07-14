@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-4 mx-auto">
                <h1 class="my-5 text-center">Регистрация</h1>
                <form method="POST" action="{{ route('auth.register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="login" class="form-label">Введите логин</label>
                        <input type="text" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror" id="login" name="login" placeholder="Логин" required autofocus>
                        @error('login')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Введите ФИО</label>
                        <input type="text" value="{{ old('full_name') }}" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" placeholder="Фамилия Имя Отчество" required>
                        @error('full_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Введите email</label>
                        <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Эл. адрес" required>
                        @error('email')
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
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Повторите пароль</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Пароль" required>
                        @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
@endsection

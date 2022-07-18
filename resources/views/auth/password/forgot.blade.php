@extends('layouts.app')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md-4 mx-auto">
                @if(session('status'))
                    <div class="alert alert-info" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">Восстановление пароля</h4>
                    <p>Для восстановления пароля необходимо ввести электронный адрес, на который придет ссылка.</p>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Введите email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email">
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
@endsection

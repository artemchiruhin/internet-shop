@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container">
        <h1 class="my-5">Профиль</h1>
        <h4>Ваша информация:</h4>
        <ul class="list-group">
            <li class="list-group-item">Логин: <span class="text-primary">{{ auth()->user()->login }}</span></li>
            <li class="list-group-item">ФИО: <span class="text-primary">{{ auth()->user()->full_name }}</span></li>
            <li class="list-group-item">Email: <span class="text-primary">{{ auth()->user()->email }}</span>
                @if(auth()->user()->email_verified_at === null)
                <a href="{{ route('verification.notice') }}" class="badge text-primary bg-primary bg-opacity-10 border border-primary border-opacity-10 mx-2">Подтвердить</a>
                @else
                    <span class="badge text-primary bg-primary bg-opacity-10 border border-primary border-opacity-10 mx-2">Подтвержден</span>
                @endif
            </li>
        </ul>
    </div>
@endsection

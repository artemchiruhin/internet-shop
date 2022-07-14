@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container">
        <h1 class="my-5">Профиль</h1>
        <h4>Ваша информация:</h4>
        <ul class="list-group">
            <li class="list-group-item">Логин: {{ auth()->user()->login }}</li>
            <li class="list-group-item">ФИО: {{ auth()->user()->full_name }}</li>
            <li class="list-group-item">Email: {{ auth()->user()->email }}</li>
        </ul>
    </div>
@endsection

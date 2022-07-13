@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
    <div class="container">
        <h1 class="mt-5">Заказы</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(count($orders) > 0)
            <table class="table mt-3">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Клиент</th>
                    <th scope="col">Товары</th>
                    <th scope="col">Стоимость</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $order->user->full_name }}</td>
                        <td>{{ implode(', ', $order->products) }}</td>
                        <td>{{ array_reduce($order->products, function($sum, $obj) { $sum += $obj->price; }) }} р.</td>
                        <td>{{ $order->approved_at ? 'Подтвержден' : 'Не подтвержден' }}</td>
                        <td>
                            @if(!is_null($order->approved_at))
                            <div class="d-flex">
                                <form action="{{ route('admin.orders.approve', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success">Подтвердить</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h4 class="text-center">Заказов пока нет</h4>
        @endif
    </div>
@endsection

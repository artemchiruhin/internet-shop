@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <livewire:index-page :products="$products" />
@endsection

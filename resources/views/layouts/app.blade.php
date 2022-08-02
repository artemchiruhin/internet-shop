<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js" defer></script>
    @livewireStyles
    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Главная</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">Бургер</span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.profile') }}">Профиль</a>
                </li>
                @endauth
                <li class="nav-item position-relative">
                    <a class="nav-link" href="{{ route('user.cart.index') }}">Корзина</a>
                    <span class="position-absolute start-100 translate-middle badge rounded-pill bg-primary" style="top: 5px">
                        {{ count(session('cart') ?? []) }}
                    </span>
                </li>
                @if(auth()->check() && auth()->user()->role === 'admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Панель администратора
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Категории</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Товары</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">Заказы</a></li>
                    </ul>
                </li>
                    @endif
            </ul>
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a href="{{ route('auth.login') }}" class="nav-link">Вход</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('auth.register') }}" class="nav-link">Регистрация</a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-primary">Выход</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
@yield('content')

@livewireScripts
</body>
</html>

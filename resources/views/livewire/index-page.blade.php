<div>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="my-5">Каталог</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Сравнение ({{ count($productsForComparsion) }})</button>
        </div>
        @if(count($products) > 0)
            <div class="products row">
                @foreach($products as $product)
                    <div class="card col-12 col-xl-3 col-lg-4 col-md-6 mb-3 p-0">
                        <img src="{{ get_image_path($product->image)  }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Категория: <span class="text-primary">{{ $product->category->name }}</span></p>
                            <p class="card-text">Цена: <span class="text-primary">{{ number_format($product->price, 2, ',', ' ') }} р.</span></p>
                            <div class="card-buttons mt-auto">
                                <form action="{{ route('user.products.addToCart', $product) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary d-block w-100">В корзину</button>
                                </form>
                                <button type="button" class="btn btn-outline-primary d-block mt-2 w-100" wire:click="addForComparison({{ $product->id }})">Сравнить</button>
                                <a href="{{ route('user.products.show', $product) }}" class="btn btn-outline-primary d-block mt-2">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h4 class="text-center">Товаров пока нет</h4>
        @endif
    </div>

    <div @class(['modal','fade','show' => $isModalShown]) id="exampleModalCenter" tabindex="-1" aria-modal="true" role="dialog" @if($isModalShown) style="display: block" @endif>
        <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Сравнение товаров</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(is_null($firstProductForComparsion) && is_null($secondProductForComparsion))
                        <h4 class="text-primary text-center">Товаров для сравнения нет</h4>
                    @else
                        <div class="row">
                        @if(!is_null($firstProductForComparsion))
                            <div class="card mb-3 p-0 col-6">
                                <img src="{{ get_image_path($firstProductForComparsion['image'])  }}" class="card-img-top" alt="{{ $firstProductForComparsion['name'] }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $firstProductForComparsion['name'] }}</h5>
                                    <p class="card-text">{{ $firstProductForComparsion['description'] }}</p>
                                    <p class="card-text">Категория: <span class="text-primary">{{ $firstProductForComparsion['category']['name'] }}</span></p>
                                    <p class="card-text">Цена: <span class="text-primary">Цена {{ number_format($firstProductForComparsion['price'], 2, ',', ' ') }} р.</span></p>

                                </div>
                                <div class="card-buttons mt-auto">
                                    <h4 class="text-primary text-center">{{ $firstIndex + 1 }} из {{ count($productsForComparsion) }}</h4>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary" style="flex: 1; margin-right: 5px;" wire:click="changeFirstProductForComparsion({{ $firstIndex === 0 ? ($secondIndex === (count($productsForComparsion) - 1) ? (count($productsForComparsion) - 2) : (count($productsForComparsion) - 1)) : ($firstIndex - 1 === $secondIndex ? (($firstIndex - 2) >= 0 ? ($firstIndex - 2) : (count($productsForComparsion) - 1)) : ($firstIndex - 1)) }})">Предыдущий</button>
                                        <button type="button" class="btn btn-primary" style="flex: 1; margin-left: 5px;" wire:click="changeFirstProductForComparsion({{ ($firstIndex + 1) === count($productsForComparsion) ? ($secondIndex === 0 ? 1 : 0) : (($firstIndex + 1) === $secondIndex ? (($firstIndex + 2) <= (count($productsForComparsion) - 1) ? ($firstIndex + 2) : 0) : ($firstIndex + 1)) }})">Следующий</button>
                                    </div>
                                    <button type="button" class="btn btn-danger d-block mt-2 w-100" wire:click="deleteFromComparison({{ $firstProductForComparsion['id'] }})">Удалить</button>
                                </div>
                            </div>
                        @endif
                        @if(!is_null($secondProductForComparsion))
                            <div class="card mb-3 p-0 col-6">
                                <img src="{{ get_image_path($secondProductForComparsion['image'])  }}" class="card-img-top" alt="{{ $secondProductForComparsion['name'] }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $secondProductForComparsion['name'] }}</h5>
                                    <p class="card-text">{{ $secondProductForComparsion['description'] }}</p>
                                    <p class="card-text">Категория: <span class="text-primary">{{ $secondProductForComparsion['category']['name'] }}</span></p>
                                    <p class="card-text">Цена: <span class="text-primary">Цена {{ number_format($secondProductForComparsion['price'], 2, ',', ' ') }} р.</span></p>

                                </div>
                                <div class="card-buttons mt-auto">
                                    <h4 class="text-primary text-center">{{ $secondIndex + 1 }} из {{ count($productsForComparsion) }}</h4>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary" style="flex: 1; margin-right: 5px;" wire:click="changeSecondProductForComparsion({{ $secondIndex === 0 ? ($firstIndex === (count($productsForComparsion) - 1) ? (count($productsForComparsion) - 2) : (count($productsForComparsion) - 1)) : ($secondIndex - 1 === $firstIndex ? (($secondIndex - 2) >= 0 ? ($secondIndex - 2) : (count($productsForComparsion) - 1)) : ($secondIndex - 1)) }})">Предыдущий</button>
                                        <button type="button" class="btn btn-primary" style="flex: 1; margin-left: 5px;" wire:click="changeSecondProductForComparsion({{ ($secondIndex + 1) === count($productsForComparsion) ? ($firstIndex === 0 ? 1 : 0) : (($secondIndex + 1) === $firstIndex ? (($secondIndex + 2) <= (count($productsForComparsion) - 1) ? ($secondIndex + 2) : 0) : ($secondIndex + 1)) }})">Следующий</button>
                                    </div>
                                    <button type="button" class="btn btn-danger d-block mt-2 w-100" wire:click="deleteFromComparison({{ $secondProductForComparsion['id'] }})">Удалить</button>
                                </div>
                            </div>
                        @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

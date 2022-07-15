<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends \App\Http\Controllers\Admin\ProductController
{
    public function index()
    {
        return new ProductCollection(Product::all());
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $image = $request->file('image');
        $path = $image?->store('products');
        $validated['image'] = $path;
        $product = Product::create($validated);
        return response(new ProductResource($product), 201);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $image = $request->file('image');
        $path = $image?->store('products');
        if(!is_null($path)) {
            $this->deleteImage($product->image);
        }
        $validated['image'] = $path ?? $product->image;
        $product->update($validated);
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $this->deleteImage($product->image);
        return new ProductResource($product);
    }
}

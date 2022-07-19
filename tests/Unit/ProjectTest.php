<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function testGetCategories()
    {
        $this->json('get', route('api.categories.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'products' => [
                                '*' => [
                                    'id',
                                    'category_id',
                                    'name',
                                    'description',
                                    'price',
                                    'image',
                                    'created_at',
                                    'updated_at'
                                ]
                            ]
                        ]
                    ]
                ]
            );
    }

    public function testStoreCategory()
    {
        $payload = ['name' => fake()->word];
        $this->json('post', route('api.categories.index'), $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'id',
                    'name',
                    'products' => [
                        '*' => [
                            'id',
                            'category_id',
                            'name',
                            'description',
                            'price',
                            'image',
                            'created_at',
                            'updated_at'
                        ]
                    ]
                ]
            );
        $this->assertDatabaseHas('categories', $payload);
    }

    public function testGetOneCategory()
    {
        $category = Category::create(['name' => fake()->word]);
        $this->json('get', route('api.categories.show', $category))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'products' => [
                            '*' => [
                                'id',
                                'category_id',
                                'name',
                                'description',
                                'price',
                                'image',
                                'created_at',
                                'updated_at'
                            ]
                        ]
                    ]
                ]
            );
    }

    public function testUpdateCategory()
    {
        $category = Category::create(['name' => fake()->word]);
        $payload = ['name' => fake()->word];
        $this->json('put', route('api.categories.update', $category), $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'products' => [
                            '*' => [
                                'id',
                                'category_id',
                                'name',
                                'description',
                                'price',
                                'image',
                                'created_at',
                                'updated_at'
                            ]
                        ]
                    ]
                ]
            );
    }

    public function testDeleteCategory()
    {
        $payload = ['name' => fake()->word];
        $category = Category::create($payload);
        $this->json('delete', route('api.categories.destroy', $category));
        $this->assertDatabaseMissing('categories', $payload);
    }

    public function testGetProducts()
    {
        $this->json('get', route('api.products.index'))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'description',
                            'price',
                            'image',
                            'category',
                        ]
                    ]
                ]
            );
    }

    public function testStoreProduct()
    {
        Storage::fake('public');
        $image = UploadedFile::fake()->image('product.jpg');
        $category = Category::create(['name' => fake()->word]);
        $payload = ['name' => fake()->text(20), 'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0, 1000), 'category_id' => $category->id,
            'image' => $image];
        $this->json('post', route('api.products.store'), $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'id',
                    'name',
                    'description',
                    'price',
                    'image',
                    'category'
                ]
            );
        $this->assertDatabaseHas('products', [
            'name' => $payload['name'],
        ]);
        $category->delete();
        Storage::delete('/products/' . $image->hashName());
    }

    public function testGetOneProduct()
    {
        $category = Category::create(['name' => fake()->word]);
        $product = Product::create(['name' => fake()->text(20), 'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0, 1000), 'category_id' => $category->id]);
        $this->json('get', route('api.products.show', $product))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                        'category'
                    ]
                ]
            );
        $category->delete();
    }

    public function testUpdateProduct()
    {
        $category = Category::create(['name' => fake()->word]);
        $product = Product::create(['name' => fake()->word, 'description' => fake()->text, 'price' => fake()->randomFloat(2, 0, 1000), 'category_id' => $category->id]);
        $payload = ['name' => fake()->word, 'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0, 1000), 'category_id' => $category->id];
        $this->json('put', route('api.products.update', $product), $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                        'category'
                    ]
                ]
            );
        $this->assertDatabaseHas('products', [
            'name' => $payload['name'],
        ]);
        $category->delete();
    }

    public function testDeleteProduct()
    {
        $category = Category::create(['name' => fake()->word]);
        $product = Product::create(['name' => fake()->word, 'description' => fake()->text, 'price' => fake()->randomFloat(2, 0, 1000), 'category_id' => $category->id]);
        $this->json('delete', route('api.products.destroy', $product));
        $this->assertDatabaseMissing('products', ['name' => $product->name]);
        $category->delete();
    }
}

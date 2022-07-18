<?php

namespace Tests\Unit;

use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function testGetCategories()
    {
        $this->json('get', 'api/categories')
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
        $this->json('post', 'api/categories', $payload)
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
        $this->json('get', "api/categories/$category->id")
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
        $this->json('put', "api/categories/$category->id", $payload)
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
        $this->json('delete', "api/categories/$category->id");
        $this->assertDatabaseMissing('categories', $payload);
    }
}

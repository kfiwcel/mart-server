<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use refreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function product_index_api_should_return_paginate_data()
    {
        Category::factory()->count(2)->create();
        Product::factory()->count(50)->create();
        $response = $this->json('GET','api/products');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'current_page'=>1
        ]);

        $response->assertJsonStructure([
            'meta',
            'links'
        ]);

        $data=json_decode($response->getContent())->data;
        $this->assertCount(10,$data);
    }

    public function product_show_api_should_return_a_exist_product()
    {
        $response = $this->json('GET','api/products/hello');//
        $response->assertStatus(404);

        Category::factory()->count(2)->create();
        $product=Product::factory()->count(1)->create()->first();
        $response = $this->json('GET','api/products/'.$product->slug);
        $response->assertJsonFragment([
            'slug'=>$product->slug
        ]);
    }
}

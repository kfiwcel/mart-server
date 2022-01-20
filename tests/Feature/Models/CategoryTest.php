<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function index_api_should_return_sorted_roots_categories()
    {
        $categories=Category::factory()->count(3)->create();
        $categories->each(function ($category){
            $category->update([
                'order'=>$category->id
            ]);
        });
        $response=$this->json('GET','api/categories');
        $categories->each(function ($category) use($response){
            $response->assertJsonFragment([
                'slug'=>$category->slug
            ]);
        });
        $response->assertSeeInOrder([
            $categories->first()->slug,
            $categories->last()->slug
        ]);
    }
}

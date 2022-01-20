<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @test
     */
    public function a_category_has_many_children()
    {
       $parent=Category::factory()->create();
       $parent->children()->saveMany([
           Category::factory()->create(),
           Category::factory()->create(),
           Category::factory()->create()
       ]);
       $this->assertCount(3,$parent->children);
    }

    public function a_category_has_only_one_parent()
    {
        $child=Category::factory()->create();
        $parent=Category::factory()->create();
        $parent->children()->save($child);
        $this->assertEquals(1,$child->parent()->count());
    }
}

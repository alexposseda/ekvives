<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function category_must_have_image_path_not_blob()
    {
        $category = factory(Category::class)->states('with_image')->create();
        $this->assertTrue(file_exists('public/uploads/main' . $category->image));
        $category->delete();
    }

    /** @test */
    public function category_must_have_a_slug()
    {
        $category = factory(Category::class)->create();

        $not_empty_slug = strlen($category->slug) > 0;
        $this->assertTrue(is_string($category->slug));
        $this->assertTrue($not_empty_slug);
    }

    /** @test */
    public function you_can_get_anchored_to_main_categories()
    {
        factory('App\Models\Category', 2)->create(['anchored' => 0]);
        factory('App\Models\Category', 3)->create(['anchored' => 1]);
        $categories = Category::main()->get();
        $this->assertCount(3, $categories);
    }
}

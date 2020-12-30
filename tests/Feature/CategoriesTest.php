<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_anchored_categories_on_main()
    {
        $not_main_category = factory('App\Models\Category')->create(['anchored' => 0]);
        $main_category = factory('App\Models\Category')->create(['anchored' => 1]);

        $this->get('/')
            ->assertSee($main_category->title)
            ->assertSee($main_category->mini)
            ->assertDontSee($not_main_category->title);
    }
}

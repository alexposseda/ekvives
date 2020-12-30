<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_news()
    {
        $first_article = factory(Article::class)->create();
        $second_article = factory(Article::class)->create();

        $this->get(route('news'))
            ->assertSee($first_article->title)
            ->assertSee($second_article->title);
    }
}

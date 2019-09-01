<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Article;
use Carbon\Carbon;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function article_must_have_a_slug()
    {
        $article = factory(Article::class)->create();

        $not_empty_slug = strlen($article->slug) > 0;
        $this->assertTrue(is_string($article->slug));
        $this->assertTrue($not_empty_slug);
    }

    /** @test */
    public function article_may_be_published()
    {
        $article = factory(Article::class)->create(['published_at' => Carbon::now()->subDay()]);
        $articles = Article::published()->pluck('id')->toArray();

        $this->assertTrue(in_array($article->id, $articles));
    }

    /** @test */
    public function not_published_article_not_seen_in_published_list()
    {
        $yesterday_article = factory(Article::class)->create(['published_at' => Carbon::now()->subDay()]);
        $tommorow_article = factory(Article::class)->create(['published_at' => Carbon::now()->addDay()]);
        $articles = Article::published()->pluck('id')->toArray();

        $this->assertTrue(in_array($yesterday_article->id, $articles));
        $this->assertTrue(!in_array($tommorow_article->id, $articles));
    }
}

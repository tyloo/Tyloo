<?php

namespace App\Tests\Http\Controllers\Frontend;

use App\Post;
use App\Tag;
use App\Tests\AbstractTestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogControllerTest extends AbstractTestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function it_has_an_index_page_listing_blog_posts()
    {
        $this->visit('/blog')->seePageIs('/blog');
        $this->assertViewHas('posts');
    }

    /** @test */
    public function it_has_a_page_listing_showing_a_single_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id, 'image' => 'test']);
        $this->visit('/blog/' . $post->slug)->seePageIs('/blog/' . $post->slug);
        $this->assertViewHas('post');
    }

    /** @test */
    public function it_has_a_page_listing_posts_from_a_tag()
    {
        $tag = factory(Tag::class)->create();
        $this->visit('/blog/tag/' . $tag->slug)->seePageIs('/blog/tag/' . $tag->slug);
        $this->assertViewHas('posts');
    }
}

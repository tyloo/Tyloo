<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Criteria\PostType;
use App\Repositories\PostsRepository;
use App\Repositories\UsersRepository;

class DashboardController extends Controller
{
    /**
     * @var \App\Repositories\PostsRepository
     */
    private $post;

    /**
     * @var \App\Repositories\UsersRepository
     */
    private $user;

    public function __construct(PostsRepository $post, UsersRepository $user)
    {

        $this->post = $post;
        $this->user = $user;
    }

    public function index()
    {
        $blogPostsCount = $this->post->criteria(new PostType('blog'))->count();
        $workPostsCount = $this->post->criteria(new PostType('work'))->count();
        $usersCount = $this->user->count();

        return view('backend.dashboard.index', compact('blogPostsCount', 'workPostsCount', 'usersCount'));
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Repositories\Site\PostRepository;
use App\Repositories\Site\SidebarRepository;

/**
 * Class MainController
 * @package App\Http\Controllers\Site
 */
class MainController extends SiteController
{
    const PERPAGE = 5;

    /**
     * MainController constructor.
     * @param PostRepository $post_rep
     * @param SidebarRepository $sidebar_rep
     */
    public function __construct(PostRepository $post_rep, SidebarRepository $sidebar_rep)
    {
        parent::__construct(new \App\Repositories\Site\CategoryRepository(new \App\Models\Category));

        $this->post_rep = $post_rep;
        $this->sidebar_rep = $sidebar_rep;

        $this->template = env('THEME').'.main';
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sidebar = view(env('THEME').'.parts.sidebar')->render();
        $this->vars = Arr::add($this->vars, 'sidebar', $sidebar);

        $posts = $this->getPosts();
        $content = view(env('THEME').'.parts.content')->with('posts', $posts)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        $lastTwoPosts = $this->post_rep->all([], 'id', 'desc');
        $lastTwoPostsView = view(env('THEME').'.parts.last_two_posts')
            ->with('posts', $lastTwoPosts)->render();
        $this->vars = Arr::add($this->vars, 'lastTwoPosts', $lastTwoPostsView);

        return $this->renderOutput();
    }

    /**
     * @return mixed
     */
    protected function getPosts()
    {
        return $this->post_rep
            ->allQuery([], 'id', 'desc')
            ->with('user', 'categories')
            ->paginate(self::PERPAGE);
    }
}

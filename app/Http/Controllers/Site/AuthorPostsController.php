<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Repositories\Site\PostRepository;
use App\Repositories\Site\UserRepository;

/**
 * Class AuthorPostsController
 * @package App\Http\Controllers\Site
 */
class AuthorPostsController extends SiteController
{
    const PERPAGE = 3;

    /**
     * AuthorPostsController constructor.
     * @param PostRepository $post_rep
     * @param UserRepository $user_rep
     */
    public function __construct(PostRepository $post_rep, UserRepository $user_rep)
    {
        parent::__construct(new \App\Repositories\Site\CategoryRepository(new \App\Models\Category));

        $this->post_rep = $post_rep;
        $this->user_rep = $user_rep;

        $this->template = env('THEME').'.show_posts_author.index';
    }

    /**
     * @param $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($user_id)
    {
        $user = $this->getUser($user_id);
        $posts = $this->getPosts($user_id);
        $content_author = view(env('THEME').'.show_posts_author.author_posts')
            ->with(['posts' => $posts, 'user' => $user])->render();
        $this->vars = Arr::add($this->vars, 'content_author', $content_author);

        return $this->renderOutput();
    }

    /**
     * @param $user_id
     */
    protected function getPosts($user_id)
    {
        $search = ['user_id' => $user_id];
        $posts = $this->post_rep->allQuery($search, 'id', 'desc')->paginate(self::PERPAGE);

        return count($posts) > 0 ? $posts : abort(404);
    }

    /**
     * @param $user_id
     */
    protected function getUser($user_id)
    {
        $user = $this->user_rep->find($user_id);

        return $user ? $user : abort(404);
    }
}

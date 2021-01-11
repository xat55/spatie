<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Repositories\Site\PostRepository;

/**
 * Class SinglePostController
 * @package App\Http\Controllers\Site
 */
class SinglePostController extends SiteController
{
    /**
     * SinglePostController constructor.
     * @param PostRepository $post_rep
     */
    public function __construct(PostRepository $post_rep)
    {
        parent::__construct(new \App\Repositories\Site\CategoryRepository(new \App\Models\Category));

        $this->post_rep = $post_rep;

        $this->template = env('THEME').'.show_post.index';
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($id)
    {
        $post = $this->getPost($id);
        $content_post = view(env('THEME').'.show_post.post')->with('post', $post)->render();
        $this->vars = Arr::add($this->vars, 'content_post', $content_post);

        return $this->renderOutput();
    }

    /**
     * @param $id
     */
    protected function getPost($id)
    {
        $post = $this->post_rep->find($id);

        return $post ? $post : abort(404);
    }
}

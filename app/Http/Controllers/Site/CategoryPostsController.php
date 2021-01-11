<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Repositories\Site\PostRepository;
use App\Repositories\Site\UserRepository;

/**
 * Class CategoryPostsController
 * @package App\Http\Controllers\Site
 */
class CategoryPostsController extends SiteController
{
    const PERPAGE = 4;

    /**
     * CategoryPostsController constructor.
     * @param PostRepository $post_rep
     * @param UserRepository $user_rep
     */
    public function __construct(PostRepository $post_rep, UserRepository $user_rep)
    {
        parent::__construct(new \App\Repositories\Site\CategoryRepository(new \App\Models\Category));

        $this->post_rep = $post_rep;
        $this->template = env('THEME').'.show_posts_category.index';
    }

    /**
     * @param $category_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($category_id)
    {
        $category = $this->getCategory($category_id);
        $posts = $this->getPostsCategory($category);

        $content_category = view(env('THEME').'.show_posts_category.category_posts')
            ->with(['posts' => $posts, 'category' => $category])
            ->render();
        $this->vars = Arr::add($this->vars, 'content_category', $content_category);

        return $this->renderOutput();
    }

    /**
     * @param $category
     * @return mixed
     */
    protected function getPostsCategory($category)
    {
        return $category->posts()->paginate(self::PERPAGE);
    }

    /**
     * @param $category_id
     */
    protected function getCategory($category_id)
    {
        $category = $this->cat_rep->find($category_id);

        return $category ? $category : abort(404);
    }
}

<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Repositories\Site\PostRepository;
use App\Repositories\Site\UserRepository;

class CategoryPostsController extends SiteController
{    
    public function __construct(PostRepository $post_rep, UserRepository $user_rep)
    {
        parent::__construct(new \App\Repositories\Site\CategoryRepository(new \App\Models\Category));
        
        $this->post_rep = $post_rep;
        $this->template = env('THEME').'.show_posts_category.index';
    }
    
    public function index($category_id)
    {
        $posts = $this->getPostsCategory($category_id);
        $category = $this->getCategory($category_id);
        
        $content_category = view(env('THEME').'.show_posts_category.category_posts')
            ->with(['posts' => $posts, 'category' => $category])
            ->render();
        $this->vars = Arr::add($this->vars, 'content_category', $content_category);
        
        return $this->renderOutput();
    }
    
    protected function getPostsCategory($category_id) 
    {
        $category = $this->getCategory($category_id);
        
        return $category->posts;
    }
    
    protected function getCategory($category_id) 
    {
        $category = $this->cat_rep->find($category_id);
        
        return $category ? $category : abort(404);
    }
}

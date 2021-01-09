<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Repositories\Site\PostRepository;

class SearchPostsController extends SiteController
{
    const PERPAGE = 3;
    
    public function __construct(PostRepository $post_rep)
    {
        parent::__construct(new \App\Repositories\Site\CategoryRepository(new \App\Models\Category));
        
        $this->post_rep = $post_rep;
        
        $this->template = env('THEME').'.search_posts.index';
    }
    
    public function index(Request $request)
    {
        $field = 'text';
        $search = $request->get('s');
        
        $posts = $this->getFoundPosts($field, $search, self::PERPAGE);
        $search_posts = view(env('THEME').'.search_posts.posts')
            ->with(['posts' => $posts])->render();
        $this->vars = Arr::add($this->vars, 'search_posts', $search_posts);
        
        return $this->renderOutput();
    }
    
    protected function getFoundPosts($field, $search, $perPage) 
    {      
        $posts = $this->post_rep->getLike($field, $search, $perPage); 
        
        return $posts;
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Repositories\Site\PostRepository;
use App\Repositories\Site\SidebarRepository;

class MainController extends SiteController
{
    const PERPAGE = 5;
    
    public function __construct(PostRepository $post_rep, SidebarRepository $sidebar_rep)
    {
        parent::__construct(new \App\Repositories\Site\CategoryRepository(new \App\Models\Category));
        
        $this->post_rep = $post_rep;
        $this->sidebar_rep = $sidebar_rep;
        
        $this->template = env('THEME').'.main';
    }
    
    public function index()
    {
        // dd(env('THEME'));
        // $posts = true;
        // $sidebar = view(env('THEME').'.parts.content')->with('posts', $posts)->render();
        $sidebar = view(env('THEME').'.parts.sidebar')->render();
        $this->vars = Arr::add($this->vars, 'sidebar', $sidebar);
        
        $posts = $this->getPosts();
        $content = view(env('THEME').'.parts.content')->with('posts', $posts)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);
        
        $lastTwoPosts = $this->post_rep->all([], 'id', 'desc', 0, 2);
        $lastTwoPostsView = view(env('THEME').'.parts.last_two_posts')
            ->with('posts', $lastTwoPosts)->render();
        $this->vars = Arr::add($this->vars, 'lastTwoPosts', $lastTwoPostsView);
        
        return $this->renderOutput();
    }

    protected function getPosts() 
    {
        return $this->post_rep->paginate(self::PERPAGE); 
        // return $this->post_rep->get(); 
    }
    
    
    // public function getMainPage()
    // {        
    //     $posts = Post::all();
    //     // $posts = Post::with('categories', 'user')->get();
    //     $categories = Category::all();
    //     // $posts = Post::with('categories', 'user')->paginate(3);
    // 
    //     return view('site.main', compact('posts', 'categories'));
    // }
    // 
    // public function getArticlesOfAuthor($user_id)
    // {
    //     $user = User::find($user_id);
    //     $posts = Post::where('user_id', $user_id)->with('categories')->get();
    //     $categories = Category::all();
    // 
    //     return view('site.show-posts-author', compact('posts', 'user', 'categories'));
    // }
    
    public function getArticlesOfCategory($category)
    {
        $category = Category::find($category);
        $posts = $category->posts;
        // dd($category->posts);
    
        return view('site.show-posts-category', compact('category', 'posts'));
    }
}

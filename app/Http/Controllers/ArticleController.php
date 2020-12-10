<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
// use DB;

class ArticleController extends Controller
{
    public function getArticles()
    {
        // $result = DB::table('posts')
        //     ->select()
        //     ->where('author', 'name')
        //     // ->offset(2)
        //     // ->limit(1)
        //     ->first();
        
        // dd($result->header);
        // dd($result->first());
        
        $posts = Post::all();
        
        return view('main', compact('posts'));
    }
    
    public function getArticlesOfAuthor($nameAuthor)
    {
        $posts = Post::where('author', $nameAuthor)->get();
        
        return view('show-posts-author', compact('posts', 'nameAuthor'));
    }
}

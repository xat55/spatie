<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Site\CategoryRepository;

class SiteController extends Controller
{
    protected $cat_rep;
    protected $post_rep;
    protected $single_post_rep;
    protected $sidebar_rep;
    
    protected $template;
    protected $vars = [];
    
    protected $bar;
    protected $contentBar;
    
    public function __construct(CategoryRepository $cat_rep)
    {
        $this->cat_rep = $cat_rep;
    }
    
    protected function renderOutput()
    {
        $categories = $this->getCategoriesMenu();
        $navigation = view(env('THEME').'.parts.navigation')->with('categories', $categories)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);
        
        return view($this->template)->with($this->vars);
    }
    
    protected function getCategoriesMenu() 
    {
        return $this->cat_rep->get(); 
    }
    
    // @section('categories_menu')
    //     @includeIf(env('THEME').'.parts.categories_menu')
    // @endsection
}

<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Site\CategoryRepository;

/**
 * Class SiteController
 * @package App\Http\Controllers\Site
 */
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

    /**
     * SiteController constructor.
     * @param CategoryRepository $cat_rep
     */
    public function __construct(CategoryRepository $cat_rep)
    {
        $this->cat_rep = $cat_rep;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function renderOutput()
    {
        $categories = $this->getCategoriesMenu();
        $navigation = view(env('THEME').'.parts.navigation')->with('categories', $categories)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        return view($this->template)->with($this->vars);
    }

    /**
     * @return mixed
     */
    protected function getCategoriesMenu()
    {
        return $this->cat_rep->get();
    }
}

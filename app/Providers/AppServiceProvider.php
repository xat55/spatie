<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        
        // @set($counter, 1)
        Blade::directive('set', function ($exp) {
            list($name, $val) = explode(', ', $exp);
            
            return "<?php $name = $val ?>";
        });
    
        // view()->composer('layouts.sidebar', function ($view) {
        //     $view->with('popular_posts', Post::orderBy('views', 'desc')->limit(3)->get());
        //     $view->with('cats', Category::withCount('posts')->orderBy('posts_count', 'desc')->get());
        // });
    }
}

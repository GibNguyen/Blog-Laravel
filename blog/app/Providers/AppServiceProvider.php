<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        $allCategory = Category::all();
        $allPost = Post::all();
        $allUser = User::all();

        View::share('allCategory', $allCategory);
        View::share('allPost', $allPost);
        View::share('allUser', $allUser);
        //
        Paginator::useBootstrap();
    }
}

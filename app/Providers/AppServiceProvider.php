<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::listen(function (QueryExecuted $query) {
            // $query->sql;
            //  $query->bindings;
            //$query->time;
            // dump($query->sql, $query->bindings);
            Log::channel('customsqllogs')->info($query->sql);
        });
        // =======================>> Here show menu on specific pages  =============================
        view()->composer(['home*', 'user', 'contact', 'posts.create', 'user.register', 'user.alert', 'user.login', 'user.my_account', 'user.forgot-password', 'user.reset-password', 'posts.post', 'posts.edit', 'search'], function (View $view) {
            // $menu = '<ul>';
            // $menu .= '<li style="list-style: none;"><a href=" ' . route('home.index') . '">Home</a></li>';
            // $menu .= '<li style="list-style: none;"><a href=" ' . route('home.test') . '">Test</a></li>';
            // $menu .= '<li class="dropdown">';
            // $menu .= '<button class="dropbtn">Catalog </button>';
            // // $menu .= '<ul style="display: block;">';
            // $menu .= '<ul class="dropdown-content">';
            // $menu .= '<a href=" ' . route('home.catalog.notebook.notebooks') . '">Notebooks</a>';
            // $menu .= '<a href="#">Laptors</a>';
            // $menu .= '<a href="#">Smartphones</a>';
            // $menu .= '</ul>';
            // $menu .= '</li>';
            // // $menu .= '</div></div>';
            // $menu .= '<li style="list-style: none;"><a href=" ' . route('contact') . '">Contact</a></li>';
            // $menu .= '</ul>';
            // $view->with('menu', $menu);

            // $menu  = '<div class="menu-container">';
            // $menu .= '<i class="menu-toggle"></i>';
            // $menu .= '<div class="menu">';
            // $menu .= '<ul>';

            $menu = '<li style="list-style: none;"><a href=" ' . route('home.index') . '">Home</a></li>';
            $menu .= '<li style="list-style: none;"><a href=" ' . route('home.test') . '">Test</a></li>';
            //======>>First Tier Drop Down
            $menu .= '<li>';
            $menu .= '<label for="drop-1" class="toggle">Catalog +</label>';
            $menu .= '<a href="#">Catalog</a>';
            $menu .= '<input type="checkbox" id="drop-1">';
            $menu .= '<ul>';
            $menu .= '<li><a href=" ' . route('home.catalog.notebook.notebooks') . '">Notebooks</a></li>';
            // ======>> Second Tier Drop Down
            $menu .= '<li>';
            $menu .= '<label for="drop-2" class="toggle">Laptors +</label>';
            $menu .= '<a href="#">Laptors</a>';
            $menu .= '<input type="checkbox" id="drop-2">';
            $menu .= '<ul>';
            $menu .= '<li><a href="#">Playing Laptors</a></li>';
            $menu .= '<li><a href="#">Smart Laptors</a></li>';
            $menu .= '<li><a href="#">IPad-Laptors</a></li>';
            $menu .= '</ul>';
            $menu .= '</li>';
            $menu .= '<li><a href="#">Smartphones</a></li>';
            $menu .= '</ul>';
            $menu .= '</li>';
            $menu .= '<li style="list-style: none;"><a href=" ' . route('home.contact') . '">Contact</a></li>';
            // $menu .= '</ul>';

            $view->with('menu', $menu);
        });
        // ===>> ЗДЕСЬ ПОКАЗЫВАЕМ  ПОСТЫ В ОБРАТНОМ ПОРЯДКЕ ===========
        view()->composer(['home*', 'contact', 'home.catalog.notebook', 'posts.post', 'user.my_account'], function (View $view) {
            $view->with('posts', Post::query()->orderBy('id', 'desc')->paginate(6));
        });
    }
}

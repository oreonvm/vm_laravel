<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Country;
use App\Models\Post;
use App\Mail\MessageUser;
use App\Models\Contact;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $categories_id = DB::table('categories')->pluck('id', 'id');
        // ===>> ВЫБИРАЕМ  НАЗВАНИЯ СВЯЗАННЫХ ПОСТОВ и КАТЕГОРИЙ, к которым они ОТНОСЯТСЯ
        $posts_cat = Post::with('category')->get();
        $categories = DB::table('categories')->select('id', 'title', 'slug')->get();
        //$tag = Tag::get()->pluck('id');
        //  dd($tag);  // id ==>> all tags
        $tags_posts = Tag::pluck('title', 'id')->all();
        // dd($tags_posts);  // =====>> ВСЕ  ТЕГИ  С id и title
        // $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = DB::table('posts')->select('id', 'title', 'slug', 'content')->get();

        $tags = Tag::query()->get(['id', 'title']);
        // dd($tags);  // ===>> ВЫВОД ВСЕХ ТЕГОВ с title и id
        //=================================================
        // ==============>> МНОГИЕ КО МНОГИМ  =======================
        $post = Post::find(4);
        // dump($post->title);
        foreach ($post->tags as $tag) {
            // dump($tag->title);
        }
        //===========================================================
        // =======>>  ВЫБИРАЕМ ИЗ БАЗЫ ВСЕ ПОСТЫ в ОБРАТНОМ ПОРЯДКЕ
        // ========>> ЧТОБЫ ОТОБРАЖАТЬ  САМЫЕ СВЕЖИЕ ПОСТЫ ПЕРВЫМИ
        // $posts = Post::query()->orderBy('id', 'desc')->get();
        // $posts = Post::paginate(15);
        // $posts = DB::table('posts')->paginate(15);
        // ===============>> Set or get caches for elements =====================
        // if (Cache::has('posts')) $posts = Cache::get('posts');
        // else  $posts = Post::query()->orderBy('id', 'desc')->get();
        // Cache::put('posts', $posts);
        // ==========================================================
        // $users = User::orderBy('id')->get();
        // dd($users);
        return View(
            'home.index',
            [
                'title' => 'Home page',
                'description' => 'Home page Laravel'
            ],
            compact('posts', 'posts_cat', 'categories', 'tags', 'tags_posts')
        );
    }

    public function contact(): \Illuminate\View\View
    {
        $user = auth()->user();
        return View('home.contact', ['title' => 'Contact page', 'description' => 'Contact us'], compact('user'));
    }

    public function test(): \Illuminate\View\View
    {
        $name = 'Richard';
        $age = 54;
        return View('home.test', ['title' => 'TEST page', 'description' => 'Test page for Laravel'], compact('name', 'age'));
    }
    public function catalog(): \Illuminate\View\View
    {
        $dell_models = 'DELL models:';
        $acer_models = 'Acer models:';
        $asus_models = 'ASUS models';
        $hp_models = 'HP models';
        return view("home.catalog.notebook.notebooks", ['title' => 'List notebooks', 'description' => [$dell_models, $acer_models, $asus_models, $hp_models]]);
    }
    public function notebooks($slug): \Illuminate\View\View
    {
        $dell_models = 'DELL models:';
        $acer_models = 'Acer models:';
        $asus_models = 'ASUS models';
        $hp_models = 'HP models';
        // $posts = Post::query()->orderBy('id', 'desc')->get();
        return view("home.catalog.notebook.$slug", ['title' => $slug, 'description' => $slug], compact('dell_models', 'acer_models', 'asus_models', 'hp_models'));
    }

    /**
     * Sending mail users and  receiving email with a screenshot from USERS
     *  using function mail() without attachment ( See ContactController)
     */
   
}

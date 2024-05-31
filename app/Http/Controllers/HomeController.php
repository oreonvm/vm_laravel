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
        /**
         * ================>>  СЕССИИ  =========================
         */
        // ===>> ДОБАВЛЕНИЕ или ВСТАВКА  ДАННЫХ  в СЕССИЮ
        // $request->session()->push('user', ['id' => '1', 'name' => 'Mark']);
        // $request->session()->push('user', ['id' => '2', 'name' => 'Jon']);
        // //==> ПОЛУЧЕНИЕ ДАННЫХ ИЗ СЕССИИ  ====
        // dump($request->session()->all());
        // dump(session()->all());

        // dump(session()->get('user')[0]['name']); // ===>> Mark
        // dump(session()->get('user')[1]['name']); // ===>> Jon

        /**
         * Получение и удаление элемента  из сессии
         */
        // $value = $request->session()->pull('test', 'default');
        // dump($value);

        // ===============  End СЕССИЯМ =====================================
        //=======>> КУКИ  и ПОЛУЧЕНИЕ ИХ =====================
        // $response = $request->cookie('test', 'TEST', 1);
        // dump($response);
        //  $value =  Cookie::get('color', 'blue color', 1);
        // dump($value);

        //=================>>> КЭШИРОВАНИЕ ДАННЫХ ==========================
        // ========>> ПРОВЕРКА ЕСТЬ ЛИ ОПРЕЕЛЕН ДАННЫЕ В КЭШЕ С ПОМ Cache::has('КЛЮЧ') ==========
        Cache::has('КЛЮЧ');
        // ========>> УСТАНОВИТЬ КЭШ С ПОМ Cache::put('КЛЮЧ', 'value', ВРЕМЯ в СЕКУНДАХ) =========
        Cache::put('КЛЮЧ', 'value', 'ВРЕМЯ в СЕКУНДАХ');
        // =======>> ИЗВЛЕЧЬ ДАННЫЕ ИЗ КЭША  С ПОМ Cache::get('КЛЮЧ') ====
        Cache::get('КЛЮЧ');
        // ======>> ПОЛУЧИТЬ И СРАЗУ УДАЛИТЬ С ПОМ Cache::pull('КЛЮЧ') ===========
        Cache::pull('КЛЮЧ');
        // ======>> УДАЛИТЬ КЭШ ОПРЕДЕЛЕН ДАННЫХ  С ПОМ  Cache::forget('КЛЮЧ') =======
        Cache::forget('КЛЮЧ');
        // ===>>  ОЧИСТКА ВСЕГО КЭША или УДАЛЕНИЕ ВСЕХ ДАННЫХ В КЭШЕ  С ПОМ  Cache::flush() =====
        // Cache::flush();

        //  Cache::flush();
        // Cache::put('key', 'value');
        // $test = Cache::get('key');
        // $test = Cache::pull('key')

        //$test = Cache::get('key');
        // $test = Cache::forget('key');
        // dump($test);


        //     // ================ Cookies ======================================
        // $response = $request->cookie('test', 'TEST', 1);
        // dump($response);
        // ВЫВОД ====>> TEST
        // $value =  Cookie::get('color', 'blue color', 1);
        // dump($value);
        //ВЫВОД =====>> blue color
        //         УДАЛЕНИЕ КУКИ
        //     ********************
        // $cookie = Cookie::forget('test');
        // dump($cookie);
        //         СРАЗУ ПОСЛЕ - ПРОВЕРКА  УДАЛЕНА ЛИ КУКА
        //         ***********************************************
        // $cookie =  Cookie::get('test');
        // dump($cookie);

        // ================End Cookies ===================================

        // $users = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/users'), true);
        //dump($users); // ===>> МАССИВ ЕСЛИ ВТОРОЙ АРГУМЕНТ ==>> true
        //===>>> СОЗДАДИМ КАТЕГОРИЮ с ПОМ Eloquent ORM ============
        $category4 = new Category();
        $category4->title = 'iPads';
        $category4->slug = 'ipads';
        //  $category4->save();
        //===>>> СОЗДАДИМ ПОСТ с ПОМ Eloquent ORM   ПЕРВЫЙ ВАРИАНТ ============
        $post_1 = new Post();
        $post_1->title = 'ПЕРВЫЙ  ПОСТ';
        $post_1->slug = 'pervy_post';
        $post_1->content = 'Какой-то  текст в первом посте';
        $post_1->category_id = 1;
        // $post_1->save();

        //===>>> СОЗДАДИМ ПОСТ с ПОМ Eloquent ORM   ВТОРОЙ ВАРИАНТ ============
        // $post_2 = Post::create(['title' => 'ВТОРОЙ ПОСТ', 'content' => 'Какой-то  текст во втором посте']);

        //=====>> ЧТОБЫ ОБНОВИТЬ ЗАПИСЬ В ТАБЛ posts НАПРИМЕР post_2 ГДЕ НЕТ ПОЛЯ slug НУЖНО СДЕЛАТЬ ТАК =========

        // $post_2_update = Post::find(2);
        // $post_2_update->category_id =  2;
        //$post_2_update->save();

        $post_3_update = Post::find(3);
        $post_3_update->title = 'ТРЕТИЙ ПОСТ';
        //  $post_3_update->save();

        // $post_4_update = Post::find(5);
        // $post_4_update->id = 4;
        //$post_4_update->save();

        // $post_5_update = Post::find(6);
        // $post_5_update->id = 5;
        // $post_5_update->save();


        // $category_2_update = Category::find(7);
        // $category_2_update->id =  2;
        // $category_2_update->save();
        // $category_3_update = Category::find(8);
        // $category_3_update->id =  3;
        // $category_3_update->save();

        // $category_2 = Category::create(['title' => 'Notebooks', 'slug' => 'notebooks']);
        // $category_3 = Category::create(['title' => 'Phones', 'slug' => 'phones']);

        // $post_4 = Post::create(['id' => 4, 'title' => 'ЧЕТВЕРТЫЙ ПОСТ', 'slug' => 'chetverty_post', 'content' => 'Какой-то  текст в четвертом посте', 'category_id' => 2]);
        // $post_5 = Post::create(['id' => 5, 'title' => 'ПЯТЫЙ ПОСТ', 'slug' => 'pyaty_post', 'content' => 'Какой-то  текст в пятом посте', 'category_id' => 2]);
        //  $post_6 = Post::create(['id' => 6, 'title' => 'ШЕСТОЙ ПОСТ', 'slug' => 'shestoyy_post', 'content' => 'Какой-то  текст в шестом посту', 'category_id' => 3]);

        // $post_3_update = Post::find(4);
        // $post_3_update->id = 3;
        // $post_3_update->slug = 'trety_post';
        // $post_3_update->content = 'Какой-то  текст в тетьем посте';
        // $post_3_update->category_id = 1;
        // // $post_3_update->save();

        // $post_select = Post::all()->toArray();
        // $post_select = Post::query()->first()->toArray();
        // $post_select = Post::query()->find(1, ['title', 'slug'])->toArray();
        // dump($post_select);

        // $country_select = Country::query()
        //     ->where('population', '>', 100000)
        //     ->limit(10)
        //     ->get(['code', 'name', 'population'])
        //     ->toArray(); //===>> ЧТОБЫ ПОЛУЧИТЬ НЕОБХОДИМУЮ ВЫБОРКУ БЕЗ ОСТАЛЬНЫХ ДАННЫХ ЗАПРОСА =====
        // dd($country_select);

        // $country_select = Country::query()
        //     ->where('code', '<', 'caf')
        //     ->limit(20)
        //     ->get(['code', 'name', 'population'])
        //     ->toArray();
        // dd($country_select);

        // =======>> НАХОДИМ ВЗИМОСВЯЗЬ или Relations  МЕЖДУ ПОСТАМИ и КАТЕГОРИЯМИ ====
        /**
         *  ========>>  ОДИН К ОДНОМУ
         */
        // $post = Post::find(1);
        // dump($post->title, $post->category->title);  // ==>> "ПЕРВЫЙ  ПОСТ"  и  "Phones"

        /**
         * ========>> ОДИН КО МНОГИМ
         */
        // $categoies = Category::find(2)->posts()->select('title', 'content')->get();
        //   dump($categoies);
        // $user = User::find(1)->select('email')->get();
        // dump($user); // ====>> attribute: healthystyle451healthylifestyle451@gmail.com



        // $post_tag = Post::find(66);
        // dd($post_tag->tags()->sync(1, 4, 10));
        // foreach ($post_tag as $post) {
        //     dd($post->title, $post->tag->title);
        // }
        // ================Merging values from two tables   ======================
        $postsTest = DB::table('posts')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select(['posts.title', 'posts.slug', 'posts.content', 'categories.title', 'categories.slug'])
            // ->limit(5)
            ->get();
        // dd($postsTest);
        //===================================================================
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
        // $post =  Post::find($id = 1);
        // dump($post->id);//==>>  1

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


    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'email',
    //         'subject' => 'required',
    //         'message' => 'required',
    //         'image'  => 'image',
    //     ]);
    //=================================================================
    // if ($request->method() == 'POST') {
    //     $data = "<p><b> First name</b> {$request->input('first_name')}</p>";
    //     $data .= "<p><b> Last name</b> {$request->input('last_name')}</p>";
    //     $data .= "<p><b> Email</b> {$request->input('email')}</p>";
    //     $data .= "<p><b> Subject</b> {$request->input('sub')}</p>";
    //     $data .= "<p><br>" . nl2br($request->input('message')) . "</p>";

    //     if ($request->hasFile('image')) {
    //         $folder = date('Y-m-d');
    //         $image =  $request->file('image')->store("images/{$folder}");
    //     }
    //     $image = htmlspecialchars_decode(asset('storage/' . $image));
    //     $data .= $image;

    //     Mail::to('healthylifestyle451@gmail.com')->send(new MessageUser($data));
    //================================================================

    //     $data = $request->all();
    //     if ($request->hasFile('image')) {
    //         $folder = date('Y-m-d');
    //         $data['image'] = $request->file('image')->store("images/{$folder}");
    //     }
    //     // Storage::curl_file_create($data['image']);
    //     $contact = Contact::create($data);
    //     if ($request->method() == 'POST') {
    //         $first_name = "Name {$request->input('first_name')}";
    //         $last_name = $request->input('last_name');
    //         $email = "Email {$request->input('email')}";
    //         $sub = "Laravel: {$request->input('subject')}";
    //         $headers = "Content-type:text/plain; charset = UTF-8\r\nFrom:$first_name' '$last_name<contact>\r\nReply-To:$email";
    //         $headers .= "Content-Type: multipart/mixed\r\n\n";

    //         $mes = "<p><br>" . nl2br($request->input('message')) . "</p><br><br>";

    //         $data['image'] = htmlspecialchars_decode(asset('storage/' . $data['image']));
    //         $mes .= "\n\n" . $data['image'];
    //         $mes = strip_tags($mes);
    //         $address = 'support@laravel.health-spiritual.com';
    //         //   $sent = mail($address, $sub, $mes, "Content-type:text/plain; charset = UTF-8\r\nFrom:$first_name' '$last_name<contact>\r\nReply-To:$email");
    //         $sent = mail($address, $sub, $mes, $headers);
    //         return redirect('/contact')->with('status', 'Mail send successfully!!!');
    //     }
    //     return View('home.contact', ['title' => 'Contact page', 'description' => 'Contact us']);
    // }
}

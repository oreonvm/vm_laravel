<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use function Laravel\Prompts\info;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as IlluminateViewView;
// use Stevebauman\Hypertext\Transformer;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        // $data = DB::update("update posts set id = 6  where title = ? ", ['post 8']);
        // $data = DB::update("update posts set content  = 'Any text for post 6...' where title = ? ", ['post 8']);

        //  $data = DB::update("update posts set title = ? where id = ? ", ['ШЕСТОЙ ПОСТ', 6]);

        // $data = DB::insert(
        //     'insert into posts (title, content, created_at, updated_at) values (?,?,?,?)',
        //     ['post 8', 'Any text for post 8', NOW(), NOW()]
        // );
        //  dump($data);
        // $title = DB::table('posts')->pluck('content', 'title');
        //  dump($title);
        // DB::table('posts')->insert([
        //     ['title' => 'post 7', 'content' => 'Any text for post 7', 'created_at' => NOW(), 'updated_at' => NOW('')]
        // ]);

        // DB::table('posts')->insert([
        //     ['title' => 'post 4', 'content' => 'Any text for post 4', 'created_at' => NOW(), 'updated_at' => NOW()],
        //     ['title' => 'post 5', 'content' => 'Any text for post 5', 'create_at' => NOW(), 'updated_at' => NOW()],
        // ]);

        // DB::update("UPDATE `posts` SET `content` = 'Text for post 4 ...', `updated_at` = NOW() WHERE `posts`.`id` = ?", [4]);
        // DB::update("UPDATE `posts` SET `content` = 'Text for post 6 ...', `updated_at` = NOW() WHERE `posts`.`id` = ?", [8]);

        // $data =  DB::table('country')->limit(20)->get();
        // $data = DB::table('country')->select('name', 'code')->where('population', 103000)
        //     ->get();
        // dump($data);  // #items: array:1 [▼
        //     0 => {#1287 ▼
        //     +"name": "Aruba"
        //     +"code": "ABW"
        //     }
        // ]

        // $data = DB::table('country')->select('name', 'code')
        //     ->whereBetween('population', [10000, 200000])
        //     ->get();
        //   dump($data);

        // $data1 = DB::table('country')->select('name', 'code')
        //     ->where('population', '<', 1000000)
        //     ->get();
        //  dump($data1);

        // $data2 = DB::table('country')
        //     ->join('city', 'city.countryCode', '=', 'code')
        //     ->select('country.name as country_name', 'country.population', 'city.name  as city_name', 'city.population')
        //     ->limit(10)
        //     ->get();
        // dump($data);
        // dump($data1);
        // dump($data2);
        //s dump($data);

        //  DB::insert(
        //     'INSERT INTO posts (title, content, created_at, updated_at) VALUES (?, ?, ?, ?)',
        //     ['post 2', 'Any Text for post 2', NOW(), NOW()]
        // );
        // ==========>> БЕЗОПАСНЫЙ ЗАПРОС SQL ПРОТИВ SQL ИНЪЕКЦИЙ  через ?   А ПОТОМ В МАССИВ ПЕРЕДАНО
        // ===>>  ЗНАЧЕНИЕ КОТОРОЕ МЫ ХОТИММ ПОСТАВИТЬ ====================
        // $query = DB::delete("DELETE FROM posts WHERE `posts`.`id` = ?", [8]);
        // $query1 = DB::delete("DELETE FROM posts WHERE `posts`.`id` = ?", [9]);
        // $query2 = DB::delete("DELETE FROM posts WHERE `posts`.`id` = ?", [10]);

        //  DB::update("UPDATE `posts` SET `id` = '3', `updated_at` = NOW() WHERE `posts`.`id` = ?", [4]);
        //  DB::update("UPDATE `posts` SET `content` = 'Text for post 3 ...', `updated_at` = NOW() WHERE `posts`.`id` = ?", [3]);

        // $post1 =  DB::insert(
        //     'INSERT INTO posts (title, content, created_at, updated_at) VALUES (?, ?, ?, ?)',
        //     ['post 1', ' Text for post 1...', NOW(), NOW()]
        // );
        // $post2 = DB::insert(
        //     'INSERT INTO posts (title, content, created_at, updated_at) VALUES (?, ?, ?, ?)',
        //     ['post 2', ' Text for post 2...', NOW(), NOW()]
        // );
        // $post3 = DB::insert(
        //     'INSERT INTO posts (title, content, created_at, updated_at) VALUES (?, ?, ?, ?)',
        //     ['post 3', ' Text for post 3...', NOW(), NOW()]
        // );

        // DB::update("UPDATE `posts` SET `id` = '1', `updated_at` = NOW() WHERE `posts`.`id` = 17");
        // DB::update("UPDATE `posts` SET `id` = '2', `updated_at` = NOW() WHERE `posts`.`id` = 18");
        // DB::update("UPDATE `posts` SET `id` = '3', `updated_at` = NOW() WHERE `posts`.`id` = 19");
        // // );

        // $query = DB::delete("DELETE FROM posts WHERE `posts`.`id` = 23 ");
        // $query1 = DB::delete("DELETE FROM posts WHERE `posts`.`id` = 24");
        // $query2 = DB::delete("DELETE FROM posts WHERE `posts`.`id` = 25 ");

        //  ===>> ВЫБОРКА ВСЕХ ПОСТОВ из ТАБЛ posts =======
        // $posts = DB::select('SELECT * FROM posts');
        //=====>>>  Получение списка значений столбца например title ======
        // $titles = DB::table('posts')->pluck('title');
        // foreach ($titles as $title) {
        // $title;                 //=====>> post 1 post 2 post 3
        // }
        // ====>> Для получения одной строки по значению столбца id используйте метод find:
        // $postX = DB::table('posts')->find(3);
        // ИЛИ ТАК ======>> ДЛя получения одиночного значения нужного поля (content) столбца
        // по другому полю (в даноом случае по title) этого  же столбца
        // $text = DB::table('posts')->where('title', 'post 2')->value('content');
        // dump($posts);
        // dump($post1);
        // dump($post2);
        // dump($post3);
        // dump($postX);
        // dump($text);

        // =================>> РУЧНОЕ ИСПОЛЬЗОВАНИЕ  ТРАНЗАКИЙ  =================
        //  =========== ДЛЯ ПРЕДОТВРАЩЕНИЯ ОШИБОК ВО ВРЕМЯ ВЫПОЛНЕНИЯ ЗАПРОСОВ
        // DB::beginTransaction();
        // try {
        //     DB::delete("DELETE FROM posts WHERE ( posts.id = ?)", [11]);
        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     $e->getMessage();
        // }

        // =======================================================================
        // $posts = Post::all()->select('title', 'content');
        // $posts = Post::query()->orderBy('id', 'asc')->paginate(7);
        // dump($posts);

        return view('posts.index');
    }

    public function uploadImage(Request $request)
    {
        // $folder = date('Y-m-d');
        // $imgpath = $request->file('image')->store("images/{$folder}");
        // return response()->json(['location' => "/storage/$imgpath"]);
        // if ($request->hasFile('image')) {
        //     $folder = date('Y-m-d');
        //     $image = $request->file('image')->store("images/{$folder}");
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $user = auth()->user();
        return view('posts.create',  [
            'title' => 'Create new post',
            'description' => 'Create new post',
        ], compact('categories', 'users', 'user', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $users = User::pluck('email', 'id')->all();
        $users = User::query()->orderBy('id', 'asc')->get();
        // dd($users);
        $user = auth()->user();
        //  dd($user_current['id']);  // 4

        $this->validate($request, [
            'title' => 'required|unique:posts|min:5|max:100',
            'email' => 'required|email',
            'content' => 'required',
            'category_id' => 'integer',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $folder = date('Y-m-d');
            $data['image'] = $request->file('image')->store("images/{$folder}");
        }
        $post = Post::create($data);
        $post->tags()->sync($request->tags);
        // return view('user.my_account', [
        //     'title' => 'User profile', 'description' => 'User profile'
        // ], compact('user', 'data'))->with('status', "Пост успешно создан!");
        return redirect('/user/my_account')->with('success', "Пост успешно создан!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post =  Post::find($id);
        $post->views += 1;
        $post->update();
        if ($post === null) abort(404, 'This page not found! ');
        return View::make('posts.post', ['title' => 'post', 'post' => $id], compact('post', 'id'))->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $image = $post->image ? $post->image : null;
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        if ($post === null) abort(404, 'This page not found! ');
        // return View::make('posts.edit', ['title' => "Edit post $id", 'post' => $id])->with('post', $post);
        return view('posts.edit', ['title' => 'post', 'post' => $post], compact('tags', 'categories', 'image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePost(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'integer',
        ]);
        $post = Post::find($id);
        $data = $request->all();
        if (!empty($post->image)) Post::deleteImage($request, $post->image);
        if ($request->hasFile('image')) {
            $folder = date('Y-m-d');
            $data['image'] = $request->file('image')->store("images/{$folder}");
        }
        $post->update($data);
        $post->tags()->sync($request->tags);
        // $input = $request->all();
        // $title = $input['title'];
        // $content = $input['content'];
        // $id = $input['post'];
        // $post = DB::table('posts')
        //     ->where('id', $id)
        //     ->update(['title' => $title, 'content' => $content, 'updated_at' => NOW()]);

        return redirect('/user/my_account')->with('success', "Данные поста успешно изменены !");
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(int  $id)
    // {
    //     $post = Post::find($id);
    //     Storage::delete($post->image);
    //     return redirect('/user/my_account')->with('success', "Данные поста успешно изменены !");
    // }
}

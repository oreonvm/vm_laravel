<?php

namespace App\Http\Controllers\Oreho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post_tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user || $user->is_admin != 1) abort(404, 'This page not found! ');
        // $posts = Post::query()->paginate(4);
        $posts = Post::with('category', 'tags')->paginate(4);
        $tags = Tag::orderBy('id')->get();
        // $posts =  Category::paginate(2)->all();
        return view('oreho.posts.index', ['title' => 'List posts'], compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if (!$user || $user->is_admin != 1) abort(404, 'This page not found! ');
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('oreho.posts.create',  [
            'title' => 'Create new post',
            'description' => 'Create new post',
        ], compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        return redirect('/oreho/posts')->with('success', "Пост успешно создан!");
    }

    /**
     * Display the specified resource.
     */
    public function showOreho(string $id)
    {
        // $postOreho =  Post::find($id);
        // if ($postOreho === null) abort(404, 'This page not found! ');
        // return View::make('oreho.posts.post', ['title' => 'post', 'post' => $id], compact('post', 'id'))->with('post', $postOreho);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        if (!$user || $user->is_admin != 1) abort(404, 'This page not found! ');
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        if ($post === null) abort(404, 'This page not found! ');
        return view('oreho.posts.edit', ['title' => 'post', 'post' => $post], compact('tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        return redirect('/oreho/posts')->with('success', "Данные поста успешно изменены !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->tags()->sync([]);
        if (!empty($post->image)) Storage::delete($post->image);
        $post->delete();
        return redirect('/oreho/posts')->with('success', 'Пост успешно удален!');
    }
}

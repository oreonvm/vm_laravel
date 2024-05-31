<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            's' => 'required',
        ]);
        $s = $request->s;
        // ==================>> ВТОРОЙ  ВАР-Т =====================
        // $posts = DB::table('posts')
        //     ->where('title', 'like', "%{$s}%")
        //     ->pluck('title');
        // ==================>> ОСНОВНОЙ  ВАР-Т =====================
        $categories = DB::table('categories')->select('id', 'title', 'slug')->get();
        $tags = Tag::query()->get(['id', 'title']);
        $posts_cat = Post::with('category')->get();
        $posts = Post::query()->where('title', 'LIKE', "%{$s}%")
            ->orWhere('content', 'LIKE', "%{$s}%")
            ->paginate(3);
        // dd($posts);
        return view('search', ['title' => 'Search posts'], compact('posts', 's', 'categories', 'tags', 'posts_cat'));
    }
}

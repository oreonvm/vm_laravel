<?php

namespace App\Http\Controllers\Oreho;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user || $user->is_admin != 1) abort(404, 'This page not found! ');
        $tags = Tag::query()->paginate(2);
        // $tags =  Tag::paginate(2)->all();
        return view('oreho.tags.index', ['title' => 'List tags'], compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('oreho.tags.create',  [
            'title' => 'Create new tag',
            'description' => 'Create new tag',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tags = Tag::query()->paginate(2);
        $this->validate($request, [
            'title' => 'required|unique:tags|max:40',
        ]);

        Tag::create($request->all());
        return redirect('/oreho/tags')->with('success', 'Тег успешно создан!');
        // return view('oreho.tags.index',['title' => 'List tags'], compact('tags'));
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $tag = Tag::find($id);
    //     return view('oreho.tags.index', ['title' => 'List tags'], compact('tag'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::find($id);
        if ($tag === null) abort(404, 'This page not found! ');
        return view('oreho.tags.edit', ['title' => 'Edit tag', 'tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $input = $request->all();
        $title = $input['title'];
        DB::table('tags')
            ->where('id', $id)
            ->update(['title' => $title, 'updated_at' => NOW()]);
        return redirect('/oreho/tags')->with('success', 'Тег успешно изменен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        if ($tag->posts->count()) {
            return redirect('/oreho/tags')->with('error', 'Нельзя удалить Тег,т.к. у тега есть посты!');
        }
        $tag->delete();
        return redirect('/oreho/tags')->with('success', 'Тег успешно удален!');
    }
}

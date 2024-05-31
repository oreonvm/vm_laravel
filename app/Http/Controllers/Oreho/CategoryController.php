<?php

namespace App\Http\Controllers\Oreho;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user || $user->is_admin != 1) abort(404, 'This page not found! ');
        $categories = Category::query()->paginate(2);
        // $categories =  Category::paginate(2)->all();
        return view('oreho.categories.index', ['title' => 'List categories'], compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('oreho.categories.create',  [
            'title' => 'Create new category',
            'description' => 'Create new category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = Category::query()->paginate(2);
        $this->validate($request, [
            'title' => 'required|unique:categories|max:40',
        ]);

        Category::create($request->all());
        return redirect('/oreho/categories')->with('success', 'Категория успешно создана!');
        // return view('oreho.categories.index',['title' => 'List categories'], compact('categories'));
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $category = Category::find($id);
    //     return view('oreho.categories.index', ['title' => 'List categories'], compact('category'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if ($category === null) abort(404, 'This page not found! ');
        return view('oreho.categories.edit', ['title' => 'Edit category', 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $input = $request->all();
        $title = $input['title'];
        DB::table('categories')
            ->where('id', $id)
            ->update(['title' => $title, 'updated_at' => NOW()]);
        return redirect('/oreho/categories')->with('success', 'Категория успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category->posts->count()) {
            return redirect('/oreho/categories')->with('error', 'Нельзя удалить Категорию,т.к. у категории есть посты!');
        }
        $category->delete();
        return redirect('/oreho/categories')->with('success', 'Категория успешно удалена!');
    }
}

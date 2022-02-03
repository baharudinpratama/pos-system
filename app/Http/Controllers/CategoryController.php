<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::latest()->get();
        $search = request('search');

        if ($search) {
            $categories = Category::where('name', 'like', '%' . request('search') . '%')->orderBy('name')->get();
        }

        return view('main.category.index', compact('categories', 'search'));
    }

    public function api()
    {
        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:categories|max:32',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('categoryAdded', 'New category data created succesfully');
    }

    public function edit(Category $category)
    {
        return view('main.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name' => ['required', 'max:64'],
        ]);

        $category->name = $request->name;
        $category->save();

        return redirect('categories');
    }
    
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('categories');
    }
}

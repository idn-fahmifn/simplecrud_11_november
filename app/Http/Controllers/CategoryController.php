<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\{Category, Item};

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories' => Category::withCount('item')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => ['required', 'string', 'min:3', 'max:30']
        ]);

        // array data yang akan disimpan
        $simpan = [
            'category_name' => $request->cat_name,
            'uuid' => Str::uuid()
        ];

        Category::create($simpan);
        return back()->with('status', 'Category has been created');
    }

    public function show($param)
    {
        $category = Category::where('uuid', $param)->firstOrFail();
        return view('category.show', [
            'category' => $category,
            'items' => Item::where('category_id', $category->id)->get()
        ]);
    }

    public function update(Request $request, $param)
    {
        $request->validate([
            'cat_name' => ['required', 'string', 'min:3', 'max:30']
        ]);

        $data = Category::where('uuid', $param)->firstOrFail();

        // array data yang akan disimpan
        $simpan = [
            'category_name' => $request->cat_name,
            'uuid' => Str::uuid()
        ];

        $data->update($simpan);
        return redirect()->route('category.show', $data->uuid)->with('status', 'Category has been updated');
    }

    public function delete($param)
    {
        $data = Category::where('uuid', $param)->firstOrFail();
        $data->delete();
        return redirect()->route('category.index')->with('status', 'Category has been deleted');
    }

}

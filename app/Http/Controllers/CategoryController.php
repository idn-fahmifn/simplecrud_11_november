<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories' => Category::all()
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
        return view('category.show', [
            'category' => Category::where('uuid', $param)->firstOrFail()
        ]);
    }

}

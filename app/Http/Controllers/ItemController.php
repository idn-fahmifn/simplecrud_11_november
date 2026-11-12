<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\{Category, Item};

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('items.index', [

            'items' => Item::with('category')->latest()->paginate(10),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'min:3', 'max:30'],
            'brand' => ['required', 'string', 'min:3', 'max:30'],
            'category' => ['required', 'integer', 'exists:categories,id'],
            'stock' => ['required', 'integer', 'min:0', 'max:999'],
            'image' => ['required', 'file', 'mimes:png,jpg,jpeg', 'max:2048'],
            'description' => ['required'],
        ]);

        $simpan = [
            'uuid' => Str::uuid7(),
            'item_name' => $request->item_name,
            'category_id' => $request->category,
            'stock' => $request->stock,
            'brand' => $request->brand,
            'desc' => $request->description,
        ];

        $gambar = $request->file('image');
        $path = 'images/items';
        $format = $gambar->getClientOriginalExtension();
        $nama = 'item_image_'.now()->format('Ymdhis').'-'.uniqid().'.'.$format; // item_image_20261112110000-jkasndjaksnd2.jpg

        $simpan['image'] = $nama; // yang disimpan di database
        $gambar->storeAs($path, $nama, 'public');

        Item::create($simpan);

        return back()->with('status', 'Item Has Been Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        return view('items.show', [
            'item' => Item::where('uuid', $param)->firstOrFail(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $param)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'min:3', 'max:30'],
            'brand' => ['required', 'string', 'min:3', 'max:30'],
            'category' => ['required', 'integer', 'exists:categories,id'],
            'stock' => ['required', 'integer', 'min:0', 'max:999'],
            'image' => ['file', 'mimes:png,jpg,jpeg', 'max:2048'],
            'description' => ['required'],
        ]);

        $data = Item::where('uuid', $param)->firstOrFail();

        $simpan = [
            'uuid' => Str::uuid7(),
            'item_name' => $request->item_name,
            'category_id' => $request->category,
            'stock' => $request->stock,
            'brand' => $request->brand,
            'desc' => $request->description,
        ];

        // jika ada gambar baru / gambar akan diubah
        if ($request->hasFile('image')) {

            Storage::disk('public')->delete('images/items/'.$data->image);

            $gambar = $request->file('image');
            $path = 'images/items';
            $format = $gambar->getClientOriginalExtension();
            $nama = 'item_image_'.now()->format('Ymdhis').'-'.uniqid().'.'.$format; // item_image_20261112110000-jkasndjaksnd2.jpg

            $simpan['image'] = $nama; // yang disimpan di database
            $gambar->storeAs($path, $nama, 'public');
        }

        $data->update($simpan);

        return redirect()->route('items.show', $data->uuid)->with('status', 'Item Has Been Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($param)
    {
        $data = Item::where('uuid', $param)->firstOrFail();
        Storage::disk('public')->delete('images/items/'.$data->image);
        $data->delete();
        return redirect()->route('items.index')->with('status', 'Item Has Been Deleted');

    }
}

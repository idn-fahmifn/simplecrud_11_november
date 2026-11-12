<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Category, Item};

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'totalCategories' => Category::count(),
            'totalItem' => Item::count(),
            'totalStock' => Item::sum('stock'),
            'lowStock' => Item::where('stock', '<=', 5)->count()
        ]);
    }
}

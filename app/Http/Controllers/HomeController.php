<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$categories = Category::with('products')->select('id', 'title', 'alias')->get();
        $categories = Category::getCategories();
        $products = Product::with(['category', 'photos'])->select('id', 'category_id', 'title', 'alias', 'amount')->paginate(20);
        return view('index', compact('categories', 'products'));
    }

    public function main()
    {
        return view('main');
    }
}

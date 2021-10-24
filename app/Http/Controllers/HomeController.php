<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $categories = Category::getCategories();
        $products = Product::with(['category', 'photos'])->select('id', 'category_id', 'title', 'alias', 'amount', 'count')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('index', compact('categories', 'products'));
    }

    public function main()
    {
        $orders = Order::with('products')->where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('main', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::find($id);
        return view('order', compact('order'));
    }
}

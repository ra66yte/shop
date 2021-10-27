<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSettingsRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
            ->paginate(9);
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
        $order = Order::where('id', $id)->where('user_id', Auth::user()->id)->get()->first();
        if ($order === null) return redirect()->route('index')->with('warning', 'Заказ не найден.');
        return view('order', compact('order'));
    }

    public function settings() {
        return view('settings');
    }

    public function saveSettings(SaveSettingsRequest $req) {
        $user = User::find(Auth::user()->id);
        $user->last_name = $req->last_name;
        $user->first_name = $req->first_name;
        $user->middle_name = $req->middle_name;
        if ($req->password) $user->password = password_hash($req->password, PASSWORD_DEFAULT);
        $user->update();
        return redirect()->route('settings')->withSuccess('Изменения сохранены.');
    }

}

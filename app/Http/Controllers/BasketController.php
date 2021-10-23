<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index() {
        return view('basket.index');
    }

    public function store(Request $req) {
        $ids = json_decode($req->ids, true);

        $order = Order::create();
        $order->user_id = Auth::user()->id;
        $order->name = Auth::user()->last_name . ' ' . Auth::user()->first_name . ' ' . Auth::user()->middle_name;
        $order->save();

        $order->products()->attach(array_keys($ids));
        foreach ($ids as $id => $count) {
            $pivotRow = $order->products()->where('product_id', $id)->first()->pivot;
            $pivotRow->count = $count;
            $pivotRow->update();
        }

        return ['success' => 'Заказ оформлен.', 'route' => route('main')];
    }

    /*public function add($id) {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($id)) {
            $pivotRow = $order->products()->where('product_id', $id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
            dd($pivotRow);
        } else {
            $order->products()->attach($id);
        }

        return redirect()->route('basket');
    }

    public function remove($id)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        } else {
            $order = Order::find($orderId);
        }

        return redirect()->route('basket');
    }*/

    public function getProducts(Request $req) {
        $ids = json_decode($req->ids);
        $products = [];
        foreach ($ids as $id => $count) {
            $product = Product::find($id);
            if (isset($product)) {
                $data_product = [
                    'id' => $product->id,
                    'title' => $product->title,
                    'amount' => $product->amount,
                    'count' => $count,
                    'image' => ($product->photos->count()) ? asset('storage/' . $product->photos->first()->image) : asset('images/no-image.png'),
                    'route' => route('product_show', $product->alias)
                ];
                $products[$product->id] = $data_product;
            }
        }

        return ['products' => $products];
    }

}

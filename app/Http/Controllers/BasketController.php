<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmRepeat;
use App\Mail\OrderCreated;
use App\Models\ActivateLink;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BasketController extends Controller
{
    public function index() {
        return view('basket.index');
    }

    public function store(Request $req) {

        $ids = json_decode($req->ids, true);
        if (is_array($ids) and $ids) {
            $user_type = 0; // 0 - гость, 1 - есть в базе, но не залогинен, 2 - есть в базе и залогинен
            $password = '';
            if (Auth::check()) {
                $user = Auth::user();
                $user_type = 2;
            } else {
                $user = User::where('email', $req->email)->get()->first();
                if (isset($user)) {
                    $user_type = 1;
                } else {
                    $password = $this->gen_password(8);

                    $user = User::create(['last_name' => '',
                        'first_name' => $req->name,
                        'middle_name' => '',
                        'email' => $req->email,
                        'password' => password_hash($password, PASSWORD_DEFAULT)]);
                }

            }

            $order = Order::create();
            $order->user_id = $user->id;
            $order->save();

            $order->products()->attach(array_keys($ids));
            foreach ($ids as $id => $count) {
                $pivotRow = $order->products()->where('product_id', $id)->first()->pivot;
                $pivotRow->count = $count;
                $pivotRow->price = $order->products()->where('product_id', $id)->first()->amount;
                $pivotRow->update();

                $product = Product::find($id);
                $product->count = $product->count - $count;
                $product->update();

            }

            $mail_data = [
                'name' => $user->first_name,
                'email' => $user->email,
                'password' => $password,
                'order' => $order,
                'activate_link' => $this->genActivateLink($user->id, $order->id),
                'user_type' => $user_type,
            ];

            Mail::to($user->email)->send(new OrderCreated($mail_data));

            $message = 'На Ваш адрес электронной почты ' . $user->email . ' было отправлено письмо для подтверждения заказа.';

            return ['success' => $message, 'route' => route('basket')];
        }
        return ['error' => 'Произошла ошибка.', 'route' => route('basket')];
    }

    public function confirm($hash) {
        $confirm = ActivateLink::where('hash', $hash)->get()->first();
        if (isset($confirm)) {
            $order = Order::find($confirm->order_id);
            $order->status = 1;
            $order->save();
            $confirm->delete();

            return redirect()->route(Auth::check() ? 'main' : 'login')->withSuccess('Заказ ' . (Auth::check() ? '#' . $order->id : '') . ' подтвержден.');
        }

        return redirect()->route('index')->with('warning', 'Произошла ошибка.');
    }

    public function repeat(Request $req) {
        $old_activation = ActivateLink::where('order_id', $req->id)->get()->first();
        $user = Auth::user();
        if (isset($old_activation)) {
            $new_hash = $this->resetActivateLink($user->id, $old_activation->order_id);

            $mail_data = [
                'name' => $user->first_name,
                'activate_link' => $this->resetActivateLink($user->id, $req->id),
            ];

            Mail::to($user->email)->send(new ConfirmRepeat($mail_data));

            return redirect()->route('order_show', $req->id)->withSuccess('Письмо для подтверждения заказа #' . $req->id . ' успешно отправлено!');
        }

        return redirect()->route('index')->with('warning', 'Произошла ошибка.');
    }



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
                    'available' => $product->count,
                    'route' => route('product_show', [$product->category->alias, $product->alias])
                ];
                $products[$product->id] = $data_product;
            }
        }

        return ['products' => $products];
    }

    private function gen_password($length = 6)
    {
        $password = '';
        $arr = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
            'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
        );

        for ($i = 0; $i < $length; $i++) {
            $password .= $arr[random_int(0, count($arr) - 1)];
        }

        return $password;
    }

    private function genActivateLink($user_id, $order_id) {
        $activate_link = new ActivateLink();
        $activate_link->user_id = $user_id;
        $activate_link->order_id = $order_id;
        $activate_link->hash = md5($user_id . time() . $order_id);
        $activate_link->save();

        return route('confirm_order', $activate_link->hash);
    }

    private function resetActivateLink($user_id, $order_id) {
        $old_activation = ActivateLink::where('order_id', $order_id)->get()->first();
        if (isset($old_activation)) {
            $old_activation->hash = md5($user_id . time() . $old_activation->order_id);
            $old_activation->update();
            return route('confirm_order', $old_activation->hash);
        }

        return false;
    }

}

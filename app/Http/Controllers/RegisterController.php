<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function __construct() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
    }

    public fuction save(Request $request)
    {

        $validateFields = $request->validate([
            'first_name' => 'required|min:1|max:60',
            'last_name' => 'required|min:1|max:60',
            'middle_name' => 'max:60',
            'email' => 'required|email',
            'password' => 'password:api'
        ]);

        $user = User::create($validateFields);

        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        }

        return redirect(route('register'))->withErrors([
            'createError' => 'Не удалось создать аккаунт!'
        ]);

    }
}

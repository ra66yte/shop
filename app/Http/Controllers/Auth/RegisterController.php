<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'middle_name' => ['max:60'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:60', 'confirmed'],
            
        ],
        [
            'first_name.required' => 'Необходимо указать имя!',
            'first_name.max:60'   => 'Поле "Имя" должно содержать не более 60 символов!',
            'last_name.required'  => 'Необходимо указать фамилию!',
            'last_name.max:60'    => 'Поле "Фамилия" должно содержать не более 60 символов!',
            'email.required'      => 'Необходимо указать E-mail!',
            'email.email'         => 'E-mail указан неправильно!',
            'email.max:255'       => 'Поле "E-mail" должно содержать не более 255 символов!',
            'password.required'   => 'Необходимо указать пароль!',
            'password.min:8'      => 'Поле "Пароль" должно содержать не менее 8 символов!',
            'password.max:60'     => 'Поле "Пароль" должно содержать не более 60 символов!',
            'password.confirmed'  => 'Пароли не совпадают!'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

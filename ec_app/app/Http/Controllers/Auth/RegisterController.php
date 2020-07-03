<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/index';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],[
            'name.required' => '名前は必ず入力して下さい。',
            'name.string' => '名前は文字を入力して下さい。',
            'name.max' => '名前は255文字以内で入力して下さい。',
            'email.required' => 'メールアドレスは必ず入力して下さい。',
            'email.string' => 'メールアドレスは文字を入力して下さい。',
            'email.email' => 'メールアドレスを入力して下さい。',
            'email.max' => 'メールアドレスは255文字以内で入力して下さい。',
            'email.unique' => '登録済のメールアドレスです。',
            'password.required' => 'パスワードは必ず入力して下さい。',
            'password.string' => 'パスワードは文字を入力して下さい。',
            'password.min' => 'パスワードは6文字以上で入力して下さい。',
            'password.confirmed' => '同じパスワードを入力して下さい。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}

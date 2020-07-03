<?php

namespace App\Http\Controllers\Admin\Auth;

use App\User;
use App\Admin; //追加

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/admin/index';

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
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

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

     protected function guard()
     {
         return \Auth::guard('admin');
     }

}
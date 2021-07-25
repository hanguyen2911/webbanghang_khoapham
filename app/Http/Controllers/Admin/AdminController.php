<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getLogin()
    {
        return view('Admin.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')
        ->with(['flag'=>'warning','warning'=>'Bạn đã đăng xuất!']);;
    }

    public function postLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required|min:6',

            ],
            [
                'email.required' => 'Email không được để trống',
                'email.email' => 'Trường này phải là email',
                'password.required' => 'Password không được để trống',
                'password.min' => 'Mật khẩu phải lớn hơn 6 ký tự',
            ]
        );
        $auth = array('email' => $request->email, 'password' => $request->password);
        if (Auth::attempt($auth)) {
            return redirect()->route('order.list')->with(['flag' => 'success', 'notice' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'notice' => 'Đăng nhập không thành công! Kiểm tra lại tài khoản hoặc mật khẩu']);
        }
    }
    public function getAddProduct()
    {
        return view('Admin.products.product_add');
    }

    public function getEditProduct()
    {
        return view('Admin.products.product_edit');
    }

    public function getListProduct()
    {
        return view('Admin.products.product_list');
    }
}

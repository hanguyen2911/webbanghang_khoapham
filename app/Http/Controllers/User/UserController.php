<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('HomePage.login');
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
            'email.required'=>'Email không được để trống',
            'email.email'=>'Trường này phải là email',
            'password.required'=>'Password không được để trống',
            'password.min'=>'Mật khẩu phải lớn hơn 6 ký tự',
        ]
        );
        $auth=array('email'=>$request->email,'password'=>$request->password);
        if (Auth::attempt($auth)) {
            return redirect()->route('index')->with(['flag'=>'success','notice'=>'Đăng nhập thành công']);
        }else{
            return redirect()->back()->with(['flag'=>'danger','notice'=>'Đăng nhập không thành công! Kiểm tra lại tài khoản hoặc mật khẩu']);
        }
    }
    
    


    public function getSignup()
    {
        return view('HomePage.signup');
    }

    public function postSignup(Request $request)
    {

        $this->validate($request,
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'fullname' => 'required',
                'address' => 'required',
                're_password'=>'required|same:password'

            ],
            [
                'email.required'=>'Email không được để trống',
                'email.uniqued'=>'Email đã có người sử dụng',
                'email.email'=>'Trường này phải là email',
                'fullname.required'=>'Tên không được để trống',
                'address.required'=>'Địa chỉ không được để trống',
                'password.required'=>'Password không được để trống',
                're_password.required'=>'Vui lòng nhập lại mật khẩu một lần nữa',
                're_password.required'=>'Mật khẩu không trùng khớp',
                'password.min'=>'Mật khẩu phải lớn hơn 6 ký tự',
            ]
        );
        $user=new User();
        $user->full_name=$request->fullname;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->password=Hash::make($request->password);
        // dd( $user->password);
        $user->role=2;
        $user->save();
        // User::create($request->all());
        return redirect()->route('login')->with(['flag'=>'success','notice'=>'Đã tạo tài khoản thành công: Xin mời quý khách đăng nhập']);
    }
}

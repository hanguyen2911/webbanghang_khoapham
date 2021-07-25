<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout\Bill;
use App\Models\Checkout\Customer;
use App\Jobs\SendEmail;
use App\Mail\OrderConfirm;
use App\Mail\SendMail;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;





class OrderController extends Controller
{

    public function getListOrder()
    {
        $listOrder = Bill::all();
        $listCustomer = Customer::all();
        // dd($listOrder);
        return view('Admin.orders.list-order')
            ->with([
                'status' => 'Tất cả đơn hàng hiện có',
                'status_code' => 0,
                'listOrder' => $listOrder,
                'listCustomer' => $listCustomer
            ]);
    }

    public function waiting()
    {
        $listOrder = Bill::where('status', 'waiting')->get();
        $listCustomer = Customer::all();
        // dd($listOrder);
        return view('Admin.orders.list-order')
            ->with([
                'status' => 'Đơn hàng chờ xác nhận',
                'status_code' => 1,
                'listOrder' => $listOrder,
                'listCustomer' => $listCustomer
            ]);
    }


    public function confirmed()
    {
        $listOrder = Bill::where('status', 'confirmed')->get();
        $listCustomer = Customer::all();
        // dd($listOrder);
        return view('Admin.orders.list-order')
            ->with([
                'status' => 'Đơn hàng đã xác nhận',
                'status_code' => 2,
                'listOrder' => $listOrder,
                'listCustomer' => $listCustomer
            ]);
    }

    public function setConfirmed($id)
    {
        $order = Bill::find($id);
        $user = Customer::where('id', $order->id_customer)->first();
        $message = [
            'type' => 'Email thông báo ĐÃ ĐẶT HÀNG THÀNH CÔNG',
            'thanks' => 'Cảm ơn ' . $user->name . ' đã đặt hàng.',
            'id_bill' => $order->id,
            'content' => 'Admin đã xác nhận đơn hàng và giao hàng sớm nhất có thể. Liên hệ 0799101759 nếu bạn có bất kì vấn đề gì!',
        ];
        $status_mail = '';
        $mes_content = '';
        try {
            Mail::to($user->email)->send(new SendMail($message));
            $status_mail = 'success';
            $mes_content = 'Đã gửi mail xác nhận đơn hàng đến khách hàng ' . $user->name;
        } catch (\Throwable $th) {
            $status_mail = 'danger';
            $mes_content = 'Lỗi hệ thống: gửi mail thất bại!';
        }

        $order->status = 'confirmed';
        $order->save();
        // dd($listOrder);
        return redirect()->route('order.list')
            ->with(['flag' => 'success', 'notice' => $mes_content]);
    }


    public function delivering()
    {
        $listOrder = Bill::where('status', 'delivering')->get();
        $listCustomer = Customer::all();
        // dd($listOrder);
        return view('Admin.orders.list-order')
            ->with([
                'status' => 'Đơn hàng đang giao',
                'status_code' => 3,
                'listOrder' => $listOrder,
                'listCustomer' => $listCustomer
            ]);
    }

    public function setDelivering($id)
    {
        $order = Bill::find($id);
        $user = Customer::where('id', $order->id_customer)->first();
        $message = [
            'type' => 'Email thông báo ĐƠN HÀNG ĐANG GIAO',
            'thanks' => 'Cảm ơn ' . $user->name . ' đã đặt hàng.',
            'id_bill' => $order->id,
            'content' => 'Đơn hàng đang giao đến vị trí bạn cung cấp. Liên hệ 0799101759 nếu bạn có bất kì vấn đề gì!',
        ];
        $status_mail = '';
        $mes_content = '';
        try {
            Mail::to($user->email)->send(new SendMail($message));
            $status_mail = 'success';
            $mes_content = 'Đã gửi mail đơn hàng đang giao đến khách hàng ' . $user->name;
        } catch (\Throwable $th) {
            $status_mail = 'danger';
            $mes_content = 'Lỗi hệ thống: gửi mail thất bại!';
        }

        $order->status = 'delivering';
        $order->save();
        // dd($listOrder);
        return redirect()->route('order.list')
            ->with(['flag' => 'success', 'notice' => $mes_content]);
    }

    public function delivered()
    {
        $listOrder = Bill::where('status', 'delivered')->get();
        $listCustomer = Customer::all();
        // dd($listOrder);
        return view('Admin.orders.list-order')
            ->with([
                'status' => 'Đơn hàng đã giao',
                'status_code' => 4,
                'listOrder' => $listOrder,
                'listCustomer' => $listCustomer
            ]);
    }

    public function setDelivered($id)
    {
        $order = Bill::find($id);
        $user = Customer::where('id', $order->id_customer)->first();
        $message = [
            'type' => 'Email thông báo ĐƠN HÀNG ĐÃ ĐẾN NƠI',
            'thanks' => 'Cảm ơn ' . $user->name . ' đã đặt hàng.',
            'id_bill' => $order->id,
            'content' => 'Admin đã vận chuyển đơn hàng đến vị trí bạn cung cấp. Liên hệ 0799101759 nếu bạn có bất kì vấn đề gì!',
        ];
        $status_mail = '';
        $mes_content = '';
        try {
            Mail::to($user->email)->send(new SendMail($message));
            $status_mail = 'success';
            $mes_content = 'Đã gửi mail đơn hàng đã giao đến khách hàng ' . $user->name;
        } catch (\Throwable $th) {
            $status_mail = 'danger';
            $mes_content = 'Lỗi hệ thống: gửi mail thất bại!';
        }

        $order->status = 'delivered';
        $order->save();
        // dd($listOrder);
        return redirect()->route('order.list')
            ->with(['flag' => 'success', 'notice' => $mes_content]);
    }

    public function cancelled()
    {
        $listOrder = Bill::where('status', 'cancelled')->get();
        $listCustomer = Customer::all();
        // dd($listOrder);
        return view('Admin.orders.list-order')
            ->with([
                'status' => 'Đơn hàng bị hủy',
                'status_code' => 5,
                'listOrder' => $listOrder,
                'listCustomer' => $listCustomer
            ]);
    }
    public function setCancelled($id)
    {
        $order = Bill::find($id);
        $user = Customer::where('id', $order->id_customer)->first();
        $message = [
            'type' => 'Email thông báo ĐƠN HÀNG ĐÃ BỊ HỦY',
            'thanks' => 'Cảm ơn ' . $user->name . ' đã sử dụng dịch vụ.',
            'id_bill' => $order->id,
            'content' => 'Admin đã hủy đơn hàng của bạn. Liên hệ 0799101759 nếu bạn có bất kì vấn đề gì!',
        ];
        $status_mail = '';
        $mes_content = '';
        try {
            Mail::to($user->email)->send(new SendMail($message));
            $status_mail = 'success';
            $mes_content = 'Đã gửi mail đến khách hàng ' . $user->name;
        } catch (\Throwable $th) {
            $status_mail = 'danger';
            $mes_content = 'Lỗi hệ thống: gửi mail thất bại!';
        }

        $order->status = 'cancelled';
        $order->save();
        // dd($listOrder);
        return redirect()->route('order.list')
            ->with(['flag' => 'success', 'notice' => $mes_content]);
    }

    public function returnOrder($id)
    {
        // $order=$request->input('cancel');
        $order = Bill::find($id);
        // dd($order);
        $listOrder = Bill::where('status', 'cancelled');
        $listCustomer = Customer::all();
        $order->status = 'waiting';
        $order->save();
        // dd($listOrder);
        return redirect()->route('order.list');
    }
    public function  deleted($id)
    {
        // $order=$request->input('cancel');
        $order = Bill::find($id);
        // dd($order);
        $listOrder = Bill::where('status', 'cancelled');
        $listCustomer = Customer::all();
        $order->status = 'deleted';
        $order->save();
        // dd($listOrder);
        return redirect()->route('order.list');
    }
}

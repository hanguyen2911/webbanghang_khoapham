<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Checkout\Bill;
use App\Models\Checkout\BillDetail;
use App\Models\Checkout\Customer;
use App\Models\VNPAY\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VNpayController extends Controller
{

    public function createPayment(Request $request)
    {
        $cart = Session::get('cart');
        $vnp_TxnRef = $request->transaction_id; //Mã giao dịch. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_Amount = str_replace(',', '', $cart->totalPrice * 100);
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('VNP_TMNCODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay", "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_ReturnUrl" => route('vnpayReturn'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASHSECRECT')) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', env('VNP_HASHSECRECT') .
                $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' .
                $vnpSecureHash;
        }
        // dd($vnp_Url);
        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        if ($request->vnp_ResponseCode == '00') {
            $cart = Session::get('cart');
            $cus_data = null;

            $cus_data = Session::get('cus_data');
            //Lưu vào bảng customer
            $customer = new Customer();
            $customer->name = $cus_data['name'];
            $customer->gender =  $cus_data['gender'];
            $customer->email =  $cus_data['email'];
            $customer->address =  $cus_data['address'];
            $customer->phone_number =  $cus_data['phone_number'];

            if ($cus_data['notes'] !== null) {
                $customer->note = $cus_data['notes'];
            } else {
                $customer->note = "Không có ghi chú";
            }
            $customer->save();

            // dd($cus_data);
            //lay du lieu vnpay tra ve
            $vnpay_Data = $request->all();
            $payment = new Payment();
            $payment->order_id = $vnpay_Data['vnp_PayDate'];
            $payment->thanh_vien = $customer->name;
            $payment->money = $vnpay_Data['vnp_Amount'];
            $payment->note = $vnpay_Data['vnp_OrderInfo'];
            $payment->vnp_response_code = $vnpay_Data['vnp_ResponseCode'];
            $payment->code_vnpay = $vnpay_Data['vnp_TransactionNo'];
            $payment->code_bank = $vnpay_Data['vnp_BankCode'];
            $payment->time = date('Y-m-d');
            $payment->save();


            $bill = new Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = "VNPAY";
            if ($customer->notes !== null) {
                $bill->note = $cus_data->notes;
            } else {
                $bill->note = "Không có ghi chú";
            }
            $bill->status = "waiting";
            $bill->save();

            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail();
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = $value['price'] / $value['qty'];
                $bill_detail->save();
            }
            Session::forget('cart');
            return view('VNPAY/vnpay_return', compact('vnpay_Data'));
        }
    }
    public function getvnpay(Request $request)
    {
        $payment = Payment::all();
        return view('Admin.orders.payment', compact('payment'));
    }
}

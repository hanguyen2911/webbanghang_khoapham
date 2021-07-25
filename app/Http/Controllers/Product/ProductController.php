<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Checkout\Bill;
use App\Models\Checkout\BillDetail;
use App\Models\Checkout\Customer;
use App\Models\Product\Product;
use App\Models\Product\ProductType;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function index()
    {
        $slides = Slide::all();
        $newProduct = Product::where('new', 1)->paginate(4);
        $countNew = Product::where('new', 1)->get()->count();
        $countProduct = Product::all()->count();
        $products = Product::paginate(8);
        return view('HomePage.index', compact('slides', 'newProduct', 'countNew', 'products', 'countProduct'));
    }

    public function typeProduct($id)
    {
        $type = ProductType::find($id);
        $ProfType = Product::where('id_type', $id)->get();
        $ProfType = Product::where('id_type', $id)->get();
        $slNew = count($ProfType);
        return view('HomePage.type-product', compact('type', 'ProfType'));
    }

    //thêm 1 sản phẩm có id cụ thể vào model cart rồi lưu dữ liệu của model cart vào 1 session có tên cart (session được truy cập bằng thực thể Request)
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    //thêm 1 sản phẩm có số lượng >1 có id cụ thể vào model cart rồi lưu dữ liệu của model cart vào 1 session có tên cart (session được truy cập bằng thực thể Request)
    public function addManyToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addMany($product, $id, $request->qty);
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function delCart($id)
    {
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function checkout()
    {
        return view('HomePage.checkout');
    }

    public function postCheckout(Request $request)
    {
        if (Session::has('cart')) {
            if ($request->input('payment_method') != "VNPAY") {
                $cart = Session::get('cart');
                $customer = new Customer();
                $customer->name = $request->input('name');
                $customer->gender = $request->input('gender');
                $customer->email = $request->input('email');
                $customer->address = $request->input('address');
                $customer->phone_number = $request->input('phone_number');

                if ($request->input('notes') !== null) {
                    $customer->note = $request->input('notes');
                } else {
                    $customer->note = "Không có ghi chú";
                }

                $customer->save();

                $bill = new Bill();
                $bill->id_customer = $customer->id;
                $bill->date_order = date('Y-m-d');
                $bill->total = $cart->totalPrice;
                $bill->payment = $request->input('payment_method');
                $bill->note = $request->input('notes');
                if ($request->input('notes') !== null) {
                    $bill->note = $request->input('notes');
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
                return redirect()->back()->with('checkout-success', 'Đặt hàng thành công: Đơn hàng đang chờ xác nhận từ cửa hàng!');
            } else { //nếu thanh toán là vnpay
                $cart = Session::get('cart');
                $cus_data=$request->all();
                // Session::put('data_bill', $cus_data);
                session(['cus_data' => $cus_data]);
                // dd( $data_bill);
                return view('VNPAY/vnpay-index', compact('cart'));
                
            }
        } else {
            return redirect()->back()->with('checkout-error', 'Đặt hàng không thành công do bạn chưa có sản phẩm thanh toán');
        }
    }
    public function show($id)
    {
        $product = Product::find($id);
        return view('HomePage.detail', compact('product'));
    }
}

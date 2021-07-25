<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <base href="{{ asset('') }}">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/style.css">
    <link rel="stylesheet" href="assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
</head>

<body>

    @include('Header.header')
    <!-- #header -->
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đặt hàng</h6>
                <br>
                @if (Session::has('checkout-success'))
                    <div class="alert alert-success" role="alert">{{ Session::get('checkout-success') }}</div>
                @elseif(Session::has('checkout-error'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('checkout-error') }}</div>
                @endif
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{ route('index') }}">Trang chủ</a> / <span>Đặt hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">

            <form action="{{ route('postCheckout') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Đặt hàng</h4>
                        <div class="space20">&nbsp;</div>
                        @if (Auth::check())
                            {{ session(['user' => Auth::user()]) }}
                        @elseif(Session::has('user'))
                        {{ Session::forget('user') }}
                        @endif
                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" name="name" placeholder="Họ tên" value="{{ Session::has('user') ? Session::get('user')->full_name : '' }}"
                                required>
                        </div>
                        <div class="form-block">
                            <label>Giới tính </label>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nam"
                                checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nữ"
                                style="width: 10%"><span>Nữ</span>

                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" name="email"  placeholder="expample@gmail.com" value="{{ Session::has('user') ? Session::get('user')->email : '' }}" required>
                        </div>

                        <div class="form-block">
                            <label for="adress">Địa chỉ*</label>
                            <input type="text" name="address" placeholder="Street Address" value="{{ Session::has('user') ? Session::get('user')->address : '' }}" required>
                        </div>


                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" name="phone_number" value="{{ Session::has('user') ? Session::get('user')->phone : '' }}" required>
                        </div>

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea name="notes"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head">
                                <h5>Đơn hàng của bạn</h5>
                            </div>
                            @if (Session::has('cart'))
                                <div class="your-order-body" style="padding: 0px 10px">
                                    <div class="your-order-item">
                                        <div>
                                            @foreach ($productCarts as $product)
                                                <!--  one item	 -->
                                                <div class="media">
                                                    <img width="25%"
                                                        src="image/product/{{ $product['item']['image'] }}" alt=""
                                                        class="pull-left">
                                                    <div class="media-body">
                                                        <p class="font-large">{{ $product['item']['name'] }}</p>
                                                        <span class="color-gray your-order-info">Giá Gốc:
                                                            {{ number_format($product['item']['unit_price']) }}
                                                            VNĐ</span>
                                                        <span class="color-gray your-order-info">Giá Khuyến Mãi:
                                                            @if ($product['item']['promotion_price'] == 0)
                                                                <span class="color-gray your-order-info">Sản phẩm này
                                                                    không khuyến mãi </span>
                                                            @else
                                                                {{ number_format($product['item']['promotion_price']) }}
                                                            @endif VNĐ
                                                        </span>
                                                        <span class="color-gray your-order-info">Số lượng:
                                                            {{ $product['qty'] }}</span>
                                                    </div>
                                                </div>
                                                <!-- end one item -->
                                            @endforeach
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="your-order-item">
                                        <div class="pull-left">
                                            <p class="your-order-f18">Tổng tiền:</p>
                                        </div>
                                        <div class="pull-right">
                                            <h5 class="color-black">{{ number_format($cart->totalPrice) }} VNĐ</h5>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            @else
                                <br>
                                <div class="alert alert-danger" role="alert">
                                    Hiện tại chưa có sản phẩm nào trong giỏ hàng <br>
                                    Bạn có thể mua thêm sản phẩm <a href="{{ route('index') }}">tại đây!</a>
                                </div>
                            @endif
                            <div class="your-order-head">
                                <h5>Hình thức thanh toán</h5>
                            </div>

                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio"
                                            name="payment_method" value="COD" checked="checked"
                                            data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                            Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền
                                            cho nhân viên giao hàng
                                        </div>
                                    </li>

                                    <li class="payment_method_cheque">
                                        <input id="payment_method_cheque" type="radio" class="input-radio"
                                            name="payment_method" value="ATM" data-order_button_text="">
                                        <label for="payment_method_cheque">Chuyển khoản </label>
                                        <div class="payment_box payment_method_cheque" style="display: none;">
                                            Chuyển tiền đến tài khoản sau:
                                            <br>- Số tài khoản: 123 456 789
                                            <br>- Chủ TK: Phạm Anh Tuấn
                                            <br>- Ngân hàng ACB, Chi nhánh Đà Nẵng
                                        </div>
                                    </li>

                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio"
                                            name="payment_method" value="VNPAY" data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán online qua VNPAY </label>
                                    </li>

                                </ul>
                            </div>

                            <div class="text-center"><button class="beta-btn primary" type="submit">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
                        </div> <!-- .your-order -->
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

    @include('Footer.footer')


    <!-- include js files -->
    <script src="assets/dest/js/jquery.js"></script>
    <script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="assets/dest/vendors/animo/Animo.js"></script>
    <script src="assets/dest/vendors/dug/dug.js"></script>
    <script src="assets/dest/js/scripts.min.js"></script>
    <!--customjs-->
    <script type="text/javascript">
        $(function() {
            // this will get the full URL at the address bar
            var url = window.location.href;

            // passes on every "a" tag
            $(".main-menu a").each(function() {
                // checks if its the same on the address bar
                if (url == (this.href)) {
                    $(this).closest("li").addClass("active");
                    $(this).parents('li').addClass('parent-active');
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            'use strict';

            // color box

            //color
            jQuery('#style-selector').animate({
                left: '-213px'
            });

            jQuery('#style-selector a.close').click(function(e) {
                e.preventDefault();
                var div = jQuery('#style-selector');
                if (div.css('left') === '-213px') {
                    jQuery('#style-selector').animate({
                        left: '0'
                    });
                    jQuery(this).removeClass('icon-angle-left');
                    jQuery(this).addClass('icon-angle-right');
                } else {
                    jQuery('#style-selector').animate({
                        left: '-213px'
                    });
                    jQuery(this).removeClass('icon-angle-right');
                    jQuery(this).addClass('icon-angle-left');
                }
            });
        });
    </script>
</body>

</html>

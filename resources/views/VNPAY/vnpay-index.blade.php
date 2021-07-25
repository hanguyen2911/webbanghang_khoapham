<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <base href="{{ asset('') }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/vnpay-assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="assets/vnpay-assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="assets/vnpay-assets/jquery-1.11.3.min.js"></script>
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
    <div class="container">
        <div class="header clearfix">
            <h3>Thanh toán đơn hàng thông qua VNPAY</h3>
        </div>
        
        @if (Session::has('cart'))
        <div class="table-responsive col-md-8">
            <form action="{{ route('postCreatePayment') }}" id="create_form" method="post">
                @csrf
                <div class="form-group">
                    <label for="transaction_id">Mã giao dịch</label>
                    <input class="form-control" id="transaction_id" name="transaction_id" type="text"
                        value="<?php echo date('YmdHis'); ?>" />
                </div>
                <div class="form-group">
                    <label for="amount">Số tiền (VNĐ)</label>
                    <input class="form-control" id="amount" name="amount" type="number"
                        value="{{ $cart->totalPrice }}" />
                </div>
                <div class="form-group">
                    <label for="order_desc">Nội dung thanh toán</label>
                    <textarea class="form-control" cols="20" id="order_desc" name="order_desc"
                        rows="2">Thanh toán sản phẩm từ cửa hàng </textarea>
                </div>
                <div class="form-group">
                    <label for="bank_code">Ngân hàng</label>
                    <select name="bank_code" id="bank_code" class="form-control" required>
                        <option value="">Không chọn</option>
                        <option value="NCB" selected> Ngân Hàng NCB</option>
                        <option value="AGRIBANK"> Ngân Hàng Agribank</option>
                        <option value="SCB"> Ngân Hàng SCB</option>
                        <option value="SACOMBANK">Ngân Hàng SacomBank</option>
                        <option value="EXIMBANK"> Ngân Hàng EximBank</option>
                        <option value="MSBANK"> Ngân Hàng MSBANK</option>
                        <option value="NAMABANK"> Ngân Hàng NamABank</option>
                        <option value="VNMART"> Ví điện tử VnMart</option>
                        <option value="VIETINBANK">Ngân Hàng Vietinbank</option>
                        <option value="VIETCOMBANK"> Ngân Hàng VCB</option>
                        <option value="HDBANK">Ngân Hàng HDBank</option>
                        <option value="DONGABANK"> Ngân Hàng Dong A</option>
                        <option value="TPBANK"> Ngân hàng TPBank</option>
                        <option value="OJB"> Ngân hàng OceanBank</option>
                        <option value="BIDV"> Ngân hàng BIDV</option>
                        <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                        <option value="VPBANK"> Ngân Hàng VPBank</option>
                        <option value="MBBANK"> Ngân Hàng MBBank</option>
                        <option value="ACB"> Ngân Hàng ACB</option>
                        <option value="OCB"> Ngân Hàng OCB</option>
                        <option value="IVB"> Ngân Hàng IVB</option>
                        <option value="VISA"> Thanh toán qua VISA/MASTER</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="language">Ngôn ngữ</label>
                    <select name="language" id="language" class="form-control">
                        <option value="vn" selected>Tiếng Việt</option>
                        <option value="en">English</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" >Xác nhận thanh toán</button>
                <a href="#" class="btn btn-default" role="button">Quay lại</a>
                <p>
                    &nbsp;
                </p>
            </form>
        </div>
        <p>
            &nbsp;
        </p>
        @else 
        <h4 class="alert alert-danger"> Hiện tại không tìm thấy đơn hàng</h4>
        <p>
            &nbsp;
        </p>
        @endif
    </div>

@include('Footer.footer')
{{-- VNpay Js --}}
<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet" />
<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>

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

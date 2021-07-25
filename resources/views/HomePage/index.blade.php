<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page </title>
    <base href="{{ asset('') }}">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/style.css">
    <link rel="stylesheet" href="assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
</head>

<body>

    @include('Header.header')
    <!-- #header -->
    <div class="rev-slider">
        <div class="fullwidthbanner-container">
            <div class="fullwidthbanner">
                <br>
                @if (session('flag'))
                    @if (session('warning'))
                    <div class="alert alert-{{ Session::get('flag') }}" style="text-align: center" role="alert">
                      {{ Session::get('warning') }}
                    </div>
                    @else
                    <div class="alert alert-{{ Session::get('flag') }}" style="text-align: center" role="alert">
                        {{ Session::get('notice') }}
                    </div>
                    @endif
                @endif
                <br>
                <div class="bannercontainer">
                    <div class="banner">
                        <ul>
                            @foreach ($slides as $slide)
                                <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                    style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                    <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined"
                                        data-zoomstart="undefined" data-zoomend="undefined"
                                        data-rotationstart="undefined" data-rotationend="undefined"
                                        data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined"
                                        data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined"
                                        data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                                        <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover"
                                            data-bgposition="center center" data-bgrepeat="no-repeat"
                                            data-lazydone="undefined" src="image/slide/{{ $slide->image }}"
                                            data-src="image/slide/{{ $slide->image }}"
                                            style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('image/slide/{{ $slide->image }}');
        background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                        </div>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="tp-bannertimer"></div>
            </div>
        </div>
        <!--slider-->
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>New Products</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">
                                    {{ $countNew }}
                                    styles found</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach ($newProduct as $item)
                                    <div class="col-sm-3">
                                        <div class="single-item" style="padding-bottom: 20px">
                                            @if ($item->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">

                                                <a href="{{ route('detail-product', $item->id) }}"><img
                                                        style="width: 270px; height: 320px;"
                                                        src="image/product/{{ $item->image }}" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $item->name }}</p>
                                                <p class="single-item-price">


                                                    @if ($item->promotion_price == 0)
                                                        <span>{{ number_format($item->unit_price) }} VNĐ</span>
                                                    @else
                                                        <span
                                                            class="flash-del">{{ number_format($item->unit_price) }}
                                                            VNĐ</span>
                                                        <span
                                                            class="flash-sale">{{ number_format($item->promotion_price) }}
                                                            VNĐ</span>
                                                    @endif


                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('addtocart', $item->id) }}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary"
                                                    href="{{ route('detail-product', $item->id) }}">Details <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <div class="row">{{ $newProduct->links('pagination::bootstrap-4') }}</div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Top Products</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">{{ $countProduct }} styles found</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach ($products as $item)
                                    <div class="col-sm-3">
                                        <div class="single-item" style="padding-bottom: 20px">
                                            @if ($item->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{ route('detail-product', $item->id) }}"><img
                                                        style="width: 270px; height: 320px;"
                                                        src="image/product/{{ $item->image }}" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $item->name }}</p>
                                                <p class="single-item-price">

                                                    @if ($item->promotion_price == 0)
                                                        <span>{{ number_format($item->unit_price) }} VNĐ</span>
                                                    @else
                                                        <span class="flash-del">{{ number_format($item->unit_price) }}
                                                            VNĐ</span>
                                                        <span
                                                            class="flash-sale">{{ number_format($item->promotion_price) }}
                                                            VNĐ</span>
                                                    @endif


                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('addtocart', $item->id) }}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary"
                                                    href="{{ route('detail-product', $item->id) }}">Details <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <div class="row">{{ $products->links('pagination::bootstrap-4') }}</div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->

    @include('Footer.footer')
    <!-- #footer	 -->


    <!-- include js files -->
    <script src="assets/dest/js/jquery.js"></script>
    <script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="assets/dest/vendors/animo/Animo.js"></script>
    <script src="assets/dest/vendors/dug/dug.js"></script>
    <script src="assets/dest/js/scripts.min.js"></script>
    <script src="assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="assets/dest/js/waypoints.min.js"></script>
    <script src="assets/dest/js/wow.min.js"></script>
    <!--customjs-->
    <script src="assets/dest/js/custom2.js"></script>
    <script>
        $(document).ready(function($) {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 150) {
                    $(".header-bottom").addClass('fixNav')
                } else {
                    $(".header-bottom").removeClass('fixNav')
                }
            })
        })
    </script>
</body>

</html>

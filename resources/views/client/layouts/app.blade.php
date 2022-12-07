<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Shop')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('client/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('client/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <!-- with v4.1.0 Krajee SVG theme is used as default (and must be loaded as below) - include any of the other theme CSS files as mentioned below (and change the theme property of the plugin) -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css"
        media="all" rel="stylesheet" type="text/css" />

</head>

<body>
    <x-guest-layout>

        <!-- Topbar Start -->
        <div class="container-fluid">
            <div class="row bg-secondary py-2 px-xl-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="d-inline-flex align-items-center">
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark px-2" href="https://www.facebook.com/ngvhoangnguyen/" target="blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="https://www.instagram.com/nguyen_nvh/" target="blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-dark pl-2" href="https://youtu.be/x5MJwQ5A0oc" target="blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center py-3 px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a href="{{ route('client.home') }}" class="text-decoration-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">Guitar</span>Store</h1>
                    </a>
                </div>
                <div class="col-lg-6 col-6 text-left">
                    <form action="{{ route('client.search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="keywords_submit" class="form-control"
                                placeholder="Search for products">
                            <div class="input-group-append">
                                <button class="input-group-text bg-transparent text-primary">
                                    <i class="fa fa-search" type="submit"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-6 text-right">

                    <a href="{{ route('client.carts.index') }}" class="btn border">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge" id="productCountCart">{{ $countProductInCart }}</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Topbar End -->


        <!-- Navbar Start -->
        <div class="container-fluid mb-5">
            <div class="row border-top px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                        data-toggle="collapse" href="#navbar-vertical"
                        style="height: 65px; margin-top: -1px; padding: 0 30px;">
                        <h6 class="m-0">Categories</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                        id="navbar-vertical">
                        <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">

                            @foreach ($categories as $item)
                                @if ($item->children->count() > 0)
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link" data-toggle="dropdown">{{ $item->name }} <i
                                                class="fa fa-angle-down float-right mt-1"></i></a>
                                        <div
                                            class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">

                                            @foreach ($item->children as $childCategory)
                                                <a href="{{ route('client.products.index', ['category_id' => $childCategory->id]) }}"
                                                    class="dropdown-item">{{ $childCategory->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('client.products.index', ['category_id' => $item->id]) }}"
                                        class="dropdown-item">{{ $item->name }}</a>
                                @endif
                            @endforeach

                        </div>
                    </nav>
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                        <a href="" class="text-decoration-none d-block d-lg-none">
                            <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                    class="text-primary font-weight-bold border px-3 mr-1">Guitar</span>Store</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="{{ route('client.home') }}" class="nav-item nav-link {{ request()->routeIs('client.home') ? 'active' : '' }}">Home</a>
                                <a href="{{ route('client.shop') }}" class="nav-item nav-link {{ request()->routeIs('client.shop') ? 'active' : '' }} ">Shop</a>
                                <a href="{{ route('client.orders.index') }}" class="nav-link {{ request()->routeIs('client.orders.index') ? 'active' : '' }}">Order</a>
                                <a href="{{ route('client.policy') }}" class="nav-link {{ request()->routeIs('client.policy') ? 'active' : '' }}">Policy</a>
                                @can('list-order')
                                    <a href="{{ route('dashboard') }}" class=" nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"> Management</a>
                                @endcan
                            </div>
                            @if (auth()->check())
                                @if (auth()->user()->email_verified_at == null)
                                <div class="navbar-nav mr-auto py-0">
                                    <h5>Hi! {{ auth()->user()->name }} - verify please!</h5>
                                </div>
                                @else
                                <div class="navbar-nav mr-auto py-0">
                                    <h5>Hi! {{ auth()->user()->name }} ✓</h5>
                                </div>
                                @endif
                            @else
                            @endif
                            <div class="navbar-nav ml-auto py-0">
                                @if (auth()->check())
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                                    <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                                @endif



                            </div>
                        </div>
                    </nav>

                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Navbar End -->



        <!-- Footer Start -->
        @include('client.layouts.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        {{-- <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a> --}}

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js"
            type="text/javascript"></script>

        <!-- with v4.1.0 Krajee SVG theme is used as default (and must be loaded as below) - include any of the other theme JS files as mentioned below (and change the theme property of the plugin) -->
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>

        <!-- optionally if you need translation for your language then include locale file as mentioned below (replace LANG.js with your own locale file) -->
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js"></script>

        <script src="{{ asset('client/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('client/lib/owlcarousel/owl.carousel.min.js') }}"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="{{ asset('client/mail/contact.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
            integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('client/js/main.js') }}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <!-- Rasa chatbot -->

        <div data-initial-payload="hi" data-root-element-id="storybook-preview-wrapper"
            data-websocket-url="http://localhost:5005/" id="rasa-chat-widget">

            <script src="https://unpkg.com/@rasahq/rasa-chat" type="application/javascript"></script>


            {{-- <script>!(function () {
            let e = document.createElement("script"),
              t = document.head || document.getElementsByTagName("head")[0];
            (e.src =
              "https://cdn.jsdelivr.net/npm/rasa-webchat@1.x.x/lib/index.js"),
              // Replace 1.x.x with the version that you want
              (e.async = !0),
              (e.onload = () => {
                window.WebChat.default(
                  {
                    initPayload: 'hi',
                    title: 'GuitarStore Support',
                    showFullScreenButton: 'true',
                    customData: { language: "vn" },
                    socketUrl: "http://localhost:5005/",
                    // add other props here
                  },
                  null
                );
              }),
              t.insertBefore(e, t.firstChild);
          })();
          </script> --}}
            <!-- Rasa chatbot end -->
            <script src="{{ asset('admin/assets/base/base.js') }}"></script>
          

            @yield('script')
    </x-guest-layout>
</body>

</html>

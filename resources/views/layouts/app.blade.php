<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href='https://fonts.googleapis.com/css?family=Lobster+Two:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,300,700' rel='stylesheet'
          type='text/css'/>

    <!--MOBILE DEVICE-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!--CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/css/responsive.css"/>

    <!--JS-->

    <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/js/modernizr.js"></script>
    <script src="/js/scripts.js"></script>
    <script src="/js/waypoints.min.js"></script>

    {{--  Google Map  --}}
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBONW71DuoGwIiOdVXkXHEWwo9mMMVmCIw&libraries=places,geometry"></script>

    {{--  Stripe --}}
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div id="app">
    <header>
        <div class="container">
            <div class="row" id="home">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="logo">
                        <h1><a href="#"><img class="w-25" src="/images/TMPS000136.png" alt=""/></a></h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="contact">
                        <p>Questions? Call us Toll-free!<span class="number"><a href="#">1800-0000-7777</a></span><span
                                class="time">(11AM to 11PM)</span></p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="saction1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="menu">
                        <div class="mobile-nav-container"></div>
                        <div class="mobile-nav-btn"><img class="nav-open"
                                                         src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/6214/nav-open.png"
                                                         alt="Nav Button Open"/> <img class="nav-close"
                                                                                      src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/6214/nav-close.png"
                                                                                      alt="Nav Button Close"/></div>
                        <nav>
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>
                                    <a href="{{ route("basket.index") }}">Basket
                                        @if(Auth::guest())
                                            <badge-icon :basket-count="''"/>
                                        @else
                                            <badge-icon :basket-count="{{ auth::user()->basket->sum('qty') ?? '' }}"/>
                                            <badge-icon :basket-count="{{ auth::user()->basket->sum('qty') ?? '' }}"/>
                                        @endif
                                    </a>

                                </li>
                                <li><a href="#offer">Order </a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="login">
                        <ul>
                            @if(Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                            <li><a href="account">Hi {{ Auth::user()->email }}</a></li>
                            @endif
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @yield('content')
    <footer class="saction8">
        <div class="container" id="contact">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="site">
                        <h3>Site Link</h3>
                    </div>
                    <div class="sitelink">
                        <ul>
                            <li><span>&#10152;</span><a href="#">About Us</a></li>
                            <li><span>&#10152;</span><a href="#">Contact Us</a></li>
                            <li><span>&#10152;</span><a href="#">Privacy Policy</a></li>
                            <li><span>&#10152;</span><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="site">
                        <h3>Site Link</h3>
                    </div>
                    <div class="sitelink">
                        <ul>
                            <li><span>&#10152;</span><a href="#">About Us</a></li>
                            <li><span>&#10152;</span><a href="#">Contact Us</a></li>
                            <li><span>&#10152;</span><a href="#">Privacy Policy</a></li>
                            <li><span>&#10152;</span><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="follow">
                        <h3>Follow Us On...</h3>
                    </div>
                    <div class="social">
                        <ul>
                            <li><i class="fa fa-facebook-square"></i><a href="#">Facebook</a></li>
                            <li><i class="fa fa-twitter-square"></i><a href="#">Twitter</a></li>
                            <li><i class="fa fa-linkedin-square"></i><a href="#">Linkedin</a></li>
                            <li><i class="fa fa-google-plus-square"></i><a href="#">Google Plus</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="submit">
                        <h3>Subscribe Newsletter</h3>
                        <p>To get latest updates and food deals
                            every week</p>
                    </div>
                    <div class="submitbox">
                        <input type="text"/>
                        <div class="sub"><a href="#">Submit</a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <footer class="saction9">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="email">&copy; All right reserved 2014 / FoodFinder</div>
                    <p class="freetemplates">Free Template by <a href="http://freetemplates.pro/">FreeTemplates.pro</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ url('css/frontend/theme.css') }}" rel="stylesheet">
        <link href="{{ url('css/frontend/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ url('css/frontend/bootstrap.js') }}" rel="stylesheet">
        {{-- <link href="{{ url('js/js.js') }}" rel="stylesheet"> --}}
        {{-- <link href="{{ url('js/jquery-3.6.0.min.js') }}" rel="stylesheet"> --}}

        <link href="{{ url('css/frontend/qr.css') }}" rel="stylesheet">
        <link href="{{ url('css/frontend/generator.css') }}" rel="stylesheet">
    </head>
    <body>    
        <header>
            <div class="container">
                <div class="logo">
                    <a href="#">
                        <h1 class="">
                            <img src="/uploads/{{ $logo[0]->thumbnail }}" width="200px">
                        </h1>
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="/">HOME</a>
                    </li>
                    <li>
                        <a href="/shop">SHOP</a>
                    </li>
                    <li>
                        <a href="/news">News</a>
                    </li>
                    <li>
                        <a href="/generate">Generator</a>
                    </li>
                    <li>
                        <a href="/signin">LOGIN</a>
                    </li>
                </ul>
                <div class="search">
                    <form action="/search" method="get">
                        <input type="text" name="search" class="box" placeholder="SEARCH HERE">
                        <button>
                            <div style="background-image: url(uploads/search.png);
                                    width: 28px;
                                    height: 28px;
                                    background-position: center;
                                    background-size: contain;
                                    background-repeat: no-repeat;
                                ">
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </header>
        @yield('content')
        @yield('js')
        <footer>
            <span>
                AllRight Recieved @ 2024
            </span>
        </footer>

    </body>
    <script src="{{ url('css/frontend/bootstrap.js') }}"></script>
</html>



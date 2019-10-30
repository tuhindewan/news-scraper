<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web Scraper</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <style>
        .glyphicon.fast-right-spinner {
            -webkit-animation: glyphicon-spin-r 1s infinite linear;
            animation: glyphicon-spin-r 1s infinite linear;
        }

        @-webkit-keyframes glyphicon-spin-r {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }

        @keyframes glyphicon-spin-r {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}">News Scraper</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Dashboard
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('dashboard/websites') }}">Websites</a></li>
                                <li><a href="{{ url('dashboard/categories') }}">Categories</a></li>
                                <li><a href="{{ url('dashboard/links') }}">Links</a></li>
                                <li><a href="{{ url('dashboard/item-schema') }}">Item Schema</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('dashboard/articles') }}">Articles</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        @yield('content')
    </div>
</div>

@yield('script')
</body>
</html>

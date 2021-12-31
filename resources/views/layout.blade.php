<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("page-title")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <style>
        .thumbnail-img{
            height: 50px;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Twitch Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-game-streams')" aria-current="page" href="/">Game Streams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-top-games')" aria-current="page" href="{{route('top-games')}}">Top Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-median-streams')" aria-current="page" href="{{route('median-for-all-streams')}}">Median For Streams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-top-100-streams')" aria-current="page" href="{{route('top100-streams')}}">Top 100 Streams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-streams-by-hour')" aria-current="page" href="{{route('streams-by-hour')}}">Streams By Hour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-user-streams')" aria-current="page" href="{{route('user-streams')}}">User Streams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-user-distance-to-top')" aria-current="page" href="{{route('user-distance-to-top')}}">User Distance To Top</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-shared-tags')" aria-current="page" href="{{route('shared-tags')}}">Shared Tags</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {!!Auth::user()->name!!}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="container">
        @yield('content')
    </div>
</main>
</body>
</html>

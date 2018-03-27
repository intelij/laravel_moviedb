<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{route('home')}}">
        <img src="{{asset('storage/images/brand/logo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
        The movie databse
    </a>
    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="/user/{{ auth()->id() }}">Welcome, {{auth()->user()->name}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            @else
                    <li class="nav-item">
                        <a class="nav-link" href="https://moviesdb.oo/login/twitter"><i class="fab fa-twitter"></i></a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://moviesdb.oo/login/facebook"><i class="fab fa-facebook-square"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

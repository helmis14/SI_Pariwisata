<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{url('frontend')}}/images/logo.png" alt="" />
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto mr-3">
                @auth
                <?php if (auth()->user()->roles == 'User') { ?>
                    <li class="nav-item mx-md-2">
                        <a class="nav-link active" href="{{url('/user/dashboard')}}">Dashboard</a>
                    </li>
                <?php } ?>
                @endauth
                <li class="nav-item mx-md-2">
                    <a class="nav-link" href="{{ route('Pengunjung.home') }}">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a class="nav-link" href="{{ route('Pengunjung.tiket') }}">Tiket</a>
                </li>

                <li class="nav-item mx-md-2">
                    <a class="nav-link" href="#">Profile</a>
                </li>
            </ul>
            @guest
            <!-- Mobile button -->
            <form action="{{url('login')}}" class="form-inline d-sm-block d-md-none">
                <button class="btn btn-login my-2 my-sm-0" type="button" onclick="event.preventDefault(); location.href='{{url('login')}}';">
                    Masuk
                </button>
            </form>
            <!-- Desktop Button -->
            <form action="{{url('login')}}" class="form-inline my-2 my-lg-0 d-none d-md-block">
                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{url('login')}}';">
                    Masuk
                </button>
            </form>
            @endguest

            @auth
            <!-- Mobile button -->
            <form action="{{route('logout')}}" method="post" class="form-inline d-sm-block d-md-none">
                @csrf
                <button class="btn btn-login my-2 my-sm-0" type="submit">
                    Logout
                </button>
            </form>
            <!-- Desktop Button -->
            <form action="{{route('logout')}}" method="post" class="form-inline my-2 my-lg-0 d-none d-md-block">
                @csrf
                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </nav>
</div>
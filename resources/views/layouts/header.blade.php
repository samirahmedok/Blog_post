 <head>
    <title> @yield('title') </title>
 </head>
 <!-- Responsive navbar-->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="up">
    <div class="container">
        <a class="navbar-brand" href="#!" style="text-transform: capitalize;color:#e3ff5b">
            @if (Auth::check())
            {{Auth::user()->name}}
            @else
            username
            @endif
            
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 tabs">
                {{-- <li class="nav-item"><a class="nav-link" href="home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about">About</a></li> --}}
                <li class="nav-item"><a class="nav-link" href="contact">Contact</a></li>
                <li class="nav-item active"><a class="nav-link" aria-current="page" href="{{route('posts')}}">Blog-Posts</a></li>

                @if(Auth::check())
                <li class="nav-item">
                    
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            
                </li>
                @else
                <li class="nav-item"><a class="nav-link" href="register">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
//     $(document).ready(function() {

//    //On Click Event
//    $("ul.tabs li:first").addClass("active").show();
//    $("ul.tabs li").click(function() {
//       $("ul.tabs li").removeClass("active"); //Remove any "active" class
//       $(this).addClass("active"); //Add "active" class to selected tab
//    });

// });
</script>
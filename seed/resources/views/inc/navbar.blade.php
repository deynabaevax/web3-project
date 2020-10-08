<div class="container-nav">
  <nav class="navbar mx-auto navbar-expand-lg" style="background-color: #e1e1f5">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
      aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler" >
      <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" style="color:black" href="/" >Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:black" href="/posts">Posts</a>
          </li>
          <li class="nav-item">
             </a class="nav-link"><img src="https://www.freelogodesign.org/file/app/client/thumb/5537cd98-7f35-465d-a3bc-01c6ef693bbb_200x200.png?1589888348896" height="50" width="50" alt="">
          </li>
          </a>
        {{-- <li class="nav-item">
          <a class="nav-link" style="color:black" href="/about">About me</a>
        </li> --}}
        @guest
          <li class="nav-item">
              <a class="nav-link" style="color:black" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" style="color:black" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
          @else
          <li class="nav-item">
            <a class="nav-link" style="color:black" href="/profile/{{Auth::user()->id}}">{{ Auth::user()->name }}</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" style="color:black" href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
          </li>

          {{-- <div class="dropdown">
            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
              <div class="dropdown-menu" role="menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </div> --}}
        @endguest
      </ul>
      <div class="search">
      <form class="search-box" type="get" action="{{ url('/search')}}">
          <input type="search" name="query" class="searchbox_input">
          <i class="fa fa-search"></i>
        </form>
      </div>
    </div>
  </nav>
</div>

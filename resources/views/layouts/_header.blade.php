<nav class="navbar navbar-default nacbar-static-top">
    <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
           <span class="sr-only" >Toggle Navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
       <!-- branding Image -->
       <a class="navbar-brand" href="{{url('/')}}">
         LaraBBS
       </a>
      </div>
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Od Navbar -->
            <ul class="nav navbar-nav">

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li> <a href="{{route('login')}}"> 登录</a></li>
                <li> <a href="{{route('register')}}"> 注册</a></li>
                @else
                <li class="dropdown">
                  <a href="#" class="dropdown"data-toggle="dropdown" role="button" >
                    <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                      <img style="width:44px; height:44px;border-radius: 50%" src="https://dn-phphub.qbox.me/uploads/avatars/11914_1510813749.jpg?imageView2/1/w/100/h/100" alt="">
                    </span>
                    {{Auth::user()->name}}<span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="meun">
                    <li>
                          <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit()">
                          退出登录
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                    </li>
                  </ul>
                </li>
              @endguest
            </ul>
      </div>
    </div>
</nav>

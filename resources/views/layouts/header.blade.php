<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @guest()
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">Login</a>
                  </li>
                  <li class="nav-item">
                  </li>
                  @else
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('User_profile/' .Auth::user()->profile_image)}}" class="user-image" alt="User Image">
              <span class="hidden-xs"> {{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <img src="{{asset('User_profile/' .Auth::user()->profile_image)}}" class="user-image" alt="User Image"><br>

                <p>
                   {{Auth::user()->name}}
                  <small>Member since Nov. 2012</small>
                  </p>
              </li>
              <!-- Menu Body -->


              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a class="dropdown-item" href="{{ url('logoutadmin') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                         Logout
                                      </a>

                                      <form id="logout-form" action="{{ url('logoutadmin  ') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          @endguest
        </ul>
      </div>
    </nav>
  </header>

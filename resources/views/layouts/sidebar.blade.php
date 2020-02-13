<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="navbar-header">
      <a class="navbar-brand" href="{{ url('/') }}">EmpowerU</a>
  </div>

  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
  </button>

  <ul class="nav navbar-right navbar-top-links">
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-user fa-fw"></i> <strong>Welcome - {{Auth::user()->first_name}} </strong> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu dropdown-user">
              <li><a href="{{route('user-profile.edit', ['id' => Auth::id()])}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
              </li>
              <li class="divider"></li>
              <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out fa-fw"></i>
                      Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>
          </ul>
      </li>
  </ul>

  <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
            <li>
                <a href="{{route('validateAuth')}}" class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <i class="fa fa-dashboard fa-fw"></i> 
                    Dashboard
                </a>
            </li>

            {{-- applications --}}
            <li>
                <a href="{{route('applicants.index')}}"
                    class="{{ Request::is('applicants*') ? 'active' : '' }}">
                    <i class="fa fa-table fa-fw"></i> Applicants
                </a>
            </li>

            <!-- user profile -->
            <li>
                <a href="{{route('user-profile.edit', ['id' => Auth::id()])}}" 
                    class="{{ Request::is('user-profile*') ? 'active' : '' }}">
                    <i class="fa fa-edit fa-fw"></i>
                    User Profile
                </a>
            </li>

            {{-- manage users --}}
            <li>
                <a href="{{ route('users.index') }}" 
                    class="{{ Request::is('users*') ? 'active' : '' }}">
                    <i class="fa fa-edit fa-fw"></i>
                    Manage Users
                </a>
            </li>

            {{-- manage positions --}}
            <li>
                <a href="{{ route('positions.index') }}" 
                    class="{{ Request::is('positions*') ? 'active' : '' }}">
                    <i class="fa fa-list fa-fw"></i>
                    Manage Positions
                </a>
            </li>

            {{-- reports --}}
            <li>
              <a href="{{route('reports.index')}}"><i class="fa fa-file fa-fw"></i>Reports</a>
            </li>
          </ul>
      </div>
  </div>
</nav>
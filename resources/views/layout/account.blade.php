<div id="top-header">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="th-text pull-right">
          <div class="th-item">
            <div class="btn-group">
              @guest
              <button class="btn btn-default btn-xs dropdown-toggle js-activated" type="button" data-toggle="dropdown"> Account <span class="caret"></span> </button>
              <ul class="dropdown-menu">
                <li> <a href="{{ route('login') }}">Login</a> </li>
                <li> <a href="{{ route('register') }}">Register</a> </li>
              </ul>
              @else
              <button class="btn btn-default btn-xs dropdown-toggle js-activated" type="button" data-toggle="dropdown">Welcome {{ Auth::user()->name }}<span class="caret"></span> </button>
              <ul class="dropdown-menu">
                <li> <a href="usercp.php">User CP</a> </li>
                <li> <a href="{{ route('logout') }}">Logout</a> </li>
              </ul>
              @endguest



            </div>
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>
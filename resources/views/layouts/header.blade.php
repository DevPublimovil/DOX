<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('home')}}" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>
  </ul>

  <div class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" v-model="empleado" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="navbar-nav ml-auto">
    <li class="nav-item dropdown" id="logout">
      <a  class="nav-link dropdown-toggle d-none d-md-block" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="user-name">
        <img src="{{ asset('storage/'.Auth::user()->avatar) }}" class="img-circle profile-img img-hidden"  style="width:35px;height:30px;" alt="user profile"> <span class="name-user">{{ Auth::user()->name }}</span>   <span class="caret"></span>
      </a>
      <a  class="nav-link dropdown-toggle d-block d-md-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
          <img src="{{ asset('storage/'.Auth::user()->avatar) }}" class="img-circle profile-img img-hidden" style="width:35px;height:30px;" alt="user profile">
      </a>
        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dLabel" style="padding:10px;width:300px">
            <div class="row">
              <div class="col-2"><img src="{{ asset('storage/'.Auth::user()->avatar) }}" width="100%" height="auto" class="img-circle" style="width:60px;height:60px;margin-left:5px;" alt=""></div>
              <div class="col-10" >
                  <h5 style="line-height:80%;margin-top:12px;margin-bottom:5px;margin-left:30px">{{ Auth::user()->name }}</h5>
                  <h6 style="margin-top:0px;font-weight:200;font-size:12px;margin-left:30px">{{ Auth::user()->email }}</h6>
              </div>
            </div>
            <div class="divider"></div>
            <div class="row" style="margin-top:5px">
              <div class="col-12 text-center">
                  <a href="{{route('home')}}" class="btn btn-default btn-block"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
              </div>
            </div>
            <div class="row" style="margin-top:5px">
              <div class="col-12 text-center">
                  <a href="{{ route('logout') }}" style="background-color:#FF3C00;color:#FFFFFF" class="btn btn-block" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesión
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
            </div>
        </div>
    </li>
  </div>
</nav>
<!-- /.navbar -->
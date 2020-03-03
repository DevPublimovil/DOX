<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="@if(Auth::user()->hasPermission('browse_home')) {{route('home')}} @else {{route('contactos.index')}} @endif" class="brand-link">
    <img src="{{asset('images/bg-dox.png')}}" class="img-fluid brand-image" alt="Logo">
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('storage/'.Auth::user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(Auth::user()->hasPermission('browse_home'))
        <li class="nav-item" >
          <a href="{{route('home')}}" class="nav-link {{!Route::is('home') ?: 'activo-link'}}">
            <i class="nav-icon fa fa-home"></i>
            <p>
              Inicio
              {{-- <span class="right badge badge-danger"></span> --}}
            </p>
          </a>
        </li>
        @endif
        @if(Auth::user()->hasPermission('browse_home'))
        <li class="nav-item">
          <a href="{{route('entregas.index')}}" class="nav-link {{!Route::is('entregas.index') ?: 'activo-link'}}">
            <i class="nav-icon fa fa-handshake-o"></i>
            <p>
              Entregas
            </p>
          </a>
        </li>
        @endif
        @if(Auth::user()->hasPermission('browse_home'))
        <li class="nav-item">
          <a href="{{route('excluidos.index')}}" class="nav-link {{!Route::is('excluidos.index') ?: 'activo-link'}}">
            <i class="nav-icon fa fa-envelope-open"></i>
            <p>
              Excluidos
            </p>
          </a>
        </li>
        @endif
        @if(Auth::user()->hasPermission('browse_directorio'))
        <li class="nav-item">
          <a href="{{route('contactos.index')}}" class="nav-link {{!Route::is('contactos.index') ?: 'activo-link'}}">
            <i class="nav-icon fa fa-phone"></i>
            <p>
              Directorio
            </p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{route('agendas.index')}}" class="nav-link {{!Route::is('agendas.index') ?: 'activo-link'}}">
            <i class="nav-icon fa fa-calendar-check-o"></i>
            <p>
              Agenda
            </p>
          </a>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('cpanel')}}" class="brand-link">
      <img src="{{asset('vendors/dist/img/AdminLTELogo.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- Here Using a defualt Img if User have no Image as iam not make it required --}}
          <img @if(Auth::user()->img) src="{{Storage::disk('s3')->url(Auth::user()->img)}}" @else src="{{asset('vendors/dist/img/user2-160x160.jpg')}}" @endif class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           {{-- User Section      --}}
          <li class="nav-item @if(Request()->segment(1) == 'users') menu-open @endif ">
            <a href="#" class="nav-link @if(Request()->segment(1) == 'users') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Users Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item ">
                <a href="{{route('users.create')}}" class="nav-link @if(Route::current()->getName() == 'users.create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{route('users.index')}}" class="nav-link @if(Route::current()->getName() == 'users.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{route('users.show' , Auth()->check()? Auth()->user()->id : '')}}" class="nav-link @if(Route::current()->getName() == 'users.show') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show User Profile</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End User Section  --}}
          {{-- Menu Section  --}}
          <li class="nav-item @if(Request()->segment(1) == 'menus') menu-open @endif">
            <a href="#" class="nav-link @if(Request()->segment(1) == 'menus') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Menu Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('menus.create')}}" class="nav-link @if(Route::current()->getName() == 'menus.create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('menus.index')}}" class="nav-link @if(Route::current()->getName() == 'menus.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Menus</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Menu Section  --}}
          {{-- Product Section  --}}
          <li class="nav-item @if(Request()->segment(1) == 'products') menu-open @endif">
            <a href="#" class="nav-link @if(Request()->segment(1) == 'products') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Products Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('products.create')}}" class="nav-link @if(Route::current()->getName() == 'products.create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link @if(Route::current()->getName() == 'products.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Products</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Product Section --}}
          {{-- Chef Section --}}
          <li class="nav-item @if(Request()->segment(1) == 'chefs') menu-open @endif">
            <a href="#" class="nav-link @if(Request()->segment(1) == 'chefs') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Chefs Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('chefs.create')}}" class="nav-link @if(Route::current()->getName() == 'chefs.create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Chef</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('chefs.index')}}" class="nav-link @if(Route::current()->getName() == 'chefs.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Chefs</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Chef Section --}}
          {{-- Order Section --}}
          <li class="nav-item @if(Request()->segment(1) == 'orders') menu-open @endif">
            <a href="#" class="nav-link @if(Request()->segment(1) == 'orders') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Order Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('orders.index')}}" class="nav-link @if(Route::current()->getName() == 'orders.index') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- End Order Section --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  
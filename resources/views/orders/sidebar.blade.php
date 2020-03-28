@section('sidebar')
  <!-- Sidebar Menu -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div>
      <a class="fas fa-user-circle-o"></a>
    </div>
    <div class="info">
      <a class="d-block">{{ Auth::user()->name}}</a>
    </div>
  </div>
  <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Master Data
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('tipeindex')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Tipe Pelanggan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('tipemobilindex')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Tipe Kendaraan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('vendorindex')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Vendor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('driverindex')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Driver</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('custindex')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('carindex')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Mobil</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('orderindex')}}" class="nav-link active">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>
              Orders
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
<!-- /.sidebar -->
@endsection
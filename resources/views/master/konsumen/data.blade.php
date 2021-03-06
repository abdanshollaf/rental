@extends('layouts.app.app')
@section('title')
    <title>Admin Panel | Master Konsumen</title>
@endsection
@section('left-header')
<li class="nav-item">
  <a class="nav-link active"><h5>Master Data / Master Konsumen</h5></a>
</li>
@endsection
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
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link active">
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
              <a href="{{route('custindex')}}" class="nav-link active">
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
          <a href="{{route('orderindex')}}" class="nav-link">
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
@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Master Data</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Master Data</a></li>
                  <li class="breadcrumb-item active">Master Konsumen</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div> --}}
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
          <br>
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
      <div class="card card-primary card-outline card-outline-tabs">
        <!-- /.card-header -->
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Belum Pernah Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Sudah Pernah Order</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
            <div>
                <button class="btn btn-primary pull-right add-modal">  <span class="fa fa-plus-circle"></span> Tambah</button>
            </div>
          <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
              <br>
              <table id="example2" class="table table-bordered table-striped">
                  <thead>
                          <tr>
                              <th class="text-center" width="5">No.</th>
                              <th>Nama Pelanggan</th>
                              <th>Tipe Pelanggan</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th>No. Telp</th>
                              <th>Tanggal Lahir</th>
                              <th width="125">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($data2 as $indexKey => $item )
                              <tr class="item{{$item->id}}">
                                <td class="text-center col1">
                                    <div>{{$indexKey+1}}</div>
                                </td>
                              <td>
                                  <div>{{$item->nama_pelanggan}}</div>
                              </td>
                              <td>
                                <?php
                                $tipe2 = App\Models\Master\TipePelangganModel::all()->where('id', '=', $item['id_tipe_pelanggan']);
                                ?>
                                @foreach ($tipe2 as $items)
                                <div>{{$items->nama_tipe_pelanggan}}</div>
                                @endforeach
                              </td>
                              <td>
                                <div>{{$item->email}}</div>
                              </td>
                              <td>
                                  <div>{{$item->alamat}}</div>
                              </td>
                              <td>
                                  <div>{{$item->no_telp}}</div>
                              </td>
                              <td>
                                  <div>{{$item->tgl_lahir}}</div>
                              </td>
                              <td>
                                <button class="btn btn-warning btn-sm edit-modal" data-id="{{$item->id}}"
                                  data-nama="{{$item->nama_pelanggan}}" data-tipe="{{$items->nama_tipe_pelanggan}}"
                                  data-email="{{$item->email}}" data-alamat="{{$item->alamat}}"
                                  data-no_telp="{{$item->no_telp}}" data-tgl_lahir="{{$item->tgl_lahir}}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-modal" data-id="{{$item->id}}"
                                  data-nama="{{$item->nama_pelanggan}}" data-tipe="{{$items->nama_tipe_pelanggan}}"
                                  data-email="{{$item->email}}" data-alamat="{{$item->alamat}}"
                                  data-no_telp="{{$item->no_telp}}" data-tgl_lahir="{{$item->tgl_lahir}}">Delete</button>
                              </td>
                            </tr>
                          @endforeach
                      </tbody>
                  </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
              <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th class="text-center" width="5">No.</th>
                            <th>Nama Pelanggan</th>
                            <th>Tipe Pelanggan</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Tanggal Lahir</th>
                            <th width="125">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $indexKey => $item )
                            <tr class="item{{$item->id}}">
                              <td class="text-center col2">
                                  <div>{{$indexKey+1}}</div>
                              </td>
                            <td>
                                <div>{{$item->nama_pelanggan}}</div>
                            </td>
                            <td>
                              <?php
                              $tipe = App\Models\Master\TipePelangganModel::all()->where('id', '=', $item['id_tipe_pelanggan']);
                              ?>
                              @foreach ($tipe as $items)
                              <div>{{$items->nama_tipe_pelanggan}}</div>
                              @endforeach
                            </td>
                            <td>
                              <div>{{$item->email}}</div>
                            </td>
                            <td>
                                <div>{{$item->alamat}}</div>
                            </td>
                            <td>
                                <div>{{$item->no_telp}}</div>
                            </td>
                            <td>
                                <div>{{$item->tgl_lahir}}</div>
                            </td>
                            <td>
                              <button class="btn btn-warning btn-sm edit-modal" data-id="{{$item->id}}"
                                data-nama="{{$item->nama_pelanggan}}" data-tipe="{{$items->nama_tipe_pelanggan}}"
                                data-email="{{$item->email}}" data-alamat="{{$item->alamat}}"
                                data-no_telp="{{$item->no_telp}}" data-tgl_lahir="{{$item->tgl_lahir}}">Edit</button>
                              <button class="btn btn-danger btn-sm delete-modal" data-id="{{$item->id}}"
                                data-nama="{{$item->nama_pelanggan}}" data-tipe="{{$items->nama_tipe_pelanggan}}"
                                data-email="{{$item->email}}" data-alamat="{{$item->alamat}}"
                                data-no_telp="{{$item->no_telp}}" data-tgl_lahir="{{$item->tgl_lahir}}">Delete</button>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
          <script>
            $(function () {
              $('#example1').dataTable({
                "ordering": false,
              });
              $('#example2').dataTable({
                "ordering": false,
              });
            });
        </script>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  @include('master/konsumen/modal')
    </section>
    <!-- /.content -->
  </div>
</div>
@endsection
@extends('layouts.app.app')
@section('title')
    <title>Admin Panel | Master Kendaraan</title>
@endsection
@section('left-header')
<li class="nav-item">
  <a class="nav-link active"><h5>Master Data / Master Kendaraan</h5></a>
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
              <a href="{{route('custindex')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('carindex')}}" class="nav-link active">
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
                  <li class="breadcrumb-item active">Master Kendaraan</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div> --}}
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
            <br>
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <div class="pull-left">
                        <h3 class="card-title"></h3>
                </div>
                    <button class="btn btn-primary pull-right add-modal">  <span class="fa fa-plus-circle"></span> Tambah</button>
                  </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                    <thead>
                            <tr>
                                <th class="text-center" width="5">No.</th>
                                <th>Nama Vendor</th>
                                <th>No. Polisi</th>
                                <th>Merk</th>
                                <th>Tipe</th>
                                <th>Kategori Kendaraan</th>
                                <th>Masa Berlaku STNK</th>
                                <th width="125">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $indexKey => $item )
                                <tr class="item{{$item->id}}">
                                  <td class="text-center col1">
                                      <div>{{$indexKey+1}}</div>
                                  </td>
                                  <td>
                                      <div>{{$item->vendor}}</div>
                                  </td>
                                  <td>
                                      <div>{{$item->no_polisi}}</div>
                                  </td>
                                  <td>
                                      <div>{{$item->merk}}</div>
                                  </td>
                                  <td>
                                      <div>{{$item->tipe}}</div>
                                  </td>
                                  <td>
                                    <?php
                                    $tipe2 = App\Models\Master\TipeMobilModel::all()->where('id', '=', $item['id_tipe_mobil']);
                                    ?>
                                    @foreach ($tipe2 as $items)
                                    <div>{{$items->nama_tipe}}</div>
                                    @endforeach
                                  </td>
                                  <td>
                                      <div>{{$item->stnk}}</div>
                                  </td>
                                  <td>
                                    <button class="btn btn-warning btn-sm edit-modal" data-id="{{$item->id}}"
                                      data-vendor="{{$item->vendor}}" data-no_polisi="{{$item->no_polisi}}"
                                      data-merk="{{$item->merk}}" data-tipe="{{$item->tipe}}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-modal" data-id="{{$item->id}}"
                                      data-vendor="{{$item->vendor}}" data-no_polisi="{{$item->no_polisi}}"
                                      data-merk="{{$item->merk}}" data-tipe="{{$item->tipe}}">Delete</button>
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
              </table>
              <script>
                $(function () {
                  $('#example1').dataTable({
                    "ordering": false,
                  });
                });
            </script>
              @include('master/mobil/modal')
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
        </section>
        <!-- /.content -->
      </div>
@endsection
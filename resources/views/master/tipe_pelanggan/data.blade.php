@extends('layouts.app.app')
@section('title')
    <title>Admin Panel | Master Tipe Pelanggan</title>
@endsection
@section('left-header')
<li class="nav-item">
  <a class="nav-link active"><h5>Master Data / Master Tipe Pelanggan</h5></a>
</li>
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
                  <li class="breadcrumb-item active">Master Tipe Pelanggan</li>
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
                                <th>Nama Tipe Pelanggan</th>
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
                                      <div>{{$item->nama_tipe_pelanggan}}</div>
                                  </td>
                                  <td>
                                    <button class="btn btn-warning btn-sm edit-modal" data-id="{{$item->id}}"
                                      data-nama="{{$item->nama_tipe_pelanggan}}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-modal" data-id="{{$item->id}}"
                                      data-nama="{{$item->nama_tipe_pelanggan}}">Delete</button>
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Nama Tipe Pelanggan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    @include('master/tipe_pelanggan/modal')
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
      <script>
        $(function () {
          $('#example1').dataTable({
            "ordering": false,
          });
        });
    </script>
@endsection
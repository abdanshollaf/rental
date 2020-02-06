@extends('layouts.app.app')
@section('title')
    <title>Admin Panel | Master Driver</title>
@endsection

@section('left-header')
<li class="nav-item">
  <a class="nav-link active"><h5>Master Data / Master Driver</h5></a>
</li>
@endsection

@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Master Data</li>
                  <li class="breadcrumb-item active">Master Driver</li>
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
                                <th>Nama Driver</th>
                                <th>No. Telp</th>
                                <th width="125">Action</th>
                            </tr>
                            @csrf
                        </thead>
                        <tbody>
                            @foreach ($data as $indexKey => $item )
                                <tr class="item{{$item->id}}">
                                  <td class="text-center col1">
                                      <div>{{$indexKey+1}}</div>
                                  </td>
                                  <td>
                                      <div>{{$item->nama}}</div>
                                  </td>
                                  <td>
                                      <div>{{$item->no_telp}}</div>
                                  </td>
                                  <td>
                                      <button class="btn btn-warning btn-sm edit-modal" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-no_telp="{{$item->no_telp}}">Edit</button>
                                      <button class="btn btn-danger btn-sm delete-modal" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-no_telp="{{$item->no_telp}}">Delete</button>
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Nama Driver</th>
                                <th>No. Telp</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
              </table>
              <script>
                $(function () {
                  $('#example1').dataTable({
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
      @include('master/driver/modal')
        </section>
        <!-- /.content -->
      </div>
      
    

@endsection
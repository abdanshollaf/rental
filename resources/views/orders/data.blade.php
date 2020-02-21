@extends('layouts.app.app')
@section('title')
    <title>Admin Panel | Order Data</title>
@endsection
@section('left-header')
<li class="nav-item">
  <a class="nav-link active"><h5>Orders / Order Data</h5></a>
</li>
@endsection
@include('orders/sidebar')

@section('content')
<style>
    .centervertical { 
      height: 45px;
      position: relative; 
    }
    
    .center p {
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
    </style>
<div class="content-wrapper">
    <br/>
<section class="content">
    @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach()
            </div>
            @endif
            @if(Session::has('success_msg'))
                <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
            @elseif(Session::has('danger_msg'))      
                <div class="alert alert-danger">{{ Session::get('danger_msg') }}</div>
            @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Booking Orders</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Ongoing Orders</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">End Orders</a>
                            </li>
                        </ul>
                    </div>            
                    <div class="card-body">
                        <div>
                            <a class="btn btn-primary" href="{{route('orderadd')}}">  <span class="fa fa-plus-circle"></span> Tambah</a>
                        </div> 
                        <br/>
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                                <tr>
                                                    <th class="text-center" width="3%">No.</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>No. Telp</th>
                                                    <th>Jumlah Booking</th>
                                                    <th>Total Harga</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order as $indexKey => $items )
                                                    <tr class="items{{$items->id}}">
                                                        <td  class="text-center centervertical col1"><div><p>{{$indexKey+1}}</p></div></td>
                                                        <td><div>{{$items->nama_pelanggan}}</div></td>
                                                        <td><div>{{$items->no_telp}}</div></td>
                                                        <td width="14%" class="text-center"><div>{{$item2 = \App\Models\Order\OrderDetailModel::where('id_order','=',$items->id)->count()}}</div></td>
                                                        <td><div>{{$items->actual}}</div></td>
                                                        <td width="15%">
                                                            <a class="btn btn-secondary btn-sm" href="{{route('orderedit',$items->id)}}"><span class="fas fa-edit"></span></a>
                                                            <a class="btn btn-info btn-sm" href="{{route('ordershow',$items->id)}}"><span class="fas fa-eye text-white"></span></a>
                                                            <a class="btn btn-danger btn-sm delete-modal" data-id="{{$items->id}}"
                                                                data-pelanggan="{{$items->nama_pelanggan}}" data-telp="{{$items->no_polisi}}"
                                                                data-count="{{$item2}}" data-actual="{{$items->actual}}"><span class="fas fa-trash text-white"></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </table> 
                            </div>
                            @include('orders/modal')
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                    <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th>Nama Vendor</th>
                                                        <th>Alamat</th>
                                                        <th>Penanggung Jawab</th>
                                                        <th>No. Telp</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th>Nama Vendor</th>
                                                        <th>Alamat</th>
                                                        <th>Penanggung Jawab</th>
                                                        <th>No. Telp</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                    <table id="example3" class="table table-bordered table-striped">
                                            <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th>Nama Vendor</th>
                                                        <th>Alamat</th>
                                                        <th>Penanggung Jawab</th>
                                                        <th>No. Telp</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th>Nama Vendor</th>
                                                        <th>Alamat</th>
                                                        <th>Penanggung Jawab</th>
                                                        <th>No. Telp</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
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
          $('#example3').dataTable({
            "ordering": false,
          });
        });
    </script>
</section>

@endsection
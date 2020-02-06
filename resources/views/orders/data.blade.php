@extends('layouts.app.app')
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
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Orders</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">Orders</a></li>
                  <li class="breadcrumb-item active">Orders Data</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
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
                                                    <th class="text-center centervertical" rowspan="2"><p> No.</p></th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Kendaraan</th>
                                                    <th>Nama Driver</th>
                                                    <th>Penjemputan</th>
                                                    <th>Tujuan</th>
                                                    <th class="text-center centervertical" rowspan="2"><p> Total Harga</p></th>
                                                    <th class="text-center centervertical" rowspan="2"><p> Action</p></th>
                                                </tr>
                                                <tr>
                                                    <th>No. Hp</th>
                                                    <th>No. Polisi</th>
                                                    <th>No. Hp</th>
                                                    <th>Tanggal Dan Jam</th>
                                                    <th>Tanggal Dan Jam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $indexKey => $items )
                                                    <tr>
                                                        <td class="text-center centervertical"><div><p>{{$indexKey+1}}</p></div></td>
                                                        <td><?php echo \App\Models\Master\CustomerModel::find($items->id_pelanggan)->first()->nama_pelanggan ?>
                                                            <hr>
                                                            <?php echo \App\Models\Master\CustomerModel::find($items->id_pelanggan)->first()->no_telp ?>
                                                        </td>
                                                        <td><?php echo \App\Models\Master\MobilModel::find($items->id_mobil)->first()->merk ?> - <?php echo \App\Models\Master\MobilModel::find($items->id_mobil)->first()->tipe ?>
                                                            <hr>
                                                            <?php echo \App\Models\Master\MobilModel::find($items->id_mobil)->first()->no_polisi ?>
                                                        </td>
                                                        <td><?php echo \App\Models\Master\DriverModel::find($items->id_driver)->first()->nama ?>
                                                            <hr>
                                                            <?php echo \App\Models\Master\DriverModel::find($items->id_driver)->first()->no_telp ?>
                                                        </td>
                                                        <td>{{$items->jemput}}
                                                            <hr>
                                                            {{$items->start_date}} - {{$items->start_time}}
                                                        </td>
                                                        <td>{{$items->tujuan}}
                                                            <hr>
                                                            {{$items->finish_date}} - {{$items->finish_time}}
                                                        </td>
                                                        <td class="text-center centervertical">
                                                            <p>
                                                                {{$items->total_tagihan}}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm edit-modal"><span class="fas fa-edit"></span></button>
                                                            <button class="btn btn-info btn-sm"><span class="fas fa-print"></span></button>
                                                            <button class="btn btn-danger btn-sm delete-modal"><span class="fas fa-trash"></span></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </table> 
                            </div>
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
                    @include('orders/modal')
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
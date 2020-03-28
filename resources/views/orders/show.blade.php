@extends('layouts.app.app')
@section('title')
    <title>Admin Panel | Orders</title>
@endsection
@section('left-header')
<li class="nav-item">
  <a class="nav-link active"><h5>Orders / Order Show</h5></a>
</li>
@endsection
@include('orders/sidebar')

@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <br/>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
          <div class="row">
                <div class="col-md-12 align-content-center">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title">Show Order</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <style>
                              hr {
                                border: 0; 
                                border-top: 3px double #000000;
                                margin-bottom: 0.25em;
                                margin-top: 0.25em;
                              } 
                              </style>
                            <div class="col-md-12">
                              <table>
                                <tr width="10%">
                                  <td>
                                    <tr>
                                      <td rowspan="6" width="20%">
                                        <img src="{{asset('Picture1.png')}}" width="100%" height="100%">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td width="60%">
                                        <strong>KAIZEN TRANS INDONESIA</strong>
                                      </td>
                                      <td width="50%" style="text-align: right;">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Jalan Mekar Baru 1 No. 19 RT 01/006
                                      </td>
                                      <td width="50%" style="text-align: right;">
                                       Rent Of Car
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Cirendeu - Ciputat Timur, Tangerang Selatan
                                      </td>
                                      <td width="50%" style="text-align: right;">
                                        Tour / Wisata
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Phone: (021) 7404424 / 0812 1044 5144
                                      </td>
                                      <td width="50%" style="text-align: right;">
                                        Transportation Services
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Email: marketingkaizenrent@gmail.com
                                      </td>
                                      <td width="50%" style="text-align: right;">
                                        Transportation Investment
                                      </td>
                                    </tr>
                                  </td>
                                </tr>
                              </table>
                            </div>
                                
                            <!-- info row -->
                            <br/>
                            <hr>
                            <div style="text-align: center;">
                              <h3>INVOICE</h3>
                            </div>
                            <hr>
                            <br/>

                            <div class="row">
                              <div class="col-12">
                                <table>
                                  <tbody>
                                      <tr>
                                        <td width="30%">
                                          <div>
                                            No. Invoice
                                          </div>
                                        </td>
                                        <td width="35%">
                                          <div>
                                            : adsadqwdsa
                                          </div> 
                                        </td>
                                        <td width="20%">
                                          <div>
                                            Tanggal
                                          </div> 
                                        </td>
                                        <td width="20%">
                                          <div>
                                            : <?php echo Carbon\Carbon::today()->toDateTimeString(); ?>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div>
                                            Kepada
                                          </div>
                                        </td>
                                        <td>
                                          <div>
                                            : {{$orders->nama_pelanggan}}
                                          </div>
                                        </td>
                                        <td>
                                          <div>
                                            Jenis Pembayaran
                                          </div>
                                        </td>
                                        <td>
                                          <div>
                                            : Transfer
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div>
                                            Alamat
                                          </div>
                                        </td>
                                        <td>
                                          <div>
                                            : <?php echo App\Models\Master\CustomerModel::find($orders->id_pelanggan)->alamat ?>
                                          </div>
                                        </td>
                                        <td>
                                          <div>
                                            Batas Pembayaran
                                          </div>
                                        </td>
                                        <td>
                                          <div>
                                            : {{date('d-m-Y',strtotime('+7 day', strtotime($orders->created_at)))}}
                                          </div>
                                        </td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.col -->
                            </div>
                              <!-- /.col -->
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <br/>
                            <!-- Table row -->
                            <div class="row">
                              <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                  <tr>
                                    <th>No. </th>
                                    <th>Merk Tipe Mobil</th>
                                    <th>Jumlah Hari</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($orderdetail as $indexKey => $item)
                                      <tr>
                                        <td><div>{{$indexKey+1}}</div></td>
                                        <td>{{\App\Models\Master\MobilModel::find($item->id_mobil)->first()->no_polisi}} - {{\App\Models\Master\MobilModel::find($item->id_mobil)->first()->merk}} {{\App\Models\Master\MobilModel::find($item->id_mobil)->first()->tipe}}</td>
                                        <td><?php echo date_diff(date_create($item->start_date),date_add(date_create($item->finish_date),date_interval_create_from_date_string("1 days")))->format('%a') ?></td>
                                        <td><?php if (date_diff(date_create($item->start_date),date_add(date_create($item->finish_date),date_interval_create_from_date_string("1 days")))->format('%a') != 0) {
                                            echo $item->total_tagihan / date_diff(date_create($item->start_date),date_add(date_create($item->finish_date),date_interval_create_from_date_string("1 days")))->format('%a');}
                                            else {
                                                echo $item->total_tagihan;
                                            }  ?></td>
                                        <td>{{$item->total_tagihan}}</td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
              
                            <div class="row">
                              <!-- accepted payments column -->
                              <div class="col-3">
                                <p class="lead text-center">Hormat Kami</p>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <p class="lead text-center">(..................................)</p>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-3">
                                <p class="lead">Metode Pembayaran:</p>
                              </div>
                              
                              <!-- /.col -->
                              <div class="col-1">

                              </div>
                              <div class="col-4">
                                <p class="lead">Jumlah Pembayaran</p>
              
                                <div class="table-responsive">
                                  <table class="table">
                                    <tr>
                                      <th style="width:50%">Subtotal:</th>
                                      <td><?php 
                                        $subtotal = 0;
                                        foreach ($orderdetail as $key => $value) {
                                          $subtotal += $value->total_harga;
                                        }
                                        echo "Rp. ";
                                        echo number_format($subtotal,2,",",".");?></td>
                                    </tr>
                                    <tr>
                                      <th>Pajak:</th>
                                      <td><?php 
                                        $pajak = 0;
                                        foreach ($orderdetail as $key => $value) {
                                          $pajak += $value->ppn + $value->pph;
                                        }
                                        echo "Rp. ";
                                        echo number_format($pajak,2,",",".");?></td>
                                    </tr>
                                    <tr>
                                      <th>Diskon:</th>
                                      <td><?php 
                                        $diskon = 0;
                                        foreach ($orderdetail as $key => $value) {
                                          $diskon += $value->diskon;
                                        }
                                        echo "Rp. ";
                                        echo number_format($diskon,2,",",".");?></td>
                                    </tr>
                                    <tr>
                                      <th>Total:</th>
                                      <td><?php 
                                        $total = 0;
                                        foreach ($orderdetail as $key => $value) {
                                          $total += $value->total_tagihan;
                                        }
                                        echo "Rp. ";
                                        echo number_format($total,2,",",".");?></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
              
                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                              <div class="col-12">
                                <a href="{{route('orderindex')}}" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a>
                                <a href="{{route('orderopenPDF',$orders->id)}}" target="_blank" class="btn btn-primary float-right"><i class="fas fa-print"></i> Print</a>
                              </div>
                            </div>
                          </div>        
                      </div>
                </div>
                </div>
          </div>
        </section>
@endsection

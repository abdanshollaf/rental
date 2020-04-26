@extends('layouts.app.app')
@section('title')
<title>Admin Panel | Orders</title>
@endsection
@section('left-header')
<li class="nav-item">
  <a class="nav-link active">
    <h5>Orders / Order Show</h5>
  </a>
</li>
@endsection
@include('orders/sidebar')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <br />
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
          {{-- <div class="invoice p-3 mb-3"> --}}
          <!-- title row -->
          <style>
            hr {
              border: 0;
              border-top: 3px double #000000;
              margin-bottom: 0.25em;
              margin-top: 0.25em;
            }
          </style>
          <br />
          <table class="">
            <tr width="100%">
              <td width="3%"></td>
              <td width="94%">
                <div class="row no-print">
                  <div class="col-12">
                    <table width="100%">
                      <tr width="100%">
                        <td width="20%">
                          <a href="{{route('orderindex')}}" class="btn btn-warning btn-sm"><i
                              class="fas fa-arrow-left"></i>
                            Back</a>
                        </td>
                        <td width="30%" style="text-align:center">
                          <a href="{{route('tiket',$orders->id)}}" target="_blank" class="btn btn-primary btn-sm"><i
                              class="fas fa-print"></i> Tiket</a>
                        </td>
                        <td width="30%" style="text-align:center">
                          <a href="{{route('spj',$orders->id)}}" target="_blank" class="btn btn-primary btn-sm"><i
                              class="fas fa-print"></i> Surat Jalan</a>
                        </td>
                        <td width="20%" style="text-align:right"><?php $out = 'invoice' ?>
                          <a href="{{route('invoice', $orders->id)}}" target="_blank" class="btn btn-primary btn-sm"><i
                              class="fas fa-print"></i> Invoice</a>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <br />
                <table width="100%">
                  <tr width="100%">
                    <td rowspan="6" width="18%">
                      <img src="{{asset('Picture1.png')}}" width="100%" height="80%" alt="Logo">
                    </td>
                  </tr>
                  <tr style="line-height:10px">
                    <td width="60%">
                      <strong>KAIZEN TRANS INDONESIA</strong>
                    </td>
                    <td width="50%" style="text-align: right;">
                    </td>
                  </tr>
                  <tr style="line-height:10px">
                    <td width="60%">
                      Jalan Mekar Baru 1 No. 19 RT 01/006
                    </td>
                    <td style="text-align: right;">
                      Rent Of Car
                    </td>
                  </tr>
                  <tr style="line-height:10px">
                    <td width="60%">
                      Cirendeu - Ciputat Timur, Tangerang Selatan
                    </td>
                    <td style="text-align: right;">
                      Tour / Wisata
                    </td>
                  </tr>
                  <tr style="line-height:10px">
                    <td width="60%">
                      Phone: (021) 7404424 / 0812 1044 5144
                    </td>
                    <td style="text-align: right;">
                      Transportation Services
                    </td>
                  </tr>
                  <tr style="line-height:10px">
                    <td width="60%">
                      Email: marketingkaizenrent@gmail.com
                    </td>
                    <td style="text-align: right;">
                      Transportation Investment
                    </td>
                  </tr>
                </table>

                <hr>
                <div style="text-align: center;">
                  <h5>INVOICE</h5>
                </div>
                <hr>

                <div class="row">
                  <div class="col-12">
                    <table width="100%">
                      <tbody>
                        <tr>
                          <td width="20%">
                            <div>
                              No. Invoice
                            </div>
                          </td>
                          <td width="35%">
                            <div>
                              : {{$orders->id_invoice}}/KSA-INV/{{date('m')}}/{{date('Y')}}
                            </div>
                          </td>
                          <td width="20%">
                            <div>
                              Tanggal
                            </div>
                          </td>
                          <td width="20%">
                            <div>
                              : <?php echo App\Helpers\Tanggal::IndoNow($orders->created_at); ?>
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
                              :
                              <?php echo App\Helpers\Tanggal::IndoNow(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orders->created_at)->add(7, 'day')); ?>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <br />
                <div class="row">
                  <div class="col-12">
                    <table width="100%" border="1">
                      <thead>
                        <tr width="100%" style="line-height:25px">
                          <th width="5%" style="text-align: center;">No. </th>
                          <th width="20%" style="text-align: center;">Merk Tipe Mobil</th>
                          <th width="15%" style="text-align: center;">Tanggal Mulai</th>
                          <th width="15%" style="text-align: center;">Tanggal Berakhir</th>
                          <th width="15%" style="text-align: center;">Jumlah Hari</th>
                          <th width="15%" style="text-align: center;">Harga Satuan</th>
                          <th width="15%" style="text-align: center;">Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($orderdetail as $indexKey => $item)
                        <tr style="line-height:30px" width="100%">
                          <td style="text-align: center;">
                            <div>{{$indexKey+1}}</div>
                          </td>
                          <td style="text-align: center;">
                            {{\App\Models\Master\MobilModel::find($item->id_mobil)->first()->no_polisi}} -
                            {{\App\Models\Master\MobilModel::find($item->id_mobil)->first()->merk}}
                            {{\App\Models\Master\MobilModel::find($item->id_mobil)->first()->tipe}}</td>
                          <td style="text-align: center;"><?php echo App\Helpers\Tanggal::Indo($item->start_date) ?>
                          </td>
                          <td style="text-align: center;"><?php echo App\Helpers\Tanggal::Indo($item->finish_date) ?>
                          </td>
                          <td style="text-align: center;">
                            <?php echo date_diff(date_create($item->start_date), date_add(date_create($item->finish_date), date_interval_create_from_date_string("1 days")))->format('%a') ?>
                            Hari</td>
                          <td style="text-align: center;"><?php if (date_diff(date_create($item->start_date), date_add(date_create($item->finish_date), date_interval_create_from_date_string("1 days")))->format('%a') != 0) {
                                                            echo App\Helpers\Tanggal::rp($item->total_tagihan / date_diff(date_create($item->start_date), date_add(date_create($item->finish_date), date_interval_create_from_date_string("1 days")))->format('%a'));
                                                          } else {
                                                            echo App\Helpers\Tanggal::rp($item->total_tagihan);
                                                          }  ?></td>
                          <td style="text-align: center;">{{App\Helpers\Tanggal::rp($item->total_tagihan)}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <br />
                    <table class="">
                      <tbody>
                        <tr>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                        </tr>
                        <tr style="line-height:25px">
                          <td>Note :</td>
                          <td colspan="3" rowspan="3" style="border-style: solid; border-width: 1px" valign="top"
                            cellspacing="10" width="50%">
                            {{ $orders->note}}
                          </td>
                          <td width="5%"></td>
                          <td><b>Subtotal</b></td>
                          <td>: <?php
                                $subtotal = 0;
                                foreach ($orderdetail as $key => $value) {
                                  $subtotal += $value->total_harga;
                                }
                                echo \App\Helpers\Tanggal::rp($subtotal); ?>
                          </td>
                        </tr>
                        <tr style="line-height:25px">
                          <td></td>
                          <td></td>
                          <td><b>Pajak</b></td>
                          <td>: <?php
                                $pajak = 0;
                                foreach ($orderdetail as $key => $value) {
                                  $pajak += $value->ppn + $value->pph;
                                }
                                echo \App\Helpers\Tanggal::rp($pajak); ?>
                          </td>
                        </tr>
                        <tr style="line-height:25px">
                          <td></td>
                          <td></td>
                          <td><b>Diskon</b></td>
                          <td>: <?php
                                $diskon = 0;
                                foreach ($orderdetail as $key => $value) {
                                  $diskon += $value->diskon;
                                }
                                echo \App\Helpers\Tanggal::rp($diskon); ?>
                          </td>
                        </tr>
                        <tr style="line-height:25px">
                          <td width="5%">Terbilang</td>
                          <td colspan="3">:<b><i> <?php
                                                  $total = 0;
                                                  foreach ($orderdetail as $key => $value) {
                                                    $total += $value->total_tagihan;
                                                  }
                                                  echo ucwords(\App\Helpers\Tanggal::terbilang($total)); ?>
                                Rupiah</i></b>
                          </td>
                          <td></td>
                          <td><b>Total Tagihan</b></td>
                          <td>: <?php
                                $total = 0;
                                foreach ($orderdetail as $key => $value) {
                                  $total += $value->total_tagihan;
                                }
                                echo \App\Helpers\Tanggal::rp($total); ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <br />
                    <table>
                      <tr width="100%">
                        <td width="5%"></td>
                        <td width="60%" rowspan="5" style="border-style: solid; border-width: 1px">
                          <table width="100%">
                            <tr width="100%">
                              <td width="100%" colspan="2">
                                Demi Kenyamanan dan kelancaran administrasi, mohon
                                konfirmasi
                                pembayaran
                                disampaikan ke nomor kontak customer service di :
                              </td>
                            </tr>
                            <tr width="100%">
                              <td width="20%">
                                Email
                              </td>
                              <td width="80%">
                                : marketingkaizenrent@gmail.com
                              </td>
                            </tr>
                            <tr width="100%">
                              <td width="20%">
                                Telepon
                              </td>
                              <td width="80%">
                                : (021) 7404424 / 0812 1044 5144
                              </td>
                            </tr>
                            <tr width="100%">
                              <td width="100%" colspan="2">
                                <b>Rekening Kaizen Trans Indonesia</b>
                              </td>
                            </tr>
                            <tr width="100%">
                              <td width="20%">
                                <b>Bank BCA </b>
                              </td>
                              <td width="80%">
                                <b>: 6080311069 (Atas Nama Ikhsan)</b>
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td width="10%"></td>
                        <td width="25%">
                          <table width="100%">
                            <tr>
                              <td style="text-align: center"> Kaizen Trans Indonesia</td>
                            </tr>
                            <tr>
                              <td style="text-align: center">
                                <br /><br /><br /></td>
                            </tr>
                            <tr>
                              <td style="text-align: center"> <u><b>Ikhsan</b></u></td>
                            </tr>
                            <tr>
                              <td style="text-align: center"> Finance</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </div> <!-- /.col -->
                </div>
                <br />
              </td>
              <td width="3%"></td>
            </tr>
          </table>

        </div>
      </div>
    </div>
</div>
</div>
</section>
@endsection
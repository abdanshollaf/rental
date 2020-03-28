<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice Order {{$orders->id}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="invoice p-3 mb-3">
      <!-- title row -->
      <div class="col-md-12">
        <style>
          hr {
            border: 0; 
            border-top: 3px double #000000;
            margin-bottom: 0.25em;
            margin-top: 0.25em;
          } 
          </style>
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
      <hr>
      <div style="text-align: center;">
        <h3>INVOICE</h3>
      </div>
      <hr>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dari
          <address>
            <strong>Kaizen Trans Indonesia</strong><br>
            Jalan Mekar Baru 1 No. 19 RT 01/006<br>
            Cirendeu - Ciputat Timur, Tangerang Selatan<br>
            Phone: (021) 7404424 / 0812 1044 5144<br>
            Email: marketingkaizenrent@gmail.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Kepada
          <address>
            <strong>{{$orders->nama_pelanggan}}</strong><br>
            {{\App\Models\Master\CustomerModel::find($orders->id_pelanggan)->first()->alamat}}<br>
            Phone: {{$orders->no_telp}}<br>
            Email: {{$orders->email}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #{{date('Ymd',strtotime($orders->created_at))."".$orders->id}}</b><br>
          <b>Order ID:</b> KTI - {{$orders->id}}<br>
          <b>Jatuh Tempo Pembayaran:</b> {{date('d-m-Y',strtotime('+7 day', strtotime($orders->created_at)))}}<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

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
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>

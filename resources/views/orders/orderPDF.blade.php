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
    <div class="row">
        <div class="col-12">
          <h4>
            <i class="fas fa-globe"></i> Kaizen Trans Indonesia
            <small class="float-right">Tanggal: {{ date('Y-m-d') }}</small>
          </h4>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dari
          <address>
            <strong>PT. Kaizen Trans Indonesia</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com
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
                  <td><?php echo date_diff(date_create($item->start_date),date_create($item->finish_date))->format('%a') ?></td>
                  <td>{{$item->total_tagihan / date_diff(date_create($item->start_date),date_create($item->finish_date))->format('%a')}}</td>
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
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>

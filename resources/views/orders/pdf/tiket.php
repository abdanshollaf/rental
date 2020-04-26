<?php foreach ($orderdetail as $key => $value) {
  $key = $key + 1;
?>
  <div style="page-break-after: auto">
    <table style="border-style: double; ">
      <tr>
        <td>
          <table class="">
            <tr width="100%">
              <td rowspan="5" width="15%">
                <img src="Picture1.png" alt="Logo" height="55px" />
              </td>
              <td width="85%" style="font-size: 17px;">
                <strong>KAIZEN TRANS INDONESIA</strong>
              </td>
            </tr>
            <tr style=" font-size: 10px;">
              <td width="50%">
                Layanan Transportasi Prima
              </td>
            </tr>
            <tr style=" font-size: 10px;">
              <td width="50%">
                Jalan Mekar Baru 1 No. 19 RT 01/006 Cirendeu, Ciputat Timur, Tangerang Selatan
              </td>
            </tr>
            <tr style=" font-size: 10px;">
              <td width="50%">
                Phone: (021) 7404424 / 0812 1044 5144
              </td>
            </tr>
            <tr style=" font-size: 10px;">
              <td width="50%">
                Email: marketingkaizenrent@gmail.com
              </td>
            </tr>
          </table>
          <hr style="border-top: 3px; border-style: double">
          <table width="100%">
            <tr>
              <td colspan="2" style="text-align: center; font-size: 18px"><b><u>BOOKING TICKET</u></b></td>
            </tr>
          </table>
          <table style=" font-size: 12px">
            <tr width="100%">
              <td rowspan="9" wdith="5%"></td>
              <td rowspan="9" style="border-style: double" width="30%">

              </td>
              <td rowspan="9" width="5%"></td>
              <td width="25%">
                Kode Booking
              </td>
              <td width="35%">
                : <?php echo 'KSA' . substr($orders->created_at, 0, 4) . substr($orders->created_at, 5, 2) . $orders->id_invoice . $key ?>
              </td>
            </tr>
            <tr>
              <td>
                Nama Pengemudi
              </td>
              <td>
                : <?php echo ucwords(strtolower(\App\Models\Master\DriverModel::find($value->id_driver)->nama)) ?>
              </td>
            </tr>
            <tr>
              <td>
                No. Telpon
              </td>
              <td>
                : <?php echo ucwords(strtolower(\App\Models\Master\DriverModel::find($value->id_driver)->no_telp)) ?>
              </td>
            </tr>
            <tr>
              <td>
                Kendaraan
              </td>
              <td>
                : <?php echo ucwords(strtolower(\App\Models\Master\MobilModel::find($value->id_mobil)->merk)) . ' ';
                  echo ucwords(strtolower(\App\Models\Master\MobilModel::find($value->id_mobil)->tipe));  ?>
              </td>
            </tr>
            <tr>
              <td>
                Alamat Penjemputan
              </td>
              <td>
                : <?php echo ucwords(strtolower($value->jemput)) ?>
              </td>
            </tr>
            <tr>
              <td>
                Tanggal Penjemputan
              </td>
              <td>
                : <?php echo \App\Helpers\Tanggal::Indo($value->start_date) ?>
              </td>
            </tr>
            <tr>
              <td>
                Waktu Penjemputan
              </td>
              <td>
                : <?php echo substr($value->start_time, 0, 5) ?>
              </td>
            </tr>
            <tr>
              <td>
                Tanggal Berakhir
              </td>
              <td>
                : <?php echo \App\Helpers\Tanggal::Indo($value->finish_date) ?>
              </td>
            </tr>
            <tr>
              <td>
                Jumlah Hari
              </td>
              <td>
                : <?php echo date_diff(date_create($value->start_date), date_add(date_create($value->finish_date), date_interval_create_from_date_string("1 days")))->format('%a') ?> Hari
              </td>
            </tr>
            <br>
            <br>
          </table>
        </td>
      </tr>
    </table>
  </div>
<?php
}
?>



<style>
  table {
    width: 100%;
  }

  th {
    text-align: center;
    font-weight: bold;
  }

  .tongah_header {
    line-height: 25px;

  }

  .table-bordered th {
    border: 1px solid #333333;
  }

  .table-bordered td {
    border: 1px solid #333333;
  }

  .bg-gray {
    background: #d1d1d1;
  }

  .text-center {
    text-align: center;
  }

  .text-right {
    text-align: right;
  }

  .text-left {
    text-align: left;
  }

  .table-bordered {
    border: 1px solid #000000
  }

  @page {
    margin: 25px 25px;
  }

  header {
    position: fixed;
    top: 0px;
    left: 0px;
    right: 0px;
    height: 0px;

    /** Extra personal styles **/
    background-color: #03a9f4;
    color: white;
    text-align: center;
    line-height: 35px;
  }

  footer {
    position: fixed;
    bottom: 0px;
    left: 0px;
    right: 0px;
    height: 0px;

    /** Extra personal styles **/
    background-color: #03a9f4;
    color: white;
    text-align: center;
    line-height: 35px;
  }

  .table-striped tbody tr:nth-of-type(even) {
    background-color: rgba(0, 0, 0, .05)
  }

  .table-dark.table-striped tbody tr:nth-of-type(even) {
    background-color: rgba(255, 255, 255, .05)
  }
</style>
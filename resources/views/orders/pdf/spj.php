<?php foreach ($orderdetail as $key => $value) {
  $key = $key + 1;
?>
  <table>
    <tr>
      <td>
        <table width="100%" class="">
          <tr width="100%">
            <td rowspan="6" width="18%">
              <img src="Picture1.png" alt="Logo" width="125px" />
            </td>
            <td></td>
            <td rowspan="6" width="18%"></td>
          </tr>
          <tr style="line-height:15px; font-size: 18px; text-align: center">
            <td width="50%">
              <strong>KAIZEN TRANS INDONESIA</strong>
            </td>
          </tr>
          <tr style="line-height:15px; font-size: 13px; text-align: center">
            <td width="50%">
              Jalan Mekar Baru 1 No. 19 RT 01/006 Cirendeu
            </td>
          </tr>
          <tr style="line-height:15px; font-size: 13px; text-align: center">
            <td width="50%">
              Ciputat Timur, Tangerang Selatan
            </td>
          </tr>
          <tr style="line-height:15px; font-size: 13px; text-align: center">
            <td width="60%">
              Phone: (021) 7404424 / 0812 1044 5144
            </td>
          </tr>
          <tr style="line-height:15px; font-size: 13px; text-align: center">
            <td width="60%">
              Email: marketingkaizenrent@gmail.com
            </td>
          </tr>
        </table>
        <hr style="border-top: 3px; border-style: double">
        <br />
        <table width="100%">
          <tr>
            <td colspan="2" style="text-align: center; font-size: 18px"><b><u>SURAT PERINTAH JALAN</u></b></td>
          </tr>
          <tr>
            <td style="text-align: center" colspan="2">
              <?php echo 'No : ' . $orders->id_invoice . '-' . $key . '/SPJ/KSA/' . substr($orders->created_at, 5, 2) . '/' . substr($orders->created_at, 0, 4) ?>
            </td>
          </tr>
        </table>
        <br />
        <br />
        <table>
          <tr>
            <td width="5%"></td>
            <td>
              Yang bertanda tangan dibawah ini, menugaskan :
            </td>
          </tr>
        </table>
        <br />
        <table>
          <tr>
            <td width="5%"></td>
            <td></td>
            <td></td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              Nama
            </td>
            <td width="70%">
              : <?php echo ucwords(strtolower(\App\Models\Master\DriverModel::find($value->id_driver)->nama)) ?>
            </td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              Alamat
            </td>
            <td width="70%">
              : <?php echo ucwords(strtolower(\App\Models\Master\DriverModel::find($value->id_driver)->alamat)) ?>
            </td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              No. Telpon
            </td>
            <td width="70%">
              : <?php echo ucwords(strtolower(\App\Models\Master\DriverModel::find($value->id_driver)->no_telp)) ?>
            </td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              Tanggal Berakhir SIM
            </td>
            <td width="70%">
              : <?php echo \App\Helpers\Tanggal::Indo(\App\Models\Master\DriverModel::find($value->id_driver)->sim) ?>
            </td>
          </tr>
        </table>
        <br />
        <table>
          <tr>
            <td width="5%"></td>
            <td>
              Untuk Melayani Tn./Ny.
            </td>
          </tr>
        </table>
        <br />
        <table>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              Nama
            </td>
            <td width="65%">
              : <?php echo ucwords(strtolower($value->pic)) ?>
            </td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              No. Telpon
            </td>
            <td width="70%">
              : <?php echo $value->hp_pic ?>
            </td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              Alamat Penjemputan
            </td>
            <td width="70%">
              : <?php echo ucwords(strtolower($value->jemput)) ?>
            </td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              Alamat Penjemputan
            </td>
            <td width="70%">
              : <?php echo ucwords(strtolower($value->jemput)) ?>
            </td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              Tanggal Penjemputan
            </td>
            <td width="70%">
              : <?php echo \App\Helpers\Tanggal::Indo($value->start_date) ?>
            </td>
          </tr>
          <tr width="100%">
            <td width="5%"></td>
            <td width="30%">
              Waktu Penjemputan
            </td>
            <td width="70%">
              : <?php echo $value->start_time ?>
            </td>
          </tr>
        </table>
        <br />
        <table>
          <tr>
            <td width="5%"></td>
            <td>
              Sesuai dengan permintaan tersebut, maka pengemudi akan melayani selama
              <?php echo date_diff(date_create($value->start_date), date_add(date_create($value->finish_date), date_interval_create_from_date_string("1 days")))->format('%a') ?>
              hari hingga tanggal <?php echo \App\Helpers\Tanggal::Indo($value->finish_date) ?>.
            </td>
          </tr>
        </table>
        <br />
        <table>
          <tr>
            <td style="text-align: center">
              Tangerang Selatan, <?php echo \App\Helpers\Tanggal::Indo(date('Y-m-d')) ?>
            </td>
          </tr>
          <tr>
            <td style="text-align: center">
              Kaizen Trans Indonesia
            </td>
          </tr>
        </table>
        <br />
        <br />
        <br />
        <table>
          <tr>
            <td style="text-align: center"><b><u>Ikhsan</u></b></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
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
    margin: 50px 50px;
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
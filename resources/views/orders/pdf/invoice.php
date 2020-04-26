<table>
  <tr>
    <td>
      <table width="100%">
        <tr width="100%">
          <td rowspan="6" width="18%">
            <img src="Picture1.png" alt="Logo" width="125px" />
          </td>
        </tr>
        <tr style="line-height:10px; font-size: 14px">
          <td width="50%">
            <strong>KAIZEN TRANS INDONESIA</strong>
          </td>
          <td width="50%" style="text-align: right;">
          </td>
        </tr>
        <tr style="line-height:10px; font-size: 12px">
          <td width="50%">
            Jalan Mekar Baru 1 No. 19 RT 01/006
          </td>
          <td style="text-align: right;">
            Rent Of Car
          </td>
        </tr>
        <tr style="line-height:10px; font-size: 12px">
          <td width="60%">
            Cirendeu - Ciputat Timur, Tangerang Selatan
          </td>
          <td style="text-align: right;">
            Tour / Wisata
          </td>
        </tr>
        <tr style="line-height:10px; font-size: 12px">
          <td width="60%">
            Phone: (021) 7404424 / 0812 1044 5144
          </td>
          <td style="text-align: right;">
            Transportation Services
          </td>
        </tr>
        <tr style="line-height:10px; font-size: 12px">
          <td width="60%">
            Email: marketingkaizenrent@gmail.com
          </td>
          <td style="text-align: right;">
            Transportation Investment
          </td>
        </tr>
      </table>

      <table>
        <tr>
          <td style="line-height:5px">
            <hr>
          </td>
        </tr>
        <tr>
          <td style="text-align: center; line-height: 10px; font-size: 16px">INVOICE</td>
        </tr>
        <tr>
          <td style=" line-height:5px">
            <hr>
          </td>
        </tr>
      </table>

      <table width="100%">
        <tbody>
          <tr style=" line-height:12px; font-size: 13px">
            <td width="20%">
              <div>
                No. Invoice
              </div>
            </td>
            <td width="35%">
              <div>
                :
                <?php echo $orders->id_invoice . "/KSA-INV" . "/" . substr($orders->created_at, 5, 2) . "/" . substr($orders->created_at, 0, 4) ?>
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
          <tr style=" line-height:12px; font-size: 13px">
            <td>
              <div>
                Kepada
              </div>
            </td>
            <td>
              <div>
                : <?php echo $orders->nama_pelanggan ?>
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
          <tr style="line-height:12px; font-size: 13px">
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
      <br />
      <table width="100%" style="font-size: 13px; border-style: solid; border-width: 1px" class="table-striped">
        <thead>
          <tr width="100%" style="line-height:15px; background-color: red; color: white;">
            <th width="5%" style="text-align: center; ">No. </th>
            <th width="20%" style="text-align: center;">Merk Tipe Mobil</th>
            <th width="15%" style="text-align: center;">Tanggal Mulai</th>
            <th width="15%" style="text-align: center;">Tanggal Berakhir</th>
            <th width="15%" style="text-align: center;">Jumlah Hari</th>
            <th width="15%" style="text-align: center;">Harga Satuan</th>
            <th width="15%" style="text-align: center;">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orderdetail as $indexKey => $item) { ?>
            <tr style="line-height:20px" width="100%">
              <td style="text-align: center;">
                <div><?php echo $indexKey + 1 ?></div>
              </td>
              <td style="text-align: center;">
                <?php echo \App\Models\Master\MobilModel::find($item->id_mobil)->first()->no_polisi ?> -
                <?php echo \App\Models\Master\MobilModel::find($item->id_mobil)->first()->merk ?>
                <?php echo \App\Models\Master\MobilModel::find($item->id_mobil)->first()->tipe ?></td>
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
              <td style="text-align: center;"><?php echo App\Helpers\Tanggal::rp($item->total_tagihan) ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <table style="line-height:8px; font-size: 13px">
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
          <tr style="line-height:15px">
            <td>Note :</td>
            <td colspan="3" rowspan="2" style="border-style: solid; border-width: 1px; background-color: rgba(0, 0, 0, .05); padding: 3px" valign="top" width="60%">
              <?php echo $orders->note ?>
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
          <tr style="line-height:15px">
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
          <tr style="line-height:15px">
            <td width="5%" rowspan="2">Terbilang</td>
            <td colspan="3" rowspan="2">:<b><i> <?php
                                                $total = 0;
                                                foreach ($orderdetail as $key => $value) {
                                                  $total += $value->total_tagihan;
                                                }
                                                echo ucwords(\App\Helpers\Tanggal::terbilang($total)); ?>
                  Rupiah</i></b>
            </td>
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
          <tr style="line-height:15px">
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
      <table width="100%">
        <tr style="line-height:15px; font-size: 12px" width="100%">
          <td width="5%"></td>
          <td width="60%" valign="top" style="border-style: solid; border-width: 1px">
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
    </td>
  </tr>
</table>

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
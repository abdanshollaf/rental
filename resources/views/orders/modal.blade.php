{{-- Add Data Modal --}}
<div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                     <form role="form" action="" method="POST">
                          @csrf
                          <div class="card-body">
                            <div class="row">
                                  <div class="form-group col-sm-3">
                                    <div class="col-sm-12">
                                        <label for="nama">Nama Pelanggan</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name" required>
                                    </div>
                                  </div>
                                  <div class="form-group col-sm-3">
                                      <div class="col-sm-12">
                                        <label for="tipe">Tipe Pelanggan</label>
                                        <select name="tipe" id="tipe" class="form-control" required>
                                                <option value="">-- Select Tipe Pelanggan --</option>
                                                <?php
                                                $tipes = \App\Models\Master\TipePelangganModel::get();
                                                ?>
                                                @foreach ($tipes as $item)
                                                    <option value="{{$item->id}}">{{$item->nama_tipe_pelanggan}}</option>
                                                @endforeach
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group col-sm-3">
                                      <div class="col-sm-12">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>      
                                      </div>
                                  </div>
                                  <div class="form-group col-sm-3">
                                      <div class="col-sm-12">
                                            <label for="no_telp">No. Telp</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Enter Phone Number" required>      
                                      </div>
                                  </div>
                                  <div class="form-group col-sm-6">
                                        <div class="col-sm-12">
                                              <label for="alamat">Alamat</label>
                                              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Phone Number" required>      
                                        </div>
                                    </div>
                                  <div class="form-group col-sm-3">
                                      <div class="col-sm-12">
                                        <label for="tgl">Tanggal Lahir</label>
                                        <div class="input-group date" id="tgl_lahir" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" placeholder="Enter Date Of Birth" data-target="#tgl_lahir" data-toggle="datetimepicker" id="tgl_lahir"/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <div class="col-sm-12">
                                                <label for="mobil">Tipe Mobil</label>
                                                <select name="mobil" id="mobil" class="form-control" required>
                                                    <option value="">-- Select Kendaraan --</option>
                                                    <?php
                                                    $mobil = \App\Models\Master\MobilModel::get();
                                                    ?>
                                                    @foreach ($mobil as $item)
                                                        <option value="{{$item->id}}">{{$item->merk}} - {{$item->tipe}} - {{$item->no_polisi}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                  </div>
                                  <div class="form-group col-sm-2">
                                      <div class="col-sm-12">
                                            <label for="driver">Driver</label>
                                            <select name="driver" id="driver" class="form-control" required>
                                                <option value="">-- Select Driver --</option>
                                                <?php
                                                $driver = \App\Models\Master\DriverModel::get();
                                                ?>
                                                @foreach ($driver as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                      </div>
                                  </div>
                                  <div class="form-group col-sm-5">
                                      <div class="col-sm-12">
                                            <label for="jemput">Alamat Penjemputan</label>
                                            <input type="text" class="form-control" id="jemput" name="jemput" placeholder="Enter Departure Address" required>      
                                      </div>
                                  </div>
                                  <div class="form-group col-sm-5">
                                      <div class="col-sm-12">
                                            <label for="tujuan">Tujuan</label>
                                            <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Enter Arrival Address" required>
                                      </div>
                                  </div>
                                  <div class="form-group col-sm-5">
                                        <label for="telp">Tanggal Booking</label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group date" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" placeholder="Start Date" data-target="#start_date" data-toggle="datetimepicker" id="start_date"/>
                                                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fas fa-arrow-right"></i></div>
                                                    </div>
                                                    <input type="text" class="form-control datetimepicker-input" placeholder="End Date" data-target="#end_Date" data-toggle="datetimepicker" id="end_date"/>
                                                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>                                                                  
                                    </div>
                                     <div class="form-group col-sm-4">
                                        <label for="telp">Jam Booking</label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="input-group date" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" placeholder="Start Time" data-target="#start_time" data-toggle="datetimepicker" id="start_time"/>
                                                        <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fas fa-arrow-right"></i></div>
                                                    </div>
                                                    <input type="text" class="form-control datetimepicker-input" placeholder="End Time" data-target="#end_time" data-toggle="datetimepicker" id="end_time"/>
                                                    <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>    
                                    </div>
                                  <div class="form-group col-sm-3">
                                      <div class="col-sm-12">
                                            <label for="telp">Harga Sewa Sementara</label>
                                            <input type="text" class="form-control" id="telp" name="telp" placeholder="Enter Phone Number" required>      
                                      </div>
                                  </div>
                                  
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                        Add
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                        Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>
      
      
      <script type="text/javascript">
        // add a new post
        $(document).on('click', '.add-modal', function() {
            // Empty input fields
            $('#vendor').val('');
            $('#no_polisi').val('');
            $('#merk').val('');
            $('#tipe').val('');
            $('.modal-title').text('Add Data Booking Order');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                      }
                  });
            $.ajax({
                type: 'POST',
                url: '/order/store',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nama': $('#nama').val(),
                    'tipe': $('#tipe').val(),
                    'email': $('#email').val(),
                    'no_telp': $('#no_telp').val(),
                    'alamat': $('#alamat').val(),
                    'tgl_lahir': $('#tgl_lahir').datetimepicker({
                                      format: 'YYYY-MM-DD',
                                      viewMode: 'years',
                                  }),
                    'mobil': $('#mobil').val(),
                    'driver': $('#driver').val(),
                    'jemput': $('#jemput').val(),
                    'tujuan': $('#tujuan').val(),
                    'start_date': $('#start_date').datetimepicker({
                                      format: 'YYYY-MM-DD',
                                  }),
                    'end_date': $('#end_date').datetimepicker({
                                      format: 'YYYY-MM-DD',
                                      viewMode: 'years',
                                  }),
                    'start_time': $('#start_time').datetimepicker({
                                      format: 'YYYY-MM-DD',
                                      viewMode: 'years',
                                  }),
                    'end_time': $('#end_time').datetimepicker({
                                      format: 'YYYY-MM-DD',
                                      viewMode: 'years',
                                  }),
                    'harga': $('#harga').val()
                },
                success: function(data) {
                    $('.errorNama').addClass('invisible');
                    $('.errorTipe').addClass('invisible');
                    $('.errorEmail').addClass('invisible');
                    $('.errorNo_telp').addClass('invisible');
                    $('.errorAlamat').addClass('invisible');
                    $('.errorTgl_lahir').addClass('invisible');
                    $('.errorMobil').addClass('invisible');
                    $('.errorDriver').addClass('invisible');
                    $('.errorJemput').addClass('invisible');
                    $('.errorTujuan').addClass('invisible');
                    $('.errorStart_date').addClass('invisible');
                    $('.errorEnd_date').addClass('invisible');
                    $('.errorStart_time').addClass('invisible');
                    $('.errorEnd_time').addClass('invisible');
                    $('.errorHarga').addClass('invisible');
      
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);
      
                        if (data.errors.vendor) {
                            $('.errorVendor').removeClass('invisible');
                            $('.errorVendor').text(data.errors.vendor);
                        }
                        if (data.errors.no_polisi) {
                            $('.errorPolisi').removeClass('invisible');
                            $('.errorPolisi').text(data.errors.no_polisi);
                        }
                        if (data.errors.merk) {
                            $('.errorMerk').removeClass('invisible');
                            $('.errorMerk').text(data.errors.merk);
                        }
                        if (data.errors.tipe) {
                            $('.errorTipe').removeClass('invisible');
                            $('.errorTipe').text(data.errors.tipe);
                        }
                    }
                    else {
                        if (!data) {
                            alert('empty');
                            toastr.error('Error added Consumer! No Data Entry!', 'Error Alert', {timeOut: 5000});
                        } else {
                            toastr.success('Successfully added Car!', 'Success Alert', {timeOut: 5000});
                            $('#example1').prepend("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.vendor + "</td><td>" + data.no_polisi + "</td><td>" + data.merk + "</td><td>" + data.tipe + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-vendor='" + data.vendor + "' data-no_polisi='" + data.no_polisi + "' data-merk='" + data.merk + "' data-tipe='" + data.tipe + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-vendor='" + data.vendor + "' data-no_polisi='" + data.no_polisi + "' data-merk='" + data.merk + "' data-tipe='" + data.tipe + "'>Delete</button></td></tr>");
                            $('.col1').each(function (index) {
                            $(this).html(index+1);
                        }); 
                        }
                    }
                },
            });
        });
      </script>
      
      {{-- Edit Data Modal --}}
      <div id="editModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                         <form role="form" action="" method="POST">
                              @csrf
                              <div class="card-body">
                                <div class="row">
                                      <div class="form-group col-sm-3">
                                        <div class="col-sm-12">
                                            <label for="nama">Nama Pelanggan</label>
                                            <input type="text" class="form-control" id="namaEdit" name="namaEdit" placeholder="Enter Name" required>
                                        </div>
                                      </div>
                                      <div class="form-group col-sm-3">
                                            <div class="col-sm-12">
                                              <label for="tipe">Tipe Pelanggan</label>
                                              <select name="tipeEdit" id="tipeEdit" class="form-control" required>
                                                      <option value="">-- Select Tipe Pelanggan --</option>
                                                      <?php
                                                      $tipes = \App\Models\Master\TipePelangganModel::get();
                                                      ?>
                                                      @foreach ($tipes as $item)
                                                          <option value="{{$item->id}}">{{$item->nama_tipe_pelanggan}}</option>
                                                      @endforeach
                                              </select>
                                            </div>
                                        </div>
                                      <div class="form-group col-sm-3">
                                          <div class="col-sm-12">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="emailEdit" name="emailEdit" placeholder="Enter Email" required>      
                                          </div>
                                      </div>
                                      <div class="form-group col-sm-3">
                                          <div class="col-sm-12">
                                                <label for="telp">No. Telp</label>
                                                <input type="text" class="form-control" id="telpEdit" name="telpEdit" placeholder="Enter Phone Number" required>      
                                          </div>
                                      </div>
                                      <div class="form-group col-sm-6">
                                            <div class="col-sm-12">
                                                  <label for="alamat">Alamat</label>
                                                  <input type="text" class="form-control" id="alamatEdit" name="alamatEdit" placeholder="Enter Phone Number" required>      
                                            </div>
                                        </div>
                                      <div class="form-group col-sm-3">
                                          <div class="col-sm-12">
                                            <label for="tgl">Tanggal Lahir</label>
                                            <div class="input-group date" id="tgl_lahirEdit" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" placeholder="Enter Date Of Birth" data-toggle="datetimepicker" data-target="#tgl_lahirEdit"/>
                                                <div class="input-group-append" data-target="#tgl_lahirEdit" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                $(function () {
                                                    $('#tgl_lahir').datetimepicker({
                                                        format: 'L',
                                                        viewMode: 'years',
                                                    });
                                                });
                                            </script>
                                        </div>
                                          </div>
                                          <div class="form-group col-sm-3">
                                                <div class="col-sm-12">
                                                        <label for="mobil">Tipe Mobil</label>
                                                        <select name="mobilEdit" id="mobilEdit" class="form-control" required>
                                                            <option value="">-- Select Kendaraan --</option>
                                                            <?php
                                                            $mobil = \App\Models\Master\MobilModel::get();
                                                            ?>
                                                            @foreach ($mobil as $item)
                                                                <option value="{{$item->id}}">{{$item->merk}} - {{$item->tipe}} - {{$item->no_polisi}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                          </div>
                                          <div class="form-group col-sm-3">
                                              <div class="col-sm-12">
                                                    <label for="driver">Driver</label>
                                                    <select name="driverEdit" id="driverEdit" class="form-control" required>
                                                        <option value="">-- Select Driver --</option>
                                                        <?php
                                                        $driver = \App\Models\Master\DriverModel::get();
                                                        ?>
                                                        @foreach ($driver as $item)
                                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                                        @endforeach
                                                    </select>
                                              </div>
                                          </div>
                                      <div class="form-group col-sm-3">
                                          <div class="col-sm-12">
                                                <label for="jemputEdit">Alamat Penjemputan</label>
                                                <input type="text" class="form-control" id="jemputEdit" name="jemputEdit" placeholder="Enter Departure Address" required>      
                                          </div>
                                      </div>
                                      <div class="form-group col-sm-3">
                                          <div class="col-sm-12">
                                                <label for="tujuan">Tujuan</label>
                                                <input type="text" class="form-control" id="tujuanEdit" name="tujuanEdit" placeholder="Enter Arrival Address" required>
                                          </div>
                                      </div>
                                      <div class="form-group col-sm-5">
                                            <label for="telp">Tanggal Booking</label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="input-group date" data-target-input="nearest">
                                                        <input type="text" id="start_dateEdit" name="start_dateEdit" class="form-control datetimepicker-input" placeholder="Start Date" data-toggle="datetimepicker" data-target="#start_dateEdit"/>
                                                        <div class="input-group-append" data-target="#start_dateEdit" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            <div class="input-group-text"><i class="fas fa-arrow-right"></i></div>
                                                        </div>
                                                        <input type="text" id="end_dateEdit" name="end_dateEdit" class="form-control datetimepicker-input" placeholder="End Date" data-toggle="datetimepicker" data-target="#end_dateEdit"/>
                                                        <div class="input-group-append" data-target="#end_dateEdit" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        $(function () {
                                                            $('#start_date').datetimepicker({
                                                                format: 'L',
                                                            });
                                                            $('#end_date').datetimepicker({
                                                                format: 'L',
                                                            });
                                                        });
                                                    </script>
                                                </div> 
                                            </div>                                                                  
                                        </div>
                                         <div class="form-group col-sm-4">
                                            <label for="telp">Jam Booking</label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="input-group date" data-target-input="nearest">
                                                        <input type="text" id="start_timeEdit" name="start_timeEdit" class="form-control datetimepicker-input" placeholder="Start Time" data-toggle="datetimepicker" data-target="#start_timeEdit"/>
                                                        <div class="input-group-append" data-target="#start_timeEdit" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                                            <div class="input-group-text"><i class="fas fa-arrow-right"></i></div>
                                                        </div>
                                                        <input type="text" id="end_timeEdit" name="end_timeEdit" class="form-control datetimepicker-input" placeholder="End Time" data-toggle="datetimepicker" data-target="#end_timeEdit"/>
                                                        <div class="input-group-append" data-target="#end_timeEdit" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        $(function () {
                                                            $('#start_time').datetimepicker({
                                                                format: 'LT',
                                                            });
                                                            $('#end_time').datetimepicker({
                                                                format: 'LT',
                                                            });
                                                        });
                                                    </script>
                                                </div> 
                                            </div>    
                                        </div>
                                      <div class="form-group col-sm-3">
                                          <div class="col-sm-12">
                                                <label for="hargaEdit">Harga Sewa</label>
                                                <input type="text" class="form-control" id="hargaEdit" name="hargaEdit" placeholder="Enter Phone Number" required>      
                                          </div>
                                      </div>
                                      
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success edit" data-dismiss="modal">
                            Add
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                            Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
      
      
      <script type="text/javascript">
      $(document).on('click', '.edit-modal', function() {
                $('.modal-title').text('Edit Data Kendaraan');
                $('#vendor_edit').val($(this).data('vendor'));
                $('#no_polisi_edit').val($(this).data('no_polisi'));
                $('#merk_edit').val($(this).data('merk'));
                $('#tipe_edit').val($(this).data('tipe'));
                id = $(this).data('id');
                $('#editModal').modal('show');
            });
            
            $('.modal-footer').on('click', '.edit', function() {
                $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                      }
                  });
                $.ajax({
                    type: 'POST',
                    url: '/master/mobil/update/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'vendor': $('#vendor_edit').val(),
                        'no_polisi': $('#no_polisi_edit').val(),
                        'merk': $('#merk_edit').val(),
                        'tipe': $('#tipe_edit').val()
                    },
                    success: function(data) {
                        $('.errorEditVendor').addClass('hidden');
                        $('.errorEditPolisi').addClass('hidden');
                        $('.errorEditMerk').addClass('hidden');
                        $('.errorEditTipe').addClass('hidden');
      
                        if ((data.errors)) {
                            setTimeout(function () {
                                $('#editModal').modal('show');
                                toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                            }, 500);
      
                            if (data.errors.vendor) {
                                $('.errorEditVendor').removeClass('invisible');
                                $('.errorEditVendor').text(data.errors.vendor);
                            }
                            if (data.errors.no_polisi) {
                                $('.errorEditPolisi').removeClass('invisible');
                                $('.errorEditPolisi').text(data.errors.no_polisi);
                            }
                            if (data.errors.merk) {
                                $('.errorEditMerk').removeClass('invisible');
                                $('.errorEditMerk').text(data.errors.merk);
                            }
                            if (data.errors.tipe) {
                                $('.errorEditTipe').removeClass('invisible');
                                $('.errorEditTipe').text(data.errors.tipe);
                            }
                        } else {
                            toastr.success('Successfully updated Car Data!', 'Success Alert', {timeOut: 5000});
                            $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.vendor + "</td><td>" + data.no_polisi + "</td><td>" + data.merk + "</td><td>" + data.tipe + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-vendor='" + data.vendor + "' data-no_polisi='" + data.no_polisi + "' data-merk='" + data.merk + "' data-tipe='" + data.tipe + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-vendor='" + data.vendor + "' data-no_polisi='" + data.no_polisi + "' data-merk='" + data.merk + "' data-tipe='" + data.tipe + "'>Delete</button></td></tr>");
                            $('.col1').each(function (index) {
                                $(this).html(index+1);
                            });
                        }
                    }
                });
            });
        </script>
      
      
      {{-- Delete Data Modal --}}
      <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you sure you want to delete ?</h3>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Delete
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
      <script type="text/javascript">
      $(document).on('click', '.delete-modal', function() {
        $('.modal-title').text('Delete Data Driver');
        $('#deleteModal').modal('show');
        id = $(this).data('id');
      });
      $('.modal-footer').on('click', '.delete', function() {
        $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                      }
                  });
        $.ajax({
            type: 'GET',
            url: 'delete/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                toastr.success('Successfully deleted Car!', 'Success Alert', {timeOut: 5000});
                $('.item' + id).remove();
                $('.col1').each(function (index) {
                    $(this).html(index+1);
                });
            }
        });
      });
      </script>
{{-- Add Data Modal --}}
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="nama">Nama Vendor :</label>
                            <select name="vendor" id="vendor" class="form-control">
                                <option value="">-- Select Vendor --</option>
                                <?php
                                $mobil = \App\Models\Master\VendorModel::get();
                                ?>
                                @foreach ($mobil as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                            <p class="errorVendor text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="nama">Kategori Kendaraan :</label>
                            <select name="tipe_mobil" id="tipe_mobil" class="form-control">
                                <option value="">-- Select Kategori --</option>
                                <?php
                                $kategori = \App\Models\Master\TipeMobilModel::get();
                                ?>
                                @foreach ($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama_tipe}}</option>
                                @endforeach
                            </select>
                            <p class="errorVendor text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="no_polisi">Nomor Polisi :</label>
                            <input type="text" class="form-control" id="no_polisi" autofocus required>
                            <p class="errorPolisi text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="merk">Merk Kendaraan : </label>
                            <input type="text" class="form-control" id="merk" autofocus required>
                            <p class="errorMerk text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="jenis">Tipe Kendaraan :</label>
                            <input type="text" class="form-control" id="tipe" autofocus required>
                            <p class="errorTipe text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="stnk">Masa Berlaku STNK :</label>
                            <input type="text" class="form-control datetimepicker-input" placeholder="Enter Date" data-target="#stnk" data-toggle="datetimepicker" id="stnk" />
                            <p class="errorStnk text-center alert alert-danger invisible"></p>
                        </div>
                    </div>
                </form>
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


<script type="text/javascript">
    // add a new post
    $(document).on('click', '.add-modal', function() {
        // Empty input fields
        $('#vendor').val('');
        $('#tipe_mobil').val('');
        $('#stnk').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years',
        });
        $('#no_polisi').val('');
        $('#merk').val('');
        $('#tipe').val('');
        $('.modal-title').text('Add Data Kendaraan');
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
            url: '/master/mobil/store',
            data: {
                '_token': $('input[name=_token]').val(),
                'vendor': $('#vendor').val(),
                'tipe_mobil': $('#tipe_mobil').val(),
                'no_polisi': $('#no_polisi').val(),
                'merk': $('#merk').val(),
                'tipe': $('#tipe').val(),
                'stnk': $('#stnk').val(),
            },
            success: function(data) {
                $('.errorVendor').addClass('invisible');
                $('.errorPolisi').addClass('invisible');
                $('.errorMerk').addClass('invisible');
                $('.errorTipe').addClass('invisible');

                if ((data.errors)) {
                    setTimeout(function() {
                        $('#addModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {
                            timeOut: 5000
                        });
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
                } else {
                    if (!data) {
                        alert('empty');
                        toastr.error('Error added Consumer! No Data Entry!', 'Error Alert', {
                            timeOut: 5000
                        });
                    } else {
                        toastr.success('Successfully added Car!', 'Success Alert', {
                            timeOut: 5000
                        });
                        $('#example1').prepend("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.vendor + "</td><td>" + data.no_polisi + "</td><td>" + data.merk + "</td><td>" + data.tipe + "</td><td> <?php $tipe2 = App\Models\Master\TipeMobilModel::all()->where('id', '=', " + data.tipe_mobil + "); ?> @foreach ($tipe2 as $items) <div>{{$items->nama_tipe}}</div> @endforeach</td><td>" + data.stnk + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-vendor='" + data.vendor + "' data-no_polisi='" + data.no_polisi + "' data-merk='" + data.merk + "' data-tipe='" + data.tipe + "' data-kategori='" + data.tipe_mobil + "' data-stnk='" + data.stnk + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-vendor='" + data.vendor + "' data-no_polisi='" + data.no_polisi + "' data-merk='" + data.merk + "' data-tipe='" + data.tipe + "' data-kategori='" + data.tipe_mobil + "' data-stnk='" + data.stnk + "'>Delete</button></td></tr>");
                        $('.col1').each(function(index) {
                            $(this).html(index + 1);
                        });
                    }
                }
            },
        });
    });
</script>

{{-- Edit Data Modal --}}
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="nama">Nama Vendor :</label>
                            <select name="vendor" id="vendor_edit" class="form-control">
                                <option value="">-- Select Vendor --</option>
                                <?php
                                $mobil = \App\Models\Master\VendorModel::get();
                                ?>
                                @foreach ($mobil as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                            <p class="errorEditVendor text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="nama">Kategori Kendaraan :</label>
                            <select name="tipe_mobilEdit" id="tipe_mobilEdit" class="form-control">
                                <option value="">-- Select Kategori --</option>
                                <?php
                                $kategori = \App\Models\Master\TipeMobilModel::get();
                                ?>
                                @foreach ($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama_tipe}}</option>
                                @endforeach
                            </select>
                            <p class="errorEditKategori text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="no_polisi">Nomor Polisi :</label>
                            <input type="text" class="form-control" id="no_polisi_edit" autofocus required>
                            <p class="errorEditPolisi text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="merk">Merk Kendaraan : </label>
                            <input type="text" class="form-control" id="merk_edit" autofocus required>
                            <p class="errorEditMerk text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="jenis">Tipe Kendaraan :</label>
                            <input type="text" class="form-control" id="tipe_edit" autofocus required>
                            <p class="errorEditTipe text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="stnk">Masa Berlaku STNK :</label>
                            <input type="text" class="form-control datetimepicker-input" placeholder="Enter Date" data-target="#stnk" data-toggle="datetimepicker" id="stnkEdit" />
                            <p class="errorEditStnk text-center alert alert-danger invisible"></p>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                        Edit
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).on('click', '.edit-modal', function() {
        $('.modal-title').text('Edit Data Kendaraan');
        $('#vendor_edit').val($(this).data('vendor'));
        $('#tipe_mobilEdit').val($(this).data('tipe_mobil'));
        $('#no_polisi_edit').val($(this).data('no_polisi'));
        $('#merk_edit').val($(this).data('merk'));
        $('#tipe_edit').val($(this).data('tipe'));
        $('#stnk').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years',
        });
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
                'vendor': $('#vendor').val(),
                'tipe_mobil': $('#tipe_mobil').val(),
                'no_polisi': $('#no_polisi').val(),
                'merk': $('#merk').val(),
                'tipe': $('#tipe').val(),
                'stnk': $('#stnk').val(),
            },
            success: function(data) {
                $('.errorEditVendor').addClass('hidden');
                $('.errorEditPolisi').addClass('hidden');
                $('.errorEditMerk').addClass('hidden');
                $('.errorEditTipe').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function() {
                        $('#editModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {
                            timeOut: 5000
                        });
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
                    toastr.success('Successfully updated Car Data!', 'Success Alert', {
                        timeOut: 5000
                    });
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.vendor + "</td><td>" + data.no_polisi + "</td><td>" + data.merk + "</td><td>" + data.tipe + "</td><td>" + data.tipe_mobil + "</td><td>" + data.stnk + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-vendor='" + data.vendor + "' data-no_polisi='" + data.no_polisi + "' data-merk='" + data.merk + "' data-tipe='" + data.tipe + "' data-tipe_mobil='" + data.tipe_mobil + "' data-stnk='" + data.stnk + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-vendor='" + data.vendor + "' data-no_polisi='" + data.no_polisi + "' data-merk='" + data.merk + "' data-tipe='" + data.tipe + "' data-tipe_mobil='" + data.tipe_mobil + "' data-stnk='" + data.stnk + "'>Delete</button></td></tr>");
                    $('.col1').each(function(index) {
                        $(this).html(index + 1);
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
            500: function(data) {
                toastr.error('Failed deleted  Car!', 'Error Alert', {
                    timeOut: 5000
                });
            },
            200: function(data) {
                toastr.success('Successfully deleted Car!', 'Success Alert', {
                    timeOut: 5000
                });
                $('.item' + id).remove();
                $('.col1').each(function(index) {
                    $(this).html(index + 1);
                });
            }
        });
    });
</script>
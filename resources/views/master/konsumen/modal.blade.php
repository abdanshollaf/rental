{{-- Add Data Modal --}}
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label" for="nama">Nama Pelanggan :</label>
                            <input type="text" class="form-control" id="nama" autofocus required>
                            <p class="errorNama text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="tipe">Tipe Pelanggan :</label>
                            <select name="tipe" id="tipe" class="form-control">
                                <option value="">-- Select Tipe Pelanggan --</option>
                                <?php
                                $tipes = \App\Models\Master\TipePelangganModel::get();
                                ?>
                                @foreach ($tipes as $item)
                                <option value="{{$item->id}}">{{$item->nama_tipe_pelanggan}}</option>
                                @endforeach
                            </select>
                            <p class="errorTipe text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="email">Email :</label>
                            <input type="text" class="form-control" id="email" autofocus required>
                            <p class="errorEmail text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="alamat">Alamat :</label>
                            <input type="text" class="form-control" id="alamat" autofocus required>
                            <p class="errorAlamat text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="no_telp">No. Telp :</label>
                            <input type="text" class="form-control" id="no_telp" autofocus required>
                            <p class="errorNo_telp text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir :</label>
                            <input type="text" class="form-control datetimepicker-input" placeholder="Enter Date Of Birth" data-target="#tgl_lahir" data-toggle="datetimepicker" id="tgl_lahir" />
                        </div>
                        <p class="errorTgl_lahir text-center alert alert-danger invisible"></p>
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
        $('#nama').val('');
        $('#tipe').val('');
        $('#email').val('');
        $('#alamat').val('');
        $('#no_telp').val('');
        $('#tgl_lahir').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years',
        });
        $('.modal-title').text('Add Data Konsumen');
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
            url: '/master/konsumen/store',
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#nama').val(),
                'tipe': $('#tipe').val(),
                'email': $('#email').val(),
                'alamat': $('#alamat').val(),
                'no_telp': $('#no_telp').val(),
                'tgl_lahir': $('#tgl_lahir').val()
            },
            success: function(data) {
                $('.errorNama').addClass('invisible');
                $('.errorTipe').addClass('invisible');
                $('.errorEmail').addClass('invisible');
                $('.errorAlamat').addClass('invisible');
                $('.errorNo_telp').addClass('invisible');
                $('.errorTgl_lahir').addClass('invisible');

                if ((data.errors)) {
                    setTimeout(function() {
                        $('#addModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {
                            timeOut: 5000
                        });
                    }, 500);

                    if (data.errors.nama) {
                        $('.errorNama').removeClass('invisible');
                        $('.errorNama').text(data.errors.nama);
                    }
                    if (data.errors.tipe) {
                        $('.errorTipe').removeClass('invisible');
                        $('.errorTipe').text(data.errors.tipe);
                    }
                    if (data.errors.email) {
                        $('.errorEmail').removeClass('invisible');
                        $('.errorEmail').text(data.errors.email);
                    }
                    if (data.errors.alamat) {
                        $('.errorAlamat').removeClass('invisible');
                        $('.errorAlamat').text(data.errors.alamat);
                    }
                    if (data.errors.no_telp) {
                        $('.errorNo_telp').removeClass('invisible');
                        $('.errorNo_telp').text(data.errors.no_telp);
                    }
                    if (data.errors.tgl_lahir) {
                        $('.errorTgl_lahir').removeClass('invisible');
                        $('.errorTgl_lahir').text(data.errors.tgl_lahir);
                    }
                } else {
                    if (!data) {
                        alert('empty');
                        toastr.error('Error added Consumer! No Data Entry!', 'Error Alert', {
                            timeOut: 5000
                        });
                    } else {
                        toastr.success('Successfully added Consumer!', 'Success Alert', {
                            timeOut: 5000
                        });
                        $('#example2').prepend("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.nama_pelanggan + "</td><td>" + data.nama_tipe_pelanggan + "</td><td>" + data.email + "</td><td>" + data.alamat + "</td><td>" + data.no_telp + "</td><td>" + data.tgl_lahir + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-tipe='" + data.tipe + "' data-email='" + data.email + "' data-alamat='" + data.alamat + "' data-no_telp='" + data.no_telp + "' data-tgl_lahir='" + data.tgl_lahir + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-tipe='" + data.tipe + "' data-email='" + data.email + "' data-alamat='" + data.alamat + "' data-no_telp='" + data.no_telp + "' data-tgl_lahir='" + data.tgl_lahir + "'>Delete</button></td></tr>");
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
                            <label class="control-label" for="nama">Nama Pelanggan :</label>
                            <input type="text" class="form-control" id="nama_edit" autofocus required>
                            <p class="errorNama text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="tipe">Tipe Pelanggan :</label>
                            <select name="vendor" id="tipe_edit" class="form-control">
                                <option value="">-- Select Tipe Pelanggan --</option>
                                <?php
                                $tipe = \App\Models\Master\TipePelangganModel::get();
                                ?>
                                @foreach ($tipe as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                            <p class="errorTipe text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="email">Email :</label>
                            <input type="text" class="form-control" id="email_edit" autofocus required>
                            <p class="errorEmail text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="alamat">Alamat :</label>
                            <input type="text" class="form-control" id="alamat_edit" autofocus required>
                            <p class="errorAlamat text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="no_telp">No. Telp :</label>
                            <input type="text" class="form-control" id="no_telp_edit" autofocus required>
                            <p class="errorNo_telp text-center alert alert-danger invisible"></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir :</label>
                            <input type="text" class="form-control" id="tgl_lahir_edit" autofocus required>
                            <p class="errorTgl_lahir text-center alert alert-danger invisible"></p>
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
        $('.modal-title').text('Edit Data Konsumen');
        $('#nama_edit').val($(this).data('nama'));
        $('#tipe_edit').val($(this).data('nama_tipe_pelanggan'));
        $('#email_edit').val($(this).data('email'));
        $('#alamat_edit').val($(this).data('alamat'));
        $('#no_telp_edit').val($(this).data('no_telp'));
        $('#tgl_lahir_edit').val($(this).data('tgl_lahir'));
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
            url: '/master/konsumen/update/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
                'nama_pelanggan': $('#nama_edit').val(),
                'id_tipe_pelanggan': $('#tipe_edit').val(),
                'email': $('#email_edit').val(),
                'alamat': $('#alamat_edit').val(),
                'no_telp': $('#no_telp_edit').val(),
                'tgl_lahir': $('#tgl_lahir_edit').val()
            },
            success: function(data) {
                $('.errorEditNama').addClass('hidden');
                $('.errorEditNo_telp').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function() {
                        $('#editModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {
                            timeOut: 5000
                        });
                    }, 500);

                    if (data.errors.nama) {
                        $('.errorNama').removeClass('invisible');
                        $('.errorNama').text(data.errors.nama);
                    }
                    if (data.errors.tipe) {
                        $('.errorTipe').removeClass('invisible');
                        $('.errorTipe').text(data.errors.tipe);
                    }
                    if (data.errors.email) {
                        $('.errorEmail').removeClass('invisible');
                        $('.errorEmail').text(data.errors.email);
                    }
                    if (data.errors.alamat) {
                        $('.errorAlamat').removeClass('invisible');
                        $('.errorAlamat').text(data.errors.alamat);
                    }
                    if (data.errors.no_telp) {
                        $('.errorNo_telp').removeClass('invisible');
                        $('.errorNo_telp').text(data.errors.no_telp);
                    }
                    if (data.errors.tgl_lahir) {
                        $('.errorTgl_lahir').removeClass('invisible');
                        $('.errorTgl_lahir').text(data.errors.tgl_lahir);
                    }
                } else {
                    toastr.success('Successfully updated Consumer Data!', 'Success Alert', {
                        timeOut: 5000
                    });
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.nama_pelanggan + "</td><td>" + data.nama_tipe_pelanggan + "</td><td>" + data.email + "</td><td>" + data.alamat + "</td><td>" + data.no - telp + "</td><td>" + data.tgl_lahir + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-nama='" + data.nama_pelanggan + "' data-tipe='" + data.nama_tipe_pelanggan + "' data-email='" + data.email + "' data-alamat='" + data.alamat + "' data-no_telp='" + data.no_telp + "' data-tgl_lahir='" + data.tgl_lahir + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-nama='" + data.nama_pelanggan + "' data-tipe='" + data.nama_tipe_pelanggan + "' data-email='" + data.email + "' data-alamat='" + data.alamat + "' data-no_telp='" + data.no_telp + "' data-tgl_lahir='" + data.tgl_lahir + "'>Delete</button></td></tr>");
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
                toastr.error('Failed deleted  Customer!', 'Error Alert', {
                    timeOut: 5000
                });
            },
            200: function(data) {
                toastr.success('Successfully deleted Consumer!', 'Success Alert', {
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
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
                          <input type="text" class="form-control" id="nama" autofocus required>
                          <p class="errorNama text-center alert alert-danger invisible"></p>
                      </div>
                      <div class="form-group col-md-6">
                          <label class="control-label" for="alamat">Alamat :</label>
                          <input type="text" class="form-control" id="alamat" autofocus required>
                          <p class="errorAlamat text-center alert alert-danger invisible"></p>
                      </div>
                      <div class="form-group col-md-6">
                          <label class="control-label" for="no_telp">Penanggung Jawab :</label>
                          <input type="text" class="form-control" id="pj" autofocus required>
                          <p class="errorPj text-center alert alert-danger invisible"></p>
                      </div>
                      <div class="form-group col-md-6">
                        <label class="control-label" for="no_telp">No. Hp :</label>
                        <input type="text" class="form-control" id="no_telp" autofocus required>
                        <p class="errorNo_telp text-center alert alert-danger invisible"></p>
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
      $('#alamat').val('');
      $('#pj').val('');
      $('#no_telp').val('');
      $('.modal-title').text('Add Data Vendor');
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
          url: '/master/vendor/store',
          data: {
              '_token': $('input[name=_token]').val(),
              'nama': $('#nama').val(),
              'alamat': $('#alamat').val(),
              'pj': $('#pj').val(),
              'no_telp': $('#no_telp').val()
          },
          success: function(data) {
              $('.errorNama').addClass('invisible');
              $('.errorAlamat').addClass('invisible');
              $('.errorPj').addClass('invisible');
              $('.errorNo_telp').addClass('invisible');

              if ((data.errors)) {
                  setTimeout(function () {
                      $('#addModal').modal('show');
                      toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                  }, 500);

                  if (data.errors.nama) {
                      $('.errorNama').removeClass('invisible');
                      $('.errorNama').text(data.errors.nama);
                  }
                  if (data.errors.alamat) {
                      $('.errorAlamat').removeClass('invisible');
                      $('.errorAlamat').text(data.errors.alamat);
                  }
                  if (data.errors.penanggungjawab) {
                      $('.errorPj').removeClass('invisible');
                      $('.errorPj').text(data.errors.penanggungjawab);
                  }
                  if (data.errors.no_telp) {
                      $('.errorNo_telp').removeClass('invisible');
                      $('.errorNo_telp').text(data.errors.no_telp);
                  }
              }
              else {
                  if (!data) {
                      alert('empty');
                      toastr.error('Error added Driver! No Data Entry!', 'Error Alert', {timeOut: 5000});
                  } else {
                      toastr.success('Successfully added Driver!', 'Success Alert', {timeOut: 5000});
                      $('#example1').prepend("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.nama + "</td><td>" + data.alamat + "</td><td>" + data.penanggungjawab + "</td><td>" + data.no_telp + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-alamat='" +  data.alamat + "' data-penanggungjawab='" + data.penanggungjawab + "' data-no_telp='" + data.no_telp + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-alamat='" +  data.alamat + "' data-penanggungjawab='" + data.penanggungjawab + "' data-no_telp='" + data.no_telp + "'>Delete</button></td></tr>");
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
                          <input type="text" class="form-control" id="nama_edit" autofocus required>
                          <p class="errorNamaEdit text-center alert alert-danger invisible"></p>
                      </div>
                      <div class="form-group col-md-6">
                          <label class="control-label" for="alamat">Alamat :</label>
                          <input type="text" class="form-control" id="alamat_edit" autofocus required>
                          <p class="errorAlamatEdit text-center alert alert-danger invisible"></p>
                      </div>
                      <div class="form-group col-md-6">
                          <label class="control-label" for="no_telp">Penanggung Jawab :</label>
                          <input type="text" class="form-control" id="pj_edit" autofocus required>
                          <p class="errorPjEdit text-center alert alert-danger invisible"></p>
                      </div>
                      <div class="form-group col-md-6">
                        <label class="control-label" for="no_telp">No. Hp :</label>
                        <input type="text" class="form-control" id="no_telp_edit" autofocus required>
                        <p class="errorNo_telpEdit text-center alert alert-danger invisible"></p>
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
          $('.modal-title').text('Edit Data Vendor');
          $('#nama_edit').val($(this).data('nama'));
          $('#alamat_edit').val($(this).data('alamat'));
          $('#pj_edit').val($(this).data('penanggungjawab'));
          $('#no_telp_edit').val($(this).data('no_telp'));
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
              url: '/master/vendor/update/' + id,
              data: {
                  '_token': $('input[name=_token]').val(),
                  'nama': $('#nama_edit').val(),
                  'alamat': $('#nama_edit').val(),
                  'pj': $('#pj_edit').val(),
                  'no_telp': $('#no_telp_edit').val(),
              },
              success: function(data) {
                  $('.errorNamaEdit').addClass('hidden');
                  $('.errorAlamatEdit').addClass('hidden');
                  $('.errorPjEdit').addClass('hidden');
                  $('.errorNo_telpEdit').addClass('hidden');

                  if ((data.errors)) {
                      setTimeout(function () {
                          $('#editModal').modal('show');
                          toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                      }, 500);

                      if (data.errors.nama) {
                          $('.errorNamaEdit').removeClass('hidden');
                          $('.errorNamaEdit').text(data.errors.nama);
                      }
                      if (data.errors.alamat) {
                          $('.errorAlamatEdit').removeClass('hidden');
                          $('.errorAlamatEdit').text(data.errors.alamat);
                      }
                      if (data.errors.penanggungjawab) {
                          $('.errorPjEdit').removeClass('hidden');
                          $('.errorPjEdit').text(data.errors.penanggungjawab);
                      }
                      if (data.errors.no_telp) {
                          $('.errorEditNo_telp').removeClass('hidden');
                          $('.errorEditNo_telp').text(data.errors.no_telp);
                      }
                  } else {
                      toastr.success('Successfully updated Vendor Data!', 'Success Alert', {timeOut: 5000});
                      $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.nama + "</td><td>" + data.alamat + "</td><td>" + data.penanggungjawab + "</td><td>" + data.no_telp + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-alamat='" +  data.alamat + "' data-penanggungjawab='" + data.penanggungjawab + "' data-no_telp='" + data.no_telp + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-alamat='" +  data.alamat + "' data-penanggungjawab='" + data.penanggungjawab + "' data-no_telp='" + data.no_telp + "'>Delete</button></td></tr>");
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
  $('.modal-title').text('Delete Data Vendor');
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
          toastr.success('Successfully deleted Vendor!', 'Success Alert', {timeOut: 5000});
          $('.item' + id).remove();
          $('.col1').each(function (index) {
              $(this).html(index+1);
          });
      }
  });
});
</script>
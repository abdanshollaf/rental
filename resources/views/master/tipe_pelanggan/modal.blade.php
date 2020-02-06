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
                              <label class="control-label" for="nama">Tipe Pelanggan :</label>
                              <input type="text" class="form-control" id="nama" autofocus required>
                              <p class="errorNama text-center alert alert-danger invisible"></p>
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
      $('.modal-title').text('Add Data Customer Type');
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
          url: '/master/tipe_pelanggan/store',
          data: {
              '_token': $('input[name=_token]').val(),
              'nama': $('#nama').val()
          },
          success: function(data) {
              $('.errorNama').addClass('invisible');
              if ((data.errors)) {
                  setTimeout(function () {
                      $('#addModal').modal('show');
                      toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                  }, 500);

                  if (data.errors.nama) {
                      $('.errorNama').removeClass('invisible');
                      $('.errorNama').text(data.errors.nama);
                  }
              }
              else {
                  if (!data) {
                      alert('empty');
                      toastr.error('Error added Customer Type! No Data Entry!', 'Error Alert', {timeOut: 5000});
                  } else {
                      toastr.success('Successfully added Customer Type!', 'Success Alert', {timeOut: 5000});
                      $('#example1').prepend("<tr class='item" + data.id + "'><td class='col1 text-center'>" + data.id + "</td><td>" + data.nama_tipe_pelanggan + "</td><td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-nama='" + data.nama_tipe_pelanggan + "'>Delete</button></td></tr>");
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
                              <label class="control-label" for="nama">Tipe Pelanggan :</label>
                              <input type="text" class="form-control" id="nama_edit" autofocus required>
                              <p class="errorNama text-center alert alert-danger invisible"></p>
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
          $('.modal-title').text('Edit Data Customer Type');
          $('#nama_edit').val($(this).data('nama'));
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
              url: '/master/tipe_pelanggan/update/' + id,
              data: {
                  '_token': $('input[name=_token]').val(),
                  'nama': $('#nama_edit').val()
              },
              success: function(data) {
                  $('.errorEditNama').addClass('hidden');

                  if ((data.errors)) {
                      setTimeout(function () {
                          $('#editModal').modal('show');
                          toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                      }, 500);

                      if (data.errors.nama) {
                          $('.errorEditNama').removeClass('hidden');
                          $('.errorEditNama').text(data.errors.nama);
                      }
                  } else {
                      toastr.success('Successfully updated Customer Type Data!', 'Success Alert', {timeOut: 5000});
                      $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama_tipe_pelanggan + "</td><td> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-nama='" + data.nama_tipe_pelanggan + "'>Edit</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-nama='" + data.nama_tipe_pelanggan + "'>Delete</button></td></tr>");
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
  $('.modal-title').text('Delete Data Customer Type');
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
          toastr.success('Successfully deleted Customer Type!', 'Success Alert', {timeOut: 5000});
          $('.item' + id).remove();
          $('.col1').each(function (index) {
              $(this).html(index+1);
          });
      }
  });
});
</script>
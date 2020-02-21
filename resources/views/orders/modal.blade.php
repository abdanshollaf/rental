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
            toastr.success('Successfully deleted Order!', 'Success Alert', {timeOut: 5000});
            $('.items' + id).remove();
            $('.col1').each(function (index) {
                $(this).html(index+1);
            });
        }
    });
  });
  </script>
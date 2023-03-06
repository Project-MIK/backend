<div class="modal fade" id="{{$idModal}}">
    <div class="modal-dialog {{$modalSize}}">
      <div class="modal-content {{$modalBg}}">
        <div class="modal-header">
          {{$header}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{$slot}}
        </div>
        <div class="modal-footer justify-content-between">
          {{$footer}}
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
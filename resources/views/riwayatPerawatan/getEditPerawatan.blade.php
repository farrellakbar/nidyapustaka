<form role="form" method="POST" action="{{ url('riwayatPerawatan/'.$data->id) }}">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">
        Edit Riwayat Perawatan
      </h4>
  </div>
  <div class="modal-body">
  @if(session('status'))
    <div class="alert alert-success">
      <strong>Sukses! </strong>
      {{ session('status') }}
    </div>
  @endif
    @csrf
    @method("PUT")

  <div class="form-group row">
    <label for="catatan" class="col-sm-2 col-form-label">Catatan</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="catatan" rows="3"></textarea>
    </div>
</div> 
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
</form>  
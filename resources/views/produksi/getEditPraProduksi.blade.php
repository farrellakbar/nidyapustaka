<!-- <form role="form" method="POST" action="{{ url('produksi/'.$id) }}">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">
        Edit Inventaris
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
        <label for="kode" class="col-sm-2 col-form-label">Kode</label>
        <div class="col-sm-4">
        <input type="text" value="{{ $kode }}" name="kode" class="form-control" id="kode" placeholder="Kode" readonly>
        </div>
    </div>  
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
        <input type="text" value="{{ $data->nama }}" name="nama" class="form-control" id="nama" placeholder="Nama" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Tahun Pembuatan</label>
        <div class="col-sm-10">
          <input type="number" value="{{ $data->tahunPembuatan }}" name="tahunPembuatan" min="2000" max="2022" step="1" placeholder="Tahun Pembuatan">   
        </div>
    </div> 
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
</form>   -->
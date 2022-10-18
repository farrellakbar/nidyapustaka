<form role="form" method="POST" action="{{ url('lokasiPenyimpanan/'.$kode) }}">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">
        Edit Lokasi Penyimpanan
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
        <label for="nama" class="col-sm-2 col-form-label">Kapasitas Maksimal</label>
        <div class="col-sm-10">
          <input type="number" value="{{ $data->kapasitasMaksimal }}" min="{{ $data->jumlahTerkini }}" name="kapasitas" class="form-control" id="kapasitas" placeholder="Kapasitas" required>
        </div>
    </div> 
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
</form>  
<form role="form" method="POST" action="{{ url('inventaris/'.$kode) }}">
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
        <input type="text" value="{{ $kode }}" name="kode" class="form-control" id="eKode" placeholder="Kode" required>
        </div>
    </div>  
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
        <input type="text" value="{{ $data->nama }}" name="nama" class="form-control" id="eNama" placeholder="Nama" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Tahun Pembuatan</label>
        <div class="col-sm-10">
          <input type="number" value="{{ $data->tahunPembuatan }}" name="tahunPembuatan" id="eTahunPembuatan" min="2000" max="2022" step="1" placeholder="Tahun Pembuatan">   
        </div>
    </div> 
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Plat Nomor</label>
        <div class="col-sm-10">
            <input type="text" value="{{ $data->platNomor }}" name="platNomor" class="form-control" id="ePlatNomor" placeholder="platNomor" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="Foto" class="col-sm-2 col-form-label">Foto</label>
        <div class="col-sm-10">
          <input type="file" value="{{ $data->foto }}" name="foto" class="form-control" id="eFoto" placeholder="Foto">
        </div>
    </div>  
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss='modal' onclick="saveDataUpdateTD('{{$kode}}')">Simpan</button>
    <a class="btn btn-default" data-dismiss="modal">Batal</a>
  </div>
</form>  
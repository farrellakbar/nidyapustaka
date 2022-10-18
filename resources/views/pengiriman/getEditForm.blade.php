<form role="form" method="POST" action="{{ url('ekspedisi/'.$id) }}">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">
        Edit Ekspedisi
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
        <label for="kode" class="col-sm-2 col-form-label">ID<span style="color:red">
					* </span>
        </label>
        <div class="col-sm-4">
        <input type="text" value="{{ $id }}" name="id" class="form-control" id="id" placeholder="id" readonly>
        </div>
    </div>  
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama<span style="color:red">
					* </span>
        </label>
        <div class="col-sm-10">
        <input type="text" value="{{ $data->nama }}" name="nama" class="form-control" id="nama" placeholder="Nama" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Alamat<span style="color:red">
					* </span>
        </label>
        <div class="col-sm-10">
        <input type="text" value="{{ $data->alamat }}" name="alamat" class="form-control" id="alamat" placeholder="Alamat" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nomor Telepon</label>
        <div class="col-sm-10">
        <input type="text" value="{{ $data->nomorTelepon }}" maxlength="14" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="nomorTelepon" class="form-control" id="nomorTelepon" placeholder="Nomor Telepon">
        </div>
    </div> 
    @if ($data->platNomor != "")
    <?php
      $value  = $data->platNomor;
      $arrayValues = explode(' ',$value);  // explode with " "
      // print_r($arrayValues);
    ?>
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Plat Nomor</label>
        <div class="col-md-3">
          <input type="text" value="{{ $arrayValues[0] }}" pattern="[a-zA-Z'-'\s]*"   maxlength="2" name="kota" class="form-control" id="kota" placeholder="L" title="Masukkan huruf, tidak boleh angka">
        </div>
        <div class="col-md-4">
          <input type="text" value="{{ $arrayValues[1] }}" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  maxlength="4" name="nomor" class="form-control" id="nomor" placeholder="0000">
        </div>
        <div class="col-md-3">
          <input type="text" value="{{ $arrayValues[2] }}" pattern="[a-zA-Z'-'\s]*"   maxlength="3" name="huruf" class="form-control" id="huruf" placeholder="AA" title="Masukkan huruf, tidak boleh angka">
        </div>
    </div>
    @endif
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
</form>  
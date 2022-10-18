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
        <input type="text" value="{{ $kode }}" name="kode" class="form-control" id="kode" placeholder="Kode" readonly>
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
        <label for="nama" class="col-sm-2 col-form-label">Tahun Pembuatan</label>
        <div class="col-sm-10">
          <input type="number" value="{{ $data->tahunPembuatan }}" name="tahunPembuatan" min="2000" max="2022" step="1" placeholder="Tahun Pembuatan">   
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
            <input type="text" value="{{ $arrayValues[0] }}" maxlength="2" name="kota" class="form-control" id="kota" placeholder="L">
          </div>
          <div class="col-md-4">
            <input type="text" value="{{ $arrayValues[1] }}" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  maxlength="4" name="nomor" class="form-control" id="nomor" placeholder="0000">
          </div>
          <div class="col-md-3">
            <input type="text" value="{{ $arrayValues[2] }}" maxlength="3" name="huruf" class="form-control" id="huruf" placeholder="AA">
          </div>
      </div>
    @endif
    <div class="form-group row">
      <label for="kode_inventaris" class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-4">
        <select class="form-control" name="status" required>
          @foreach(["Aktif" => "Aktif", 
                    "Rusak" => "Rusak",
                    "Dijual" => "Dijual"] AS $status => $s)    
            <option value='{{$status}}' id="{{$s == $data->status  ? 'selected' : ''}}"
                  @if( $s == $data->status )
                      selected
                  @endif> {{$s}}
            </option>
          @endforeach
        </select>
      </div>
    </div>   
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
</form>  
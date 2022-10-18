<form role="form" method="POST" action="{{ url('buku/'.$id) }}">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">
        Edit Buku
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
        <label for="kode" class="col-sm-3 col-form-label">Kode Buku</label>
        <div class="col-sm-4">
        <input type="text" value="{{ $id }}" name="id" class="form-control" id="id" placeholder="Kode Buku" readonly>
        </div>
    </div>  
    <div class="form-group row">
        <label for="nama" class="col-sm-3 col-form-label">Nama<span style="color:red">
					* </span>
        </label>
        <div class="col-sm-9">
        <input type="text" value="{{ $data->nama }}" name="namaBuku" class="form-control" id="namaBuku" placeholder="Nama" required>
        </div>
    </div> 
    <div class="form-group row">
        <label for="kode_inventaris" class="col-sm-3 col-form-label">Kategori Buku<span style="color:red">
					* </span>
        </label>
        <div class="col-sm-9">
          <input type="text" value="{{ $data->kategoris }}" name="id" class="form-control" id="id" placeholder="Kode Buku" readonly>
        </div>
    </div>
    <div class="form-group row">
      <label for="nama" class="col-sm-3 col-form-label">Ukuran Buku<span style="color:red">
				* </span>
      </label>
        <div class="col-md-3">
          <input type="number" value="{{ $data->lebar }}" step=0.1 min="0" value="0" name="lebar" class="form-control" id="lebar" required>
          <span class="help-block">
					  Lebar
          </span>
        </div>
        <div class="col-md-1">
          <h5>cm</h5>
        </div>
        <div class="col-md-1">
          <h5><B>X</B></h5>
        </div>
        <div class="col-md-3">
          <input type="number" value="{{ $data->panjang }}" step=0.1 min="0" value="0" name="panjang" class="form-control" id="panjang" required>
          <span class="help-block">
					  Panjang
          </span>
        </div>
        <div class="col-md-1">
          <h5>cm</h5>
        </div>
    </div>
    <div class="form-group row">
      <label for="kendala" class="col-sm-3 col-form-label">Halaman<span style="color:red">
				* </span>
      </label>
      <div class="col-md-3">
        <input type="number" value="{{ $data->halaman }}" min="0" value="0" name="halaman" class="form-control" id="halaman" required>
      </div>
      <div class="col-md-3">
        <h5>Halaman</h5>
      </div>
    </div> 
    <div class="form-group row">
      <label for="harga" class="col-sm-3 col-form-label">Harga <span style="color:red">
				* </span>
      </label>     
      <div class="col-md-1">
        <h5>Rp.</h5>
      </div>
      <div class="col-md-6"> 
        <input type="number" value="{{ $data->harga }}" value="" name="harga" class="form-control" placeholder="Harga" required>
      </div> 
    </div> 
    @if(!empty($data->id_konsumen))
      <div class="form-group row">
        <label for="kode" class="col-sm-3 col-form-label">Konsumen </label>
        <div class="col-sm-9"> 
          <select class="form-control" name="id_konsumen">
            <option value=''>Pilih Konsumen</option>
            @foreach($data3 as $i)
              <option value='{{$i->id}}' id="{{$i->id == $data->id_kategori_bahan_baku  ? 'selected' : ''}}"
                  @if ($i->id == $data->id_konsumen )
                      selected
                  @endif> 
              @if(!empty($i->namaToko))
                  {{$i->namaPemesan}} - {{$i->namaToko}}
              @else
                  {{$i->namaPemesan}}
              @endif
              </option>
            @endforeach
          </select> 
        </div>
      </div> 
    @endif
    <!-- <div class="form-group row">
      <label for="Foto" class="col-sm-3 col-form-label">Foto</label>
      <div class="col-sm-9">
        <input type="file" value="" name="foto" class="form-control" id="foto">
      </div>
    </div> 	
    <div class="form-group row">
      <label for="Foto" class="col-sm-3 col-form-label">File Desain Buku</label>
      <div class="col-sm-9">
        <input type="file" value="" name="desainBuku" class="form-control" id="desainBuku">
      </div>
    </div>  -->
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
</form>  
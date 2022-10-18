<form role="form" method="POST" action="{{ url('sediaanBahanBaku/'.$id) }}">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">
        Edit Sediaan Bahan Baku
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
        <label for="kode" class="col-sm-2 col-form-label">ID</label>
        <div class="col-sm-4">
        <input type="text" value="{{ $id }}" name="id" class="form-control" id="id" placeholder="ID" readonly>
        </div>
    </div>   
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
        <input type="text" value="{{ $data->nama }}" name="nama" class="form-control" id="nama" placeholder="Nama" required>
        </div>
    </div> 
    <div class="form-group row">
          <label for="id_supplier" class="col-sm-2 col-form-label">Supplier</label>
          <div class="col-sm-10">
              <select class="form-control" name="id_supplier">
              @foreach($dataSupplier as $i)
                  <option value='{{$i->id}}' id="{{$i->id == $data->id_supplier ? 'selected' : ''}}"
                  @if ($i->id == $data->id_supplier)
                      selected
                  @endif> {{ $i->nama}}</option>
              @endforeach
              </select> 
          </div>
      </div> 
      <div class="form-group row">
          <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
          <div class="col-sm-10">
              <select class="form-control" name="id_kategori">
              @foreach($dataKategori as $i)
                  <option value='{{$i->id}}' id="{{$i->id == $data->id_kategori_bahan_baku  ? 'selected' : ''}}"
                  @if ($i->id == $data->id_kategori_bahan_baku )
                      selected
                  @endif> {{ $i->nama}}</option>
              @endforeach
              </select> 
          </div>
      </div>  
      <div class="form-group row">
          <label for="harga" class="col-sm-2 col-form-label">Harga</label>     
          <div class="col-md-1">
            <h4>Rp.</h4>
          </div>
          <div class="col-md-6"> 
            <input type="number" value="{{ $data->harga }}" name="harga" class="form-control" placeholder="Harga" required>
          </div>
          <div class="col-md-3">
            <input type="text" value="{{ $data->satuan }}" name="satuan" class="form-control" placeholder="Satuan" required>   
          </div>
      </div> 							            
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
</form>  
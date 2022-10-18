@extends('layout.conquer')
@section('content') 
  <!-- START TAMBAH KONSUMEN WITH MODALS & AJAX-->
    <div class="modal fade" id="buatKonsumen" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">
                Tambah Konsumen
            </h4>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ route('konsumen.store') }}">
            <div class="modal-body">
                @csrf
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama Pemesan<span style="color:red">
                       * </span>
                    </label>
                    <div class="col-sm-8">
                        <input type="text" value="" name="namaPemesan" class="form-control" id="namaPemesan" placeholder="Nama Pemesan" required>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Alamat Pemesan<span style="color:red">
                       * </span>
                    </label>
                    <div class="col-sm-8">
                    <input type="text" value="" name="alamatPemesan" class="form-control" id="alamatPemesan" placeholder="Alamat Pemesan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama Toko
                    </label>
                    <div class="col-sm-8">
                    <input type="text" value="" name="namaToko" class="form-control" id="namaToko" placeholder="Nama Toko">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Alamat Toko
                    </label>
                    <div class="col-sm-8">
                    <input type="text" value="" name="alamatToko" class="form-control" id="alamatToko" placeholder="Alamat Toko">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Nomor Telepon<span style="color:red">
                       * </span>
                    </label>
                    <div class="col-sm-8">
                    <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  maxlength="14" name="nomorTelepon" class="form-control" id="nomorTelepon" placeholder="No Telepon" required>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  <!-- END TAMBAH KONSUMEN WITH MODALS & AJAX-->
  <h2 class="page-title">
    Buku <small>produksi</small>
  </h2>
  <div class="page-bar">
    <ul class="page-breadcrumb"> 
      <li>
        <i class="fa fa-home"></i>
        <a href="/">Beranda</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="#">Produksi</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="#">Buku</a> 
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="#">Tambah</a> 
      </li>
    </ul>
  </div>
  <div class="content"> 
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-reorder"></i>Form Data
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a>
          <a href="javascript:;" class="reload"></a>
        </div>
      </div>
      <div class="portlet-body form">
          @if(session('success'))
            <div class="alert alert-success">
              <strong>Sukses! </strong>
              {{ session('success') }}
            </div>
          @endif
        <!-- BEGIN FORM-->
          <form enctype="multipart/form-data" method="POST" action="{{ route('buku.store') }}" class="horizontal-form">
            <div class="form-body">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="kode" class="control-label">Kode Buku<span style="color:red">*</span></label>
                      <input type="text" value="" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="kodeBuku" class="form-control" id="kodeBuku" placeholder="Kode Buku" required>
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kode" class="control-label">Nama Buku <span style="color:red">
                      * </span>
                    </label>
                    <input type="text" value="" name="nama" class="form-control" id="nama" placeholder="Nama Buku" required> 
                  </div> 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kode_inventaris" class="control-label">Kategori Buku<span style="color:red">
                      * </span>
                    </label>
                    <select class="form-control" name="kategoris" required>
                      <option value="">
                        Pilih Kategori Buku
                      </option>
                      @foreach(["Pelajaran" => "Buku Pelajaran", 
                                "Umum" => "Buku Umum",
                                "Kamus" => "Buku Kamus", 
                                "Agama" => "Buku Agama", 
                                "Custom" => "Custom", 
                                "Lain-lain" => "Lain-lain"] AS $kategoris => $kategori)    
                        <option value="{{ $kategoris }}">
                          {{ $kategori }}
                        </option>
                      @endforeach
                    </select>
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <label for="kode" class="control-label">Ukuran Buku<span style="color:red">
                      * </span>
                    </label>   
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <input type="number" step=0.1 min="0" value="0" name="lebar" class="form-control" id="lebar" required>
                    <span class="help-block">
                      Lebar
                    </span>
                  </div> 
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <h5>cm</h5>
                  </div> 
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <input type="number" step=0.1 min="0" value="0" name="panjang" class="form-control" id="panjang" required>
                    <span class="help-block">
                      Panjang
                    </span>
                  </div> 
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <h5>cm</h5>
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="kendala" class="control-label">Halaman<span style="color:red">
                    * </span>
                  </label>   
                  <input type="number" min="0" value="0" name="halaman" class="form-control" id="halaman" required>
                  <h5>Halaman</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <label for="harga" class="control-label">Harga<span style="color:red">
                      * </span>
                    </label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="col-md-1">
                    <h5>Rp.</h5>
                  </div>
                  <div class="col-md-9">
                    <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  maxlength="14" value="" name="harga" class="form-control" placeholder="Harga" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Foto" class="control-label">Foto</label>
                    <input type="file" value="" name="foto" class="form-control" id="foto">
                  </div> 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Foto" class="control-label">File Desain Buku</label>
                    <input type="file" value="" name="desainBuku" class="form-control" id="desainBuku">
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kode" class="control-label">Konsumen </label>
                    <a type="button" href="#buatKonsumen" data-toggle="modal" class="btn btn-link">
                        <i class="fa fa-plus"></i>
                        Tambah
                    </a>
                    <select class="form-control" name="id_konsumen">
                      <option value=''>Pilih Konsumen</option>
                      @foreach($data3 as $i)
                        <option value='{{$i->id}}' id='add_{{$i->id}}'>
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
              </div> 
            </div>
            <div class="form-actions right">
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
              <a href ="{{ URL::previous() }}" type="button" class="btn btn-default">Batal</a>
            </div>
          </form>
        <!-- END FORM-->
      </div>
    </div>
  </div>



@endsection
@section('tempat_script')
  <script>

  </script>
@endsection
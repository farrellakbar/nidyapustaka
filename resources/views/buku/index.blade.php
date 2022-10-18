@extends('layout.conquer')
@section('content')
  <!-- START TAMBAH BUKU-->
    <div class="modal fade" id="buatBuku" tabindex="-1" role="basic" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">
              <b>Tambah Buku</b>
            </h4>
          </div>
          <form enctype="multipart/form-data" method="POST" action="{{ route('buku.store') }}">
            <div class="modal-body">
              @csrf
              <div class="form-group row">
                <label for="kode" class="col-sm-3 col-form-label">Kode Buku<span style="color:red">
								* </span>
                </label>
                <div class="col-sm-4">
                  <input type="text" value="" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="kodeBuku" class="form-control" id="kodeBuku" placeholder="Kode Buku" required>
                </div>
              </div>  
              <div class="form-group row">
                <label for="kode" class="col-sm-3 col-form-label">Nama Buku <span style="color:red">
                  * </span>
                </label>
                <div class="col-sm-9">
                  <input type="text" value="" name="nama" class="form-control" id="nama" placeholder="Nama Buku" required>
                </div>
              </div>  
              <div class="form-group row">
                <label for="kode_inventaris" class="col-sm-3 col-form-label">Kategori Buku
                <span style="color:red">
                  * </span>
                </label>
                <div class="col-sm-9">
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
                        <option value="{{ $kategoris }}" {{ old("kategoris", $data->first()) == $kategoris ? "selected" : "" }}>
                          {{ $kategori }}
                        </option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Ukuran Buku<span style="color:red">
                  * </span>
                </label>
                <div class="col-md-3">
                  <input type="number" step=0.1 min="0" value="0" name="lebar" class="form-control" id="lebar" required>
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
                  <input type="number" step=0.1 min="0" value="0" name="panjang" class="form-control" id="panjang" required>
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
                  * </span></label>
                  <div class="col-md-3">
                    <input type="number" min="0" value="0" name="halaman" class="form-control" id="halaman" required>
                  </div>
                  <div class="col-md-3">
                    <h5>Halaman</h5>
                  </div>
              </div> 
              <div class="form-group row">
                <label for="harga" class="col-sm-3 col-form-label">Harga<span style="color:red">
                  * </span>
                </label>     
                <div class="col-md-1">
                  <h5>Rp.</h5>
                </div>
                <div class="col-md-5"> 
                  <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  maxlength="14" value="" name="harga" class="form-control" placeholder="Harga" required>
                </div>
              </div> 	
              <div class="form-group row">
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
              </div> 
              <div class="form-group row">
                <label for="kode" class="col-sm-3 col-form-label">Konsumen </label>
                <div class="col-sm-6"> 
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
                <div class="col-sm-2"> 
                  <a type="button" href="#buatKonsumen" data-toggle="modal" data-dismiss="modal" class="btn btn-link">
                      <i class="fa fa-plus"></i>
                      Tambah
                  </a>
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
  <!-- END TAMBAH BUKU-->
  <!-- START EDIT BUKU-->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true"> 
      <div class="modal-dialog">
        <div class="modal-content" id="modalContent">

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- END EDIT EDIT BUKU-->
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
      </li>
    </ul>
  </div>

  <div class="dropdown dp">
    <button type="button" class="btn btn-warning btn-sm btnDp" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Keranjang
            <span class="badge badge-pill badge-danger">
              {{ count((array) session('KeranjangPenjualan')) }}
            </span>
    </button>
    <!-- START KERANJANG  -->
      <div class="dropdown-menu dp-menu">
              <div class="row total-header-sectionDp">              
                <div class="col-lg-6 col-sm-6 col-6">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                    <span class="badge badge-pill badge-danger">
                      {{ count((array) session('KeranjangPenjualan')) }}
                    </span>
                </div>
                <div class="col-lg-6 col-sm-6 col-6 total-sectionDp text-right">
                    <p> <b>Keranjang Buku </b> <span class="text-info"></span></p>
                </div>
              </div>
              <div class="row cart-detailDp">
                  <div class="col-lg-3 col-sm-3 col-3">
                  </div>
                  <div class="col-lg-4 col-sm-4 col-4">
                      <span class="text-info"><b>Nama</b></span> 
                  </div>
                  <div class="col-lg-3 col-sm-3 col-3">
                      <span class="count"><b>Jumlah </b></span>
                  </div>
              </div>

              @if(session('KeranjangPenjualan'))
                  @foreach(session('KeranjangPenjualan') as $id => $details)
                      <div class="row cart-detailDp">
                        <div class="col-lg-3 col-sm-3 col-3 cart-detailDp-img">
                          <img src="{{ asset('images/'.$details['foto']) }}" />
                        </div>
                        <div class="col-lg-4 col-sm-4 col-4">
                          <p>{{ $details['nama'] }}</p>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-4" id="updateBuku">
                          <input type="hidden" value="{{ $id }}" name="idBuku2" class="form-control" id="idBuku2" placeholder="idBuku2">
                          <input type="number" value="{{ $details['jumlahPenjualan'] }}" name="jumlahBuku" min="100" step="50" class="form-control" id="jumlahBuku" placeholder="Jumlah" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
                        </div>
                      </div> 
                  @endforeach
              @endif
              @if(Auth::user()->role == "manajer")
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12 text-center checkoutDp">
                        <a href="{{ url('/buku/keranjangPenjualan') }}" class="btn btn-primary btn-block">View all</a>
                    </div>
                </div>
              @endif
      </div>
    <!-- END KERANJANG  -->
  </div>


  <div class="content">
    <!-- START DAFTAR BUKU  -->
      <div class="portlet">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>Buku
          </div>
          <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="javascript:;" class="reload"></a>
          </div>
        </div>
        <div class="portlet-body"> 
          @if(session('success'))
            <div class="alert alert-success">
              <strong>Sukses! </strong>
              {{ session('success') }}
            </div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger">
              <strong>Gagal! </strong>
              {{ session('error') }}
            </div>
          @endif
          @if(Auth::user()->role == "manajer")
            <div class="btn-group"> 
              <a type="button" class="btn btn-info" href="{{ route('buku.create') }}">
                + Tambah Buku
              </a>
            </div>
            <hr>
          @endif
          <div class="row">
				    <div class="col-md-12">
              <div class="tabbable tabbable-custom boxless">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#tab_1" data-toggle="tab">Sediaan Buku</a>
                </li>
                <li >
                  <a href="#tab_2" data-toggle="tab">Daftar Buku</a>
                </li>
              </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                      <!-- BEGIN FILTER -->
                      <div class="margin-top-10">   
                          <ul class="mix-filter">
                              <li class="filter btn" data-filter="all">
                                Semua
                              </li>
                            @foreach(["Pelajaran" => "Buku Pelajaran", 
                                      "Umum" => "Buku Umum",
                                      "Kamus" => "Buku Kamus", 
                                      "Agama" => "Buku Agama",
                                      "Custom" => "Custom",
                                      "Lain-lain" => "Lain-lain"] AS $kategoris => $kategori)      
                              <li class="filter btn" data-filter="{{ $kategoris }}">
                                {{ $kategori }}
                              </li>
                            @endforeach
                          </ul>
                          <div class="row mix-grid">
                            @foreach($data2 as $d)
                            <div class="col-md-2 col-sm-4 mix {{$d->kategoris}}">
                              <div class="mix-inner">
                                <img class="img-responsive" src="images/{{$d->foto}}" alt="">
                                <div class="mix-details">
                                  <h3><b>Buku {{$d->nama}}</b></h3>
                                  @if($d->jumlahBuku)
                                    <h2><strong>{{$d->jumlahBuku}}</strong></h2>
                                  @else
                                    <h2><strong>0</strong></h2>
                                  @endif   
                                  <p> Sediaan</p>
                                  <hr>
                                  <p>{{$d->lebar}} cm &nbsp; X &nbsp; {{$d->panjang}} cm</p>
                                  <p>{{$d->halaman}} halaman</p>
                                  <!-- <a class="filter btn" type="button"><i class="fa fa-download" title="Unduh File"></i></a> -->
                                  @if(Auth::user()->role == "manajer")
                                    @if($d->jumlahBuku >= 100)
                                      <a href="{{url('tambahKeranjangPenjualan/'.$d->id)}}" class="btn btn-primary">
                                        <i class="fa fa-shopping-cart"></i>
                                        Tambahkan
                                      </a>
                                    @else
                                      <p>Jumlah Buku Kurang Mencukupi</p>
                                    @endif         
                                  @endif   
                                </div>
                              </div>
                            </div> 
                            @endforeach
                            
                          </div>
                      </div>
                      <!-- END FILTER -->
                  </div>   
                  <div class="tab-pane" id="tab_2">
                      <!-- BEGIN FILTER -->
                      <div class="margin-top-10">   
                          <ul class="mix-filter">
                              <li class="filter btn" data-filter="all">
                                Semua
                              </li>
                            @foreach(["Pelajaran" => "Buku Pelajaran", 
                                      "Umum" => "Buku Umum",
                                      "Kamus" => "Buku Kamus", 
                                      "Agama" => "Buku Agama", 
                                      "Custom" => "Custom", 
                                      "Lain-lain" => "Lain-lain"] AS $kategoris => $kategori)      
                              <li class="filter btn" data-filter="{{ $kategoris }}">
                                {{ $kategori }}
                              </li>
                            @endforeach
                          </ul>
                          <div class="row mix-grid">
                            @foreach($data as $d)
                            <div class="col-md-2 col-sm-4 mix {{$d->kategoris}}">
                              <div class="mix-inner">
                                <img class="img-responsive" src="images/{{$d->foto}}" alt="">
                                <div class="mix-details">
                                  <h2><b>Buku {{$d->nama}}</b></h2>
                                  <h1>Rp. {{$d->harga}}</h1>
                                  <hr>
                                  <p>{{$d->lebar}} cm &nbsp; X &nbsp; {{$d->panjang}} cm</p>
                                  <p>{{$d->halaman}} halaman</p>
                                  @if(Auth::user()->role == "manajer")
                                    @if($d->desainBuku)
                                      <a href="desainBuku/{{$d->desainBuku}}" class="filter btn" type="button"><i class="fa fa-download" title="Unduh File"></i></a>
                                    @else
                                      <a href="#modalDesain{{ $d->desainBuku }}" data-toggle="modal" class="filter btn" onClick="$('.modal').modal('hide')"><i class="fa fa-plus"></i></a>
                                    @endif
                                    <a class="mix-link" href="#modalEdit" data-toggle="modal" onclick="getEditForm('{{$d->id}}')"><i class="fa fa-edit"></i></a>
                                  @else
                                    @if($d->desainBuku)
                                      <a href="desainBuku/{{$d->desainBuku}}" class="mix-link" type="button"><i class="fa fa-download" title="Unduh File"></i></a>
                                    @else
                                      <a href="#modalDesain{{ $d->desainBuku }}" data-toggle="modal" class="mix-link" onClick="$('.modal').modal('hide')"><i class="fa fa-plus"></i></a>
                                    @endif
                                  @endif
                                  <a class="mix-preview fancybox-button" href="images/{{$d->foto}}" title="{{$d->nama}}" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                                </div>
                              </div>
                            </div>
                              <!-- START Desain WITH MODALS-->
                                <div class="modal fade" id="modalDesain{{ $d->desainBuku }}" tabindex="-1" role="basic" aria-hidden="true"> 
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">
                                          Tambah Desain
                                        </h4>
                                      </div>
                                      <form enctype="multipart/form-data" method="POST" action="{{ route('buku.desain') }}">
                                      @csrf
                                        <div class="modal-body">
                                            <div class="form-group row">
                                              <label for="nama" class="col-sm-2 col-form-label">Desain</label>
                                              <div class="col-sm-10">
                                                <input type="file" value="" name="desainBuku2" class="form-control" id="desainBuku2" placeholder="Desain" required>
                                              </div>
                                              <input type="hidden" name="id" value="{{ $d->id}}">
                                            </div> 
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary" >
                                            Simpan
                                          </button>
                                          <button type="button" class="btn btn-primary" onClick="$('.modal').modal('hide');" >
                                            Batal
                                          </button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              <!-- END Desain WITH MODALS-->
                            @endforeach
                            
                          </div>
                      </div>
                      <!-- END FILTER -->
                  </div>            
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    <!-- END DAFTAR BUKU  -->
@endsection

@section('tempat_script')
  <script>
    function getEditForm(id)
    {
      $.ajax({
        type:'POST',
        url: '{{route("buku.getEditForm")}}',
        data: {'_token':'<?php echo csrf_token() ?>',
                'id':id
              },
        success: function(data){
          $('#modalContent').html(data.msg);
        }
      });
    }
 
    $(document).ready(function () {
        function update()
        {
          var eIdBuku=$('#idBuku2').val();
          var eJumlah=$('#jumlahBuku').val();

          $.ajax({
            type:'POST',
            url: '{{route("linimasa.keranjangBuku")}}',
            data: {'_token':'<?php echo csrf_token() ?>',
                    'idBuku':eIdBuku,
                    'jumlahBuku':eJumlah,
                  },
            success: function(data){
              if(data.status == 'ok')
              {
                $('#updateBuku').empty();
                $("#updateBuku").html(data);
              }
            }
          });
        }

      $("#jumlahBuku").change(function(){ 
        update();
		  }); 
    });
  </script>
@endsection
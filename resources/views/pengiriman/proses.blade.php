@extends('layout.conquer')
@section('content') 
  <h2 class="page-title">
    Proses <small>penjualan</small>
  </h2>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="fa fa-home"></i>
              <a href="/">Beranda</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <a href="/pengiriman">Pengiriman</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <a href="#">Proses</a> 
          </li>
      </ul>
  </div>

  <div class="content"> 
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-reorder"></i>Form Proses Penjualan
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a>
          <a href="javascript:;" class="reload"></a>
        </div>
      </div>
      <div class="portlet-body form">
        <!-- BEGIN FORM-->
          <form action="{{ url('penjualanBuku/'.$data->id) }}" class="horizontal-form" method="post">
            <div class="form-body">
              <h3 class="form-section">Proses Penjualan</h3>
              @if(session('error'))
                <div class="alert alert-danger">
                    <strong>Gagal! </strong>
                    {{ session('error') }} 
                </div>
              @endif
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="nama" class="control-label">ID Nota</label>
                      <input type="text" value="{{ $data->id }}" name="id" class="form-control" id="id" placeholder="Nota" readonly>
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="nama" class="control-label">Konsumen</label>
                      <input type="text" value="{{ $data->Konsumen->namaPemesan }}" name="nama" class="form-control" id="nama" placeholder="nama" readonly>
                  </div> 
                </div>
              </div> 
              <table id="cart" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width:40%"> Buku</th>
                        <th style="width:40%">Jumlah Ambil</th>
                        <th style="width:40%">Gudang Penyimpanan</th>
                    </tr>
                </thead>
                <tbody> 
                @foreach($datas as $index => $d )
                  <tr>
                      <td data-th="Price">{{$d->nama}}</td>
                      <td data-th="Quantity">{{$d->jumlah}}</td>             
                      <td data-th="Quantity">
                        {{$d->kode_lp}}
                      </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              @csrf 
              @method("PUT")
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
										<label >Pengiriman</label>
										<div class="radio-list">
                      <label class="radio-inline">
                        <input type="radio" name="optionsRadios" id="optionsEkpedisi" value="kirim" required="required" checked onclick="text(0)"> 
                        Kirim
                      </label>
											<label class="radio-inline">
											  <input type="radio" name="optionsRadios" id="optionsAmbil" value="ambil" onclick="text(1)"> 
                        Ambil 
                      </label>
										</div>
									</div>
                </div>
              </div>
              <div class="row" id="mycode">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lokasiPenyimpanan" class="control-label">Pengirim 1 <span style="color:red">
                      * </span>
                    </label>
                      <select class="form-control" name="id_pengirim1" id="id_pengirim1" required>
                        <option value="" class="form-control" >Pilih Pengirim 1</option>
                        @foreach($dataKaryawan as $a)
                          <option value="{{$a->id}}" name="pengirim1"class="form-control" id="pengirim1">{{$a->namaDepan}} {{$a->namaBelakang}}</option>
                        @endforeach
                      </select> 
                  </div> 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="lokasiPenyimpanan" class="control-label">Pengirim 2</label>
                      <select class="form-control" name="id_pengirim2" id="id_pengirim2">
                        <option value="" class="form-control" >Pilih Pengirim 2</option>
                        @foreach($dataKaryawan as $a)
                          <option value="{{$a->id}}" name="pengirim2"class="form-control" id="pengirim2">{{$a->namaDepan}} {{$a->namaBelakang}}</option>
                        @endforeach
                      </select> 
                  </div> 
                </div>
              </div>
              <div class="row" id="mycode2">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lokasiPenyimpanan" class="control-label">Kode Kendaraan<span style="color:red">
                      * </span>
                    </label>
                    <select class="form-control" name="kode_kendaraan" id="kode_kendaraan" required>
                      <option value="" class="form-control" >Pilih Kendaraan</option>
                      @foreach($dataInventaris as $a)
                        <option value="{{$a->kode}}" name="kendaraan "class="form-control" id="kendaraan">{{$a->platNomor}}</option>
                      @endforeach
                    </select> 
                  </div> 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="lokasiPenyimpanan" class="control-label">Ekspedisi</label>
                      <select class="form-control" name="id_ekspedisi" id="id_ekspedisi">
                        <option value="" class="form-control" >Pilih Ekspedisi</option>
                        @foreach($dataEkspedisi as $a)
                          <option value="{{$a->id}}" name="ekspedisi"class="form-control" id="ekspedisi">{{$a->nama}}</option>
                        @endforeach
                      </select> 
                  </div> 
                </div>
              </div>
            </div> 
            <div class="form-actions right">
              <div id="button">
                <button type="submit" class="btn btn-info"><i class="fa fa-check"></i>Simpan</button>
                <a href ="{{ URL::previous() }}" type="button" class="btn btn-default">Batal</a>
              </div>
            </div>
          </form>
        <!-- END FORM-->
      </div>
    </div>
  </div>
 


@endsection
@section('tempat_script')
  <script>
    function text(x){
      if(x==0) {
        document.getElementById("mycode").style.display = "block";
        document.getElementById("mycode2").style.display = "block";
        $('select').each(function() 
        {    
	        $(this).attr('required');
        });
      }
      else {
        document.getElementById("mycode").style.display = "none";
        document.getElementById("mycode2").style.display = "none";
        $('select').each(function() 
        {    
	        $(this).removeAttr('required');
        });
      }
      return
    }

  </script>
@endsection
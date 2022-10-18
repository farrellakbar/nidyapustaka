@extends('layout.conquer')
@section('content')

<!-- START TAMBAH LINIMASA PRODUKSI WITH MODALS & AJAX-->
  <div class="modal fade" id="perbaruiProduksi" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">
            Perbarui Produksi
          </h4>
        </div>
        <form method="POST" action="{{ route('linimasaTahapan.store') }}"> 
          <div class="modal-body">
            @csrf
            @foreach($idProsesProduksi as $d)
              <input name="id_Produksi" type="hidden" value="{{$d->id}}">
            @endforeach
            <div class="form-group row"> 
                <label for="kode_inventaris" class="col-sm-4 col-form-label">
                  Tahap
                  <span style="color:red;">
									  * 
                  </span>
                </label>
                @foreach($data as $a )
                  @if ($loop->last)
                  <div class="col-sm-3"> 
                    <input type="number" value="" placeholder="Pilih Tahap" name="tahapKet" min="{{$a->keteranganTahapan->tahap}}" max="6" class="form-control" id="tahapKet" required>
                  </div>
                  <div class="col-sm-5" id="namaTahapan"> 
                    <input type="text" value="" name="namaTahap" class="form-control" id="namaTahap"  placeholder="Tahapan" readonly>
                  </div>
                  @endif
                @endforeach
            </div>  
            <div class="form-group row"> 
                <label for="kode_inventaris" class="col-sm-4 col-form-label">
                  Keterangan
                  <span style="color:red;">
									  * 
                  </span>
                </label>
                <div class="col-sm-8">
                    <select class="form-control" name="id_keterangan" id="id_keterangan" required>
                      <option value="" class="form-control" disabled selected>Pilih Keterangan</option>
                    </select> 
                </div>
            </div>
            <div class="form-group row"> 
                <label for="bahanBaku" class="col-sm-4 col-form-label">Bahan Baku <span style="color:red;">
									  * 
                  </span>
                </label>
                <label class="radio-inline">
                  <input type="radio" name="optionsRadios" id="optionsEkpedisi" value="kirim" required="required" checked onclick="text(0)"> 
                  Iya
                </label>
								<label class="radio-inline">
								  <input type="radio" name="optionsRadios" id="optionsAmbil" value="ambil" onclick="text(1)"> 
                  Tidak 
                </label>
            </div>    
            <div class="form-group row" id="mycode"> 
                <label for="bahanBaku" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <select class="form-control" name="id_sediaan" id="id_sediaan">
                      <option value="" class="form-control" disabled selected>Pilih Pemakaian Sediaan</option>
                      @foreach($sediaan as $a )
                          @if($a->jumlahSediaan > 0)
                            <option value="{{$a->id}}" name="sediaan"class="form-control" id="sediaan">{{$a->nama}}</option>
                          @else
                            <option value="{{$a->id}}" name="sediaan"class="form-control" id="sediaan" disabled>{{$a->nama}} (Habis)</option>
                          @endif
                      @endforeach
                    </select> 
                </div>
            </div>  
            <div class="form-group row" id="mycode2">
              <label for="kendala" class="col-sm-4 col-form-label">Jumlah Pemakaian</label>
              <div class="col-md-4" id="isiInput"> 
                <input type="number" name="jumlah" min="0" class="form-control" id="jumlah" placeholder="Jumlah" value="">
              </div>
              <div class="col-md-4" id="labelSatuan">
                <input type="text" value="" name="satuan" class="form-control" id="satuan"  placeholder="Satuan" readonly>
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
<!-- END TAMBAH LINIMASA PRODUKSI WITH MODALS & AJAX-->
<!-- START MASUK GUDANG PENYIMPANAN WITH MODALS & AJAX-->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true"> 
    <div class="modal-dialog">
      <div class="modal-content" id="modalContent">

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- END EMASUK GUDANG PENYIMPANAN WITH MODALS & AJAX-->

  <h2 class="page-title">
    Proses <small>produksi</small>
  </h2>
  <div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <i class="fa fa-home"></i>
        <a href="/">Beranda</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="/produksi">Produksi</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="/produksi">Proses</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="#">Linimasa</a>
      </li>
    </ul>
  </div>
  <div class="content">
      <div class="row">
        @foreach($data as $a )
          @if ($loop->last)
          <div class="col-md-4">
            <div style="padding-bottom:30px;">
              <h3>
                <b>Produksi Berlangsung</b>
              </h3>
            </div>
            <div class="row" style="padding-bottom:10px;">
              <div class="col-xs-4 col-md-5" >ID Produksi</div>
              <div class="col-xs-2 col-md-3">=</div>
              <div class="col-xs-3 col-md-4" >{{ $a->prosesProduksi->id }}</div>
            </div>
            <div class="row" style="padding-bottom:10px;">
              <div class="col-xs-4 col-md-5" >Nama Buku</div>
              <div class="col-xs-2 col-md-3">=</div> 
              <div class="col-xs-3 col-md-4" >{{ $a->prosesProduksi->buku->nama }}</div>
            </div>
            <div class="row" style="padding-bottom:10px;">
              <div class="col-xs-4 col-md-5" >Jumlah</div>
              <div class="col-xs-2 col-md-3">=</div>
              <div class="col-xs-3 col-md-4" >{{ $a->prosesProduksi->jumlah }} Buku</div>
            </div>
            <div class="row" style="padding-bottom:10px;">
              <div class="col-xs-4 col-md-5" >Tahap</div>
              <div class="col-xs-2 col-md-3">=</div>
              <div class="col-xs-3 col-md-4" >Tahap {{ $a->prosesProduksi->tahap }}</div>
            </div>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            <div class="col text-center">
              <div class="row" style="padding-bottom:10px;">
                @if($a->keteranganTahapan->tahap <=5 AND Auth::user()->role == "supervisor")
                  <div class="btn-group"> 
                    <a type="button" class="btn btn-lg btn-info" data-toggle="modal" href="#perbaruiProduksi">
                      Perbarui
                    </a>
                  </div>
                @elseif(Auth::user()->role == "supervisor")
                  <div class="btn-group"> 
                    <a type="button" class="btn btn-lg btn-info"  href="{{ route('produksi.edit',$a->prosesProduksi->id) }}">
                      Selesai
                    </a>
                  </div>
                @endif
                @if(Auth::user()->role == "manajer")
                <div class="btn-group"> 
                  <a type="button" class="btn btn-lg btn-link" data-toggle="modal" href="{{ url('/keteranganTahapan')}}">
                    <i class="fa fa-plus"></i>
                  </a>
                </div>
                @endif
              </div>
              <div class="row" style="padding-bottom:30px;">
                <img style="max-height: 200px;" src="{{ asset('images/'. $a->prosesProduksi->buku->foto) }}">
              </div>
            </div>
          </div>
          @endif
        @endforeach
			</div>
      @if(session('status'))
        <div class="alert alert-success">
          <strong>Sukses! </strong>
          {{ session('status') }}
        </div>
      @endif
    <!-- START DAFTAR PROSES PRODUKSI -->
      <div class="table-responsive">
          <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
              <tr>
                <th style="width:20%" class="col text-center">Tanggal Pengerjaan</th>
                <th style="width:25%">Bahan Buku</th>
                <th style="width:10%">Jumlah</th>
                <th style="width:45%">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
              <tr id='tr_{{$d->id}}'>
                <td class="col text-center">{{ $d->tanggal }}</td>
                <td>
                  @if(!empty($d->id_sediaan_bahan_baku))
                    {{ $d->sediaanBahanBaku->nama }}
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if(!empty($d->jumlahPenggunaan))
                    {{ $d->jumlahPenggunaan }} {{ $d->sediaanBahanBaku->satuan }}
                  @else
                    -
                  @endif
                </td>
                <td>{{ $d->keteranganTahapan->keterangan }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div> 
    <!-- END DAFTAR PROSES PRODUKSI -->
  </div> 
@endsection

@section('tempat_script')
  <script>
      function getDataProduksi(id)
      {
        $.ajax({
          type:'POST',
          url: '{{route("produksi.getDataProduksi")}}',
          data: {'_token':'<?php echo csrf_token() ?>',
                  'id':id
                },
          success: function(data){
            $('#modalContent').html(data.msg);
          }
        });
      }
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
      $(document).ready(function () {
        $("#tahapKet").change(function(){
				  let tahapKeterangan = this.value;
          $.get('/tahap?tahapKeterangan='+tahapKeterangan, {"_token":$("input[name='_token']").val()}, function(data){
            $('#id_keterangan').empty();
            $('#id_keterangan').append('<option value="" class="form-control" disabled >Pilih Keterangan</option>');
            $.each(data, function(upload_form, id_keterangan){
                $('#id_keterangan').append('<option class="form-control" value="'+ id_keterangan.id +'">'+ id_keterangan.keterangan +'</option>');
            });
          }) 
			  });
        $("#id_sediaan").change(function(){ 
          let id_Sediaan = this.value;
          $.get('/pemakaianSediaan?id_Sediaan='+id_Sediaan,{"_token":$("input[name='_token']").val()}, function(data){
            $('#isiInput').empty();
            $("#isiInput").html(data);
          });
			  }); 
        $("#id_sediaan").change(function(){ 
          let id_Sediaan = this.value;
          $.get('/labelSatuan?id_Sediaan='+id_Sediaan,{"_token":$("input[name='_token']").val()}, function(data){
            $('#labelSatuan').empty();
            $("#labelSatuan").html(data);
          });
			  });
        $("#tahapKet").change(function(){ 
          let tahapKeterangan = this.value;
          $.get('/tahapan?tahapKeterangan='+tahapKeterangan,{"_token":$("input[name='_token']").val()}, function(data){
            $('#namaTahapan').empty();
            $("#namaTahapan").html(data);
          });
			  });

      });
  </script>
@endsection
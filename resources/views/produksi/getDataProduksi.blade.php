@extends('layout.conquer')
@section('content') 
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
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-reorder"></i>Form Sample
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a>
          <a href="javascript:;" class="reload"></a>
        </div>
      </div>
      <div class="portlet-body form">
        <!-- BEGIN FORM-->
          <form action="{{ route('lokasiPenyimpanan.produksiSelesai') }}" class="horizontal-form" method="post">
            <div class="form-body">
              <h3 class="form-section">Selesai Produksi</h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="nama" class="control-label">Nama Buku</label>
                      <input type="hidden" value="{{ $data->id }}" name="idProduksi" class="form-control" id="idProduksi" placeholder="idProduksi" readonly>
                      <input type="hidden" value="{{ $data->buku->id }}" name="idBuku" class="form-control" id="idBuku" placeholder="idBuku" readonly>
                      <input type="text" value="{{ $data->buku->nama }}" name="nama" class="form-control" id="nama" placeholder="Nama Buku" readonly>
                  </div> 
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="jumlah" class="control-label">Jumlah</label>
                      <input type="text" value="{{ $data->jumlah }}" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah" readonly>
                  </div> 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label><br></label>
                    <h4>Buku</h4>
                  </div> 
                </div>
              </div>

              @csrf 
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="lokasiPenyimpanan" class="control-label">Lokasi Penyimpanan</label>
                      <select class="form-control" name="kode_lokasiPenyimpanan[]" id="kode_lokasiPenyimpanan">
                        <option value="" class="form-control" >Pilih Pemakaian Sediaan</option>
                        @foreach($dataLokasiPenyimpanan as $a)
                          <option value="{{$a->kode}}" name="lokasiPenyimpanan[]"class="form-control" id="lokasiPenyimpanan[]">{{$a->kode}}</option>
                        @endforeach
                      </select> 
                  </div> 
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                  <label for="jumlah" class="control-label">Detail</label>
                    <div id="detail"> 
                      <input type="text" value="" name="detail[]" class="form-control" id="detail[]" placeholder="Gudang X - Lantai 0 - Posisi XX" readonly>
                    </div>
                  </div> 
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                  <label for="jumlah" class="control-label">Ruang Tersedia</label>
                    <div id="tersedia"> 
                      <input type="text" value="" name="tersedia[]" class="form-control" id="tersedia[]" placeholder="0" readonly>
                    </div>
                  </div> 
                </div>
              </div>
              <div class="lokPenyimpanan"></div>
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

    $(document).ready(function () {
        function update()
        {
          var eIdBuku=$('#idBuku').val();
          var eJumlah=$('#jumlah').val();
          var eKodeLok=$('#kode_lokasiPenyimpanan').val();

          $.ajax({
            type:'POST',
            url: '{{route("produksi.tersedia2")}}',
            data: {'_token':'<?php echo csrf_token() ?>',
                    'idBuk':eIdBuku,
                    'jumlah':eJumlah,
                    'idLok':eKodeLok
                  },
            success: function(data){
              if(data.status == 'ok')
              {
                if(data.msg == 'kurang')
                {
                  $(".lokPenyimpanan").html(data.msg3);
                  $("#tersedia").html(data.msg2);  
                  $("#detail").html(data.msg4);  
                }
                else{
                  $(".lokPenyimpanan").html(data.msg3);
                  $("#tersedia").html(data.msg2);  
                  $("#detail").html(data.msg4);  
                }
              }
            }
          });
        }

      $("#kode_lokasiPenyimpanan").change(function(){ 
        update();
		  }); 

    });

</script>

@endsection
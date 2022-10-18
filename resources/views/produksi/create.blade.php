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
                <a href="#">Tambah</a>
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
            <form method="POST" action="{{ route('produksi.store') }}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row"> 
                        <label for="kode_inventaris" class="col-sm-4 col-form-label">Kode Buku<span style="color:red">
							* </span>
                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="id_buku" required>
                            <option value=''>
                                Pilih Buku
                            </option>
                            @foreach($dataBuku as $i)
                            <option value='{{$i->id}}' id='add_{{$i->id}}'>
                                {{$i->nama}}
                            </option> 
                            @endforeach
                            </select> 
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="kendala" class="col-sm-4 col-form-label">Jumlah Produksi<span style="color:red">
							* </span>
                        </label>
                        <div class="col-md-4"> 
                            <input type="number" value="" name="jumlah" min="100" step="50" class="form-control" id="jumlah" placeholder="Jumlah" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
                            <span class="help-block">
                                Harap isi dengan angka (Min. 100 Buku)
                            </span>
                        </div>
                        <div class="col-md-2">
                        <input type="text" value="Buku" name="satuan" class="form-control" placeholder="Satuan" readonly>   
                        </div>
                    </div> 
                    <hr>
                    <div class="form-group row">
                    <label for="waktuPengerjaan" class="col-sm-4 col-form-label">Estimasi Waktu Pengerjaan</label>
                    <div class="col-md-2">
                        <div id="waktuPengerjaan"> 
                            <input type="text" value="00-00-0000" name="waktuPengerjaan" class="form-control" id="waktuPengerjaan" readonly>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
                        <input type="text" value="Hari" name="hari" class="form-control" id="hari" readonly>
                    </div> -->
                    </div>
                    <div class="form-group row">
                    <label for="bahanBaku" class="col-sm-4 col-form-label">Estimasi Bahan Baku Kertas</label>
                    <div class="col-md-2">
                        <div id="bahanBaku"> 
                            <input type="text" value="0" name="bahanBaku" class="form-control" id="bahanBaku" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="text" value="Rim" name="Kertas" class="form-control" id="kertas" readonly>
                    </div>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                    <a href ="{{ URL::previous() }}" type="button" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

@section('tempat_script')
    <script>
        $(document).ready(function () {
            function update()
            {
                var eJumlah=$('#jumlah').val();

                $.ajax({
                    type:'POST',
                    url: '{{route("produksi.estimasi")}}',
                    data: {'_token':'<?php echo csrf_token() ?>',
                            'jumlah':eJumlah,
                        },
                    success: function(data){
                    if(data.status == 'ok')
                    {
                        $("#waktuPengerjaan").html(data.msg);
                        $("#bahanBaku").html(data.msg2);  
                    }
                    }
                });
            }
            $("#jumlah").change(function(){ 
                update();
            }); 
        });
    </script>
@endsection

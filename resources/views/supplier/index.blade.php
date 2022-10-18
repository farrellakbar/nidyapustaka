@extends('layout.conquer')
@section('content')

<!-- START EDIT BELI SEDIAAN WITH MODALS & AJAX-->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true"> 
    <div class="modal-dialog">
      <div class="modal-content" id="modalContent">

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- END EDIT BELI SEDIAAN WITH MODALS & AJAX-->

<!-- START TAMBAH SEDIAAN BAHAN BAKU WITH MODALS-->
<div class="modal fade" id="buatSediaan" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">
          Tambah Supplier Bahan Baku
        </h4>
      </div>
      <form method="POST" action="{{ route('supplier.store') }}">
        <div class="modal-body">
          @csrf 
          <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">Nama<span style="color:red">
								* </span>
              </label>
              <div class="col-sm-10">
                <input type="text" value="" name="nama" class="form-control" id="nama" placeholder="Nama" required>
              </div>
          </div> 
          <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat<span style="color:red">
								* </span>
              </label>
              <div class="col-sm-10">
                <input type="text" value="" name="alamat" class="form-control" id="alamat" placeholder="Alamat" required>
              </div>
          </div> 
          <div class="form-group row">
              <label for="kota" class="col-sm-2 col-form-label">Kota<span style="color:red">
								* </span>
              </label>
              <div class="col-sm-10">
                <input type="text" value="" name="kota" class="form-control" id="kota" placeholder="Kota" required>
              </div>
          </div> 
          <div class="form-group row">
              <label for="nomorTelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
              <div class="col-sm-10">
                <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" maxlength="15" value="" name="nomorTelepon" class="form-control" id="nomorTelepon" placeholder="Nomor Telepon">
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
<!-- END TAMBAH SEDIAAN BAHAN BAKU WITH MODALS-->

<h2 class="page-title">
  Bahan Baku <small>perusahaan</small>
</h2>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="fa fa-home"></i>
      <a href="/">Beranda</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="">Bahan Baku</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="">Supplier</a>
    </li>
  </ul>
</div>
<div class="content">
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Supplier
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a> 
          <a href="javascript:;" class="reload"></a>  
        </div>
      </div>
      <div class="portlet-body"> 
      @if(session('statusSediaan'))
        <div class="alert alert-success">
          <strong>Sukses! </strong>
          {{ session('statusSediaan') }}
        </div>
      @endif
      @if(Auth::user()->role == "manajer")
        <div class="btn-group">
          <a type="button" class="btn btn-info" data-toggle="modal" href="#buatSediaan">   
            <i class="fa fa-plus"></i> 
            Tambah Supplier
          </a>
        </div>
        <hr>
      @endif
 
        <table class="table table-striped table-bordered table-advance table-hover" id="table_supplier" > 
          <thead>
            <tr>
              <th>No.</th>
              <th >Nama</th>
              <th >Detail</th>
            </tr>
          </thead>
          <tbody>
          @foreach($dataSupplier as $index => $d)
            <tr>
              <td>{{ $index +1 }}</td>
              <td>{{ $d->nama }}</td>
              <td>
                  <a data-toggle="modal" class="btn btn-default" href="#detail_{{$d->id}}">
                    Lihat Detail
                  </a>
                  <!-- START DETAIL INVENTARIS WITH MODALS-->
                    <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">{{$d->nama}}</h4>
                          </div>
                          <div class="modal-body">
                            <table class="table">
                              <tr>
                                <th>Alamat</th>
                                <th>=</th>
                                <td>{{ $d->alamat }}</td>
                              </tr>
                              <tr>
                                <th>Kota</th>
                                <th>=</th>
                                <td>{{ $d->kota }}</td>
                              </tr>
                              <tr>
                                <th>Nomor Telepon</th>
                                <th>=</th>
                                <td>
                                  @if( !empty($d->nomorTelepon))
                                    {{ $d->nomorTelepon }}
                                  @else
                                    -
                                  @endif
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div> 
                    </div>
                  <!-- END DETAIL INVENTARIS WITH MODALS-->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> 
</div>
@endsection

@section('tempat_script')
<script>
// $("input[name='demo2']").TouchSpin({
//                 min: -1000000000,
//                 max: 1000000000,
//                 stepinterval: 50,
//                 maxboostedstep: 10000000,
//                 prefix: '$'
//             });
  function getBeliSediaan(id)
  {
    $.ajax({
      type:'POST',
      url: '{{route("sediaanBahanBaku.getBeliSediaan")}}',
      data: {'_token':'<?php echo csrf_token() ?>',
              'id':id
            },
      success: function(data){
        $('#modalContent').html(data.msg);
      }
    });
  }
</script>
@endsection

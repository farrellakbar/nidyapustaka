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
            Tambah Sediaan Bahan Baku
          </h4>
        </div>
        <form method="POST" action="{{ route('sediaanBahanBaku.store') }}">
          <div class="modal-body">
            @csrf 
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" value="" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                </div>
            </div> 
            <div class="form-group row">
                <label for="id_supplier" class="col-sm-2 col-form-label">Supplier</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_supplier">
                    @foreach($dataSupplier as $i)
                      <option value='{{$i->id}}' id='add_{{$i->id}}'>
                        {{$i->nama}}
                      </option>
                    @endforeach
                    </select> 
                </div>
            </div>
            <div class="form-group row">
                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_kategori">
                    @foreach($dataKategori as $i)
                      <option value='{{$i->id}}' id='add_{{$i->id}}'>
                        {{$i->nama}}
                      </option>
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
                  <input type="number" value="" name="harga" min="0" class="form-control" placeholder="Harga" required>
                </div>
                <div class="col-md-3">
                  <input type="text" value="" name="satuan" class="form-control" placeholder="Satuan" required>   
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
  Sediaan Bahan Baku <small>perusahaan</small>
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
      <a href="">Sediaan</a>
    </li>
  </ul>
</div>
<div class="content">
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Persediaan Bahan Baku
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
            Beli Baru Sediaan Bahan Baku
          </a>
        </div>
        <hr>
      @endif
        <table class="table table-striped table-bordered table-advance table-hover datatable-np" id="table_sediaan">
          <thead>
            <tr>
              <th>No.</th>
              <th >Nama</th>
              <th>Harga</th>
              <th>Jumlah Persediaan</th>
              <th>Satuan</th>
              <th>Kategori</th>
              <th>Supplier</th>
              @if(Auth::user()->role == "manajer")
                <th>Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
          @foreach($data as $index => $d)
            <tr>
              <td>{{ $index +1 }}</td>
              <td>{{ $d->nama }}</td>
              <td>{{ $d->harga }}</td>
              <td>{{ $d->jumlahSediaan }}</td>
              <td>{{ $d->satuan }}</td>
              <td>{{ $d->kategoriBahanBaku->nama }} </td> 
              <td>{{ $d->supplier->nama }}</td>
              @if(Auth::user()->role == "manajer")
                <td> 
                  <div class="col text-center"> 
                    <a href="#modalEdit" data-toggle="modal" class="btn btn-lg btn-link btn-xs" onclick="getEditForm('{{$d->id}}')">
                      <i class="fa fa-edit"></i>
                      Edit
                    </a>
                    <a  href="{{url('tambahKeranjang/'.$d->id_supplier.'/'.$d->id)}}" data-toggle="modal" class="btn btn-warning btn-xs">
                      <i class="fa fa-shopping-cart"></i>
                      Beli
                    </a>
                  </div>
                </td>
              @endif
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
  // function getBeliSediaan(id)
  // {
  //   $.ajax({
  //     type:'POST',
  //     url: '{{route("sediaanBahanBaku.getBeliSediaan")}}',
  //     data: {'_token':'<?php echo csrf_token() ?>',
  //             'id':id
  //           },
  //     success: function(data){
  //       $('#modalContent').html(data.msg);
  //     }
  //   });
  // }

  function getEditForm(id)
    {
      $.ajax({
        type:'POST',
        url: '{{route("sediaanBahanBaku.getEditForm")}}',
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

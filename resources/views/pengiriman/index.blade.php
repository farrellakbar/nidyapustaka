@extends('layout.conquer')
@section('content')
<!-- START TAMBAH EKSPEDISI WITH MODALS & AJAX-->
  <div class="modal fade" id="buatEkspedisi" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">
            Tambah Ekspedisi
          </h4>
        </div>
        <form enctype="multipart/form-data" method="POST" action="{{ route('ekspedisi.store') }}">
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
                <label for="nama" class="col-sm-2 col-form-label">Alamat<span style="color:red">
									* </span>
                </label>
                <div class="col-sm-10">
                <input type="text" value="" name="alamat" class="form-control" id="alamat" placeholder="Alamat" required>
                </div>
            </div> 
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  maxlength="14" name="nomorTelepon" class="form-control" id="nomorTelepon" placeholder="No Telepon">
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
<!-- END TAMBAH EKSPEDISI WITH MODALS & AJAX-->
<!-- START EDIT EKSPEDISI WITH MODALS & AJAX-->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true"> 
    <div class="modal-dialog">
      <div class="modal-content" id="modalContent">

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- END EDIT EKSPEDISI WITH MODALS & AJAX-->

<h2 class="page-title">
  Pengiriman <small>penjualan</small>
</h2>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="fa fa-home"></i>
      <a href="/">Beranda</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="#">Pengiriman</a>
    </li>
  </ul>
</div>

<div class="content">
  <!-- START DAFTAR PEENGIRIMAN -->
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Pengiriman
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
        @if(session('eror'))
          <div class="alert alert-danger">
              <strong>Gagal! </strong>
              {{ session('eror') }} 
          </div>
        @endif
        <table class="table table-striped table-bordered table-advance table-hover datatable-np" id="table_pengiriman">
          <thead>
            <tr>
              <th width="15%" class="col text-center">
                No Nota
              </th>
              <th width="15%">
                Tanggal Transaksi
              </th>
              <th width="22%">
                Konsumen
              </th>
              <th width="20%">
                Karyawan
              </th>
              <th width="20%">
                Total Harga
              </th>
              @if(Auth::user()->role == "manajer")
                <th width="8%" class="col text-center">
                  Actions
                </th>
              @endif 
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
              <tr> 
                <td class="col text-center">{{ $d->id }}</td>
                <td>{{ $d->tanggalPenjualan }}</td>
                <td>{{ $d->Konsumen->namaPemesan }} 
                  @if(isset($d->Konsumen->namaToko))
                    ( {{ $d->Konsumen->namaToko }} )
                  @endif
                </td>
                <td>{{ $d->karyawan->namaDepan }} {{ $d->karyawan->namaBelakang }}</td>
                <td>Rp. {{ $d->totalHarga }}</td>
                @if(Auth::user()->role == "manajer")
                <td class="col text-center">
                  @if( $d->status == 'proses')
                    <a href="{{ route('penjualanBuku.edit',$d->id) }}" class="btn btn-xs btn-warning"></i> 
                      Proses
                    </a>
                  @else
                    <a href="{{ route('pengiriman.selesai',$d->id) }}" class="btn btn-xs btn-success"></i> 
                      Selesai
                    </a>
                  @endif 
                </td>
                @endif 
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  <!-- END DAFTAR PEENGIRIMAN -->
  <!-- START DAFTAR EKSPEDISI -->
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Ekspedisi
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a>
          <a href="javascript:;" class="reload"></a>
        </div>
      </div>
      <div class="portlet-body"> 
        @if(session('successEkspedisi'))
          <div class="alert alert-success">
              <strong>Sukses! </strong>
              {{ session('successEkspedisi') }} 
          </div>
        @endif
        @if(Auth::user()->role == "manajer")
          <div class="btn-group"> 
              <a type="button" class="btn btn-info" data-toggle="modal" href="#buatEkspedisi">
                <i class="fa fa-plus"></i>   
                Tambah Data Ekspedisi
              </a>
          </div>
          <hr>
        @endif
        <table class="table table-striped table-bordered table-advance table-hover datatable-np" id="table_ekspedisi">
            <thead>
              <tr>
                <th width="17%" class="col text-center">
                  No
                </th>
                <th width="17%">
                  Nama
                </th>
                <th width="24%">
                  Alamat
                </th>
                <th width="22%">
                  Nomor Telepon
                </th>
                @if(Auth::user()->role == "manajer")
                  <th width="10%" class="col text-center">
                    Actions
                  </th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($dataEkspedisi as $d)
                <tr id='tr_{{$d->id}}'> 
                  <td class="col text-center">{{ $d->id }}</td>
                  <td>{{ $d->nama }}</td>
                  <td>{{ $d->alamat }}</td>
                  <td>{{ $d->nomorTelepon }}</td>
                  @if(Auth::user()->role == "manajer")
                    <td class="col text-center">
                      <a href="#modalEdit" data-toggle="modal" class="btn btn-lg btn-link btn-xs" onclick="getEditForm('{{$d->id}}')">
                          <i class="fa fa-edit"></i>
                          Edit
                        </a>
                      <a class="btn btn-danger btn-xs" onclick="if(confirm('Apakah anda yakin?')) deleteDataRemoveTR('{{$d->id}}')">
                        <i class="fa fa-trash-o "></i>
                        Hapus
                      </a>
                    </td>
                  @endif
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  <!-- END DAFTAR PEENGIRIMAN -->
</div> 
<!-- MODEL -->
@endsection

@section('tempat_script')
<script>
  function getEditForm(id)
  {
    $.ajax({
      type:'POST',
      url: '{{route("ekspedisi.getEditForm")}}',
      data: {'_token':'<?php echo csrf_token() ?>',
              'id':id
            },
      success: function(data){
        $('#modalContent').html(data.msg);
      }
    });
  }
  function deleteDataRemoveTR(id)
  {
    $.ajax({
      type:'POST',
      url: '{{route("ekspedisi.deleteData")}}',
      data: {'_token':'<?php echo csrf_token() ?>',
              'id':id
            },
      success: function(data){
        if(data.status == 'ok')
        {
          alert(data.msg);
          $('#tr_'+id).remove();
        } 
        else{
          alert(data.msg);
        }
      }
    });
  }
</script>
@endsection
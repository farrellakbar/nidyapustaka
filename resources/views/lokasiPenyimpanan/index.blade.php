@extends('layout.conquer')
@section('content')

  <!-- START TAMBAH LOKASI PENYIMPANAN WITH MODALS & AJAX-->
    <div class="modal fade" id="buatLokasi" tabindex="-1" role="basic" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">
              Tambah Lokasi Penyimpanan
            </h4>
          </div>
          <form method="POST" action="{{ route('lokasiPenyimpanan.store') }}" class="horizontal-form">
            <div class="form-body">
            @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Gudang</label>
                    <input type="text" value="" name="gudang"class="form-control" id="gudang" placeholder="Gudang" maxlength="4" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Lantai</label>
                    <input type="number" value="" min="1" max="2" name="lantai"class="form-control" id="lantai" placeholder="Lantai" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Posisi</label>
                    <input type="text" value="" name="posisi"class="form-control" id="posisi" placeholder="Posisi" maxlength="4" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Kapasitas Maksimal</label>
                    <input type="number" value="" min="0" name="kapasitasMaksimal"class="form-control" id="kapasitasMaksimal" placeholder="Kapasitas Maksimal" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-actions right">
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- END TAMBAH LOKASI PENYIMPANAN WITH MODALS & AJAX-->
  <!-- START EDIT INVENTARIS WITH MODALS & AJAX-->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true"> 
      <div class="modal-dialog">
        <div class="modal-content" id="modalContent">

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- END EDIT INVENTARIS WITH MODALS & AJAX-->

  <h2 class="page-title">
    Lokasi <small>penyimpanan</small>
  </h2>
  <div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <i class="fa fa-home"></i>
        <a href="/">Beranda</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="#">Lokasi Penyimpanan</a>
      </li>
    </ul>
  </div>

  <div class="content">
    <!-- START PENYIMPANAN -->
      <div class="portlet">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>Penyimpanan
          </div>
          <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="javascript:;" class="reload"></a>
          </div>
        </div>
        <div class="portlet-body"> 
        @if(session('status'))
          <div class="alert alert-success">
            <strong>Sukses! </strong>
            {{ session('status') }}
          </div>
        @endif
          <table class="table table-striped table-bordered table-advance table-hover" id="table_penyimpanan">
            <thead>
              <tr>
                <th style="width:20%">Tanggal Masuk Gudang</th>
                <th style="width:45%">Nama Buku (Kode Produksi)</th>
                <th style="width:25%">Jumlah</th>
                <th style="width:10%" class="col text-center">Tempat Penyimpanan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data2 as $d)
                <tr>
                  <td>{{ $d->tanggalMasuk }}</td> 
                  <td>{{ $d->nama }} ({{ $d->id }})</td>
                  <td>{{ $d->jumlah }}</td>
                  <td class="col text-center">{{ $d->kode_lokPenyimpanan }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
    <!-- END PENYIMPANAN -->
    <!-- START LOKASI PENYIMPANAN -->
      <div class="portlet">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>Lokasi Penyimpanan
          </div>
          <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="javascript:;" class="reload"></a>
          </div>
        </div>
        <div class="portlet-body"> 
        @if(session('status2'))
          <div class="alert alert-success">
            <strong>Sukses! </strong>
            {{ session('status2') }}
          </div>
        @endif
        @if(Auth::user()->role == "manajer")
          <div class="btn-group"> 
            <a type="button" class="btn btn-info" data-toggle="modal" href="#buatLokasi">
              <i class="fa fa-plus"></i>
              Tambah Lokasi Penyimpanan
            </a>
          </div>
          <hr>
        @endif
          <table class="table table-striped table-bordered table-advance table-hover" id="table_lokasiPenyimpanan">
            <thead>
              <tr>
                <th style="width:10%" class="col text-center">Kode</th>
                <th style="width:25%">Gudang</th>
                <th style="width:15%">Lantai</th>
                <th style="width:10%">Posisi</th> 
                <th style="width:10%">Jumlah Terkini</th>
                <th style="width:10%">Kapasitas Maksimal</th>
                <th style="width:15%">Status</th>
                @if(Auth::user()->role == "manajer")
                  <th style="width:15%">Edit</th>
                @endif

              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
                <tr>
                  <td class="col text-center">{{ $d->kode }}</td>
                  <td>Gudang {{ $d->gudang }}</td>
                  <td>{{ $d->lantai }}</td>
                  <td>{{ $d->posisi }}</td>
                  <td>{{ $d->jumlahTerkini }}</td> 
                  <td>{{ $d->kapasitasMaksimal }}</td> 
                  <td>{{ $d->status }}</td> 
                  @if(Auth::user()->role == "manajer")
                  <td>
                    <div class="col text-center">
                      <a href="#modalEdit" data-toggle="modal" class="btn btn-lg btn-link btn-xs" onclick="getEditForm('{{$d->kode}}')">
                        <i class="fa fa-edit"></i>
                        Edit
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
    <!-- END DAFTAR DAFTAR PRA PRODUKSI -->
  </div> 
@endsection

@section('tempat_script')
  <script>
    function getEditForm(kode)
    {
      $.ajax({
        type:'POST',
        url: '{{route("lokasiPenyimpanan.getEditForm")}}',
        data: {'_token':'<?php echo csrf_token() ?>',
                'kode':kode
              },
        success: function(data){
          $('#modalContent').html(data.msg);
        }
      });
    }
  </script>
@endsection
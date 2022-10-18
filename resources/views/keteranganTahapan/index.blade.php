@extends('layout.conquer')
@section('content')

<!-- START TAMBAH KETERANGAN WITH MODALS & AJAX-->
  <div class="modal fade" id="buatKeterangan" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">
            Tambah Keterangan
          </h4>
        </div>
        <form method="POST" action="{{ route('keteranganTahapan.store') }}">
          <div class="modal-body">
            @csrf 
            <div class="form-group row">
                <label for="kendala" class="col-sm-4 col-form-label">Tahap</label>
                <div class="col-sm-4">
                  <input type="number" min="1" max ="6" value="" id="tahap" name="tahap" class="form-control" placeholder="Tahap">   
                </div>
            </div> 
            <div class="form-group row">
              <label for="waktuPengerjaan" class="col-sm-4 col-form-label">Keterangan Tahapan</label>
              <div class="col-sm-8">
                <textarea name="keterangan" class="form-control" id="keterangan" rows="3" placeholder="Keterangan"></textarea>
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
<!-- END TAMBAH KETERANGAN WITH MODALS & AJAX-->


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
        <a href="#">Root</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="#">Tahapan Keterangan</a>
      </li>
    </ul>
  </div>

  <div class="content">
    <!-- START TAHAPAN KETERANGAN -->
      <div class="portlet">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>Keterangan Tahapan
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
          <div class="btn-group"> 
            <a type="button" class="btn btn-info" data-toggle="modal" href="#buatKeterangan">
              + Tambah Keterangan Tahapan
            </a>
          </div>
          <hr>
          <table class="table table-striped table-bordered table-advance table-hover" id="table_praProduksi">
            <thead>
              <tr>
                <th style="width:10%" class="col text-center">No.</th>
                <th style="width:20%">Tahap</th>
                <th style="width:70%">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $d)
              <tr id='tr_{{$d->id}}'>
                <td class="col text-center">{{ $index + 1 }}</td>
                <td>Tahap {{ $d->tahap }}</td>
                <td>{{ $d->keterangan }} Buku</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
    <!-- END TAHAPAN KETERANGAN -->
  </div> 
@endsection

@section('tempat_script')
  <script>

  </script>
@endsection
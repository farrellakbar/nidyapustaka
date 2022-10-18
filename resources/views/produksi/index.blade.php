@extends('layout.conquer')
@section('content')

<!-- START TAMBAH PRODUKSI WITH MODALS & AJAX-->
  <div class="modal fade" id="buatProduksi" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">
            Tambah Produksi
          </h4>
        </div>
        <form method="POST" action="{{ route('produksi.store') }}">
          <div class="modal-body">
            @csrf
            <div class="form-group row"> 
                <label for="kode_inventaris" class="col-sm-4 col-form-label">Kode Buku</label>
                <div class="col-sm-4">
                    <select class="form-control" name="id_buku">
                    @foreach($dataBuku as $i)
                      <option value='{{$i->id}}' id='add_{{$i->id}}'>
                        {{$i->nama}}
                      </option>
                    @endforeach
                    </select> 
                </div>
            </div>  
            <div class="form-group row">
                <label for="kendala" class="col-sm-4 col-form-label">Jumlah Produksi</label>
                <div class="col-md-4"> 
                  <input type="number" value="100" name="jumlah" min="100" class="form-control" id="jumlah" placeholder="Jumlah" required>
                </div>
                <div class="col-md-2">
                  <input type="text" value="Buku" name="satuan" class="form-control" placeholder="Satuan" readonly>   
                </div>
            </div> 
            <hr>
            <div class="form-group row">
              <label for="waktuPengerjaan" class="col-sm-4 col-form-label">Estimasi Waktu Pengerjaan</label>
              <div class="col-md-2">
                <input type="text" value="0" name="waktuPengerjaan" class="form-control" id="waktuPengerjaan" readonly>
              </div>
              <div class="col-md-2">
                <input type="text" value="Hari" name="hari" class="form-control" id="hari" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="bahanBaku" class="col-sm-4 col-form-label">Estimasi Bahan Baku Kertas</label>
              <div class="col-md-2">
                <input type="text" value="0" name="bahanBaku" class="form-control" id="bahanBaku" readonly>
              </div>
              <div class="col-md-2">
                <input type="text" value="Kertas" name="Kertas" class="form-control" id="kertas" readonly>
              </div>
            </div>
          </div> 
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- END TAMBAH PRODUKSI WITH MODALS & AJAX-->


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
        <a href="#">Produksi</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="#">Proses</a>
      </li>
    </ul>
  </div>

  <div class="content">
    <!-- START DAFTAR PRA PRODUKSI -->
      <div class="portlet">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>Pra-Produksi
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
        @if(Auth::user()->role == "supervisor")
            <a  class="btn btn-info" href="{{ route('produksi.create') }}">
              <i class="fa fa-plus"></i>   
              Tambah Rencanan Produksi
            </a>
          <hr>
        @endif

          <table class="table table-striped table-bordered table-advance table-hover" id="table_praProduksi">
            <thead>
              <tr>
                <th style="width:10%" class="col text-center">Kode Produksi</th>
                <th style="width:50%">Nama Buku</th>
                <th style="width:25%">Jumlah</th>
                <!-- <th style="width:15%">Estimasi Waktu</th> -->
                @if(Auth::user()->role == "supervisor")
                  <th style="width:15%" class="col text-center">Mulai</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d)
                <tr id='tr_{{$d->id}}'>
                  <td class="col text-center">{{ $d->id }}</td>
                  <td>{{ $d->buku->nama }}</td>
                  <td id="jumlah">{{ $d->jumlah }} Buku</td>
                  <!-- <td id="estimasi">0 Hari</td> -->
                  @if(Auth::user()->role == "supervisor")
                    <td class="col text-center">
                        <a href="{{ route('produksi.editMulai',$d->id) }}" class="btn btn-danger btn-xs">
                          <i class="fa fa-paper-plane-o"></i>
                          Mulai
                        </a>
                    </td>
                  @endif 
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
    <!-- END DAFTAR DAFTAR PRA PRODUKSI -->
    <!-- START DAFTAR PROSES PRODUKSI -->
      <div class="portlet">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>Proses Produksi
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
          <table class="table table-striped table-bordered table-advance table-hover"  id="table_prosesProduksi">
            <thead>
              <tr>
                <th style="width:20%" class="col text-center">Kode Produksi</th>
                <th style="width:45%">Nama Buku</th>
                <th style="width:35%">Tahap</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data2 as $d)
              <t>
                <td class="col text-center">{{ $d->id }}</td>
                <td>
                  <a href="{{ route('produksi.linimasa', $d->id)}}">
                    {{ $d->buku->nama }}
                  </a>
                </td>
                <td>
                  Tahap {{ $d->tahap }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
    <!-- END DAFTAR PROSES PRODUKSI -->
  </div> 
@endsection

@section('tempat_script')
  <script>
    $(document).ready(function () {
      // function update()
      //   {
      //     var eJumlah=$('#jumlah').val();

      //     $.ajax({
      //       type:'POST',
      //       url: '{{route("produksi.estimasiIndex")}}',
      //       data: {'_token':'<?php echo csrf_token() ?>',
      //               'jumlah':eJumlah,
      //             },
      //       success: function(data){
      //         if(data.status == 'ok')
      //         {
      //             $("#estimasi").text(data.msg);  
      //         }
      //       }
      //     });
      //   }
      //   update();
    });
  </script>
@endsection  
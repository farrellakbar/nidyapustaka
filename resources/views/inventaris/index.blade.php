@extends('layout.conquer')
@section('content')
<!-- START TAMBAH INVENTARIS WITH MODALS & AJAX-->
  <div class="modal fade" id="buatInventaris" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">
            Tambah Inventaris
          </h4>
        </div>
        <form enctype="multipart/form-data" method="POST" action="{{ route('inventaris.store') }}">
          <div class="modal-body">
            @csrf
            <div class="form-group row">
                <label for="kode" class="col-sm-2 col-form-label">Kode<span style="color:red">
									* </span>
                </label>
                <div class="col-sm-4">
                <input type="text" value="" name="kode" class="form-control" id="kode" placeholder="Kode" required>
                </div>
            </div>  
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama<span style="color:red">
									* </span>
                </label>
                <div class="col-sm-10">
                <input type="text" value="" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                </div>
            </div> 
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Tahun Pembuatan</label>
                <div class="col-sm-10">
                  <input type="number" value="" name="tahunPembuatan" min="2000" max="2022" step="1" placeholder="Tahun Pembuatan">   
                </div>
            </div> 
            <div class="form-group row">
                <label for="Foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <input type="file" value="" name="foto" class="form-control" id="foto" placeholder="Foto">
                </div>
            </div>  
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Plat Nomor</label>

                  <div class="col-md-3">
                    <input type="text"  maxlength="2" name="kota" class="form-control" id="kota" placeholder="L">
                  </div>
                  <div class="col-md-4">
                    <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  maxlength="4" name="nomor" class="form-control" id="nomor" placeholder="0000">
                  </div>
                  <div class="col-md-3">
                    <input type="text"  maxlength="3" name="huruf" class="form-control" id="huruf" placeholder="AA">
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
<!-- END TAMBAH INVENTARIS WITH MODALS & AJAX-->

<!-- START TAMBAH PERAWATAN INVENTARIS WITH MODALS & AJAX-->
  <div class="modal fade" id="buatPerawatan" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">
            Tambah Perawatan
          </h4>
        </div>
        <form method="POST" action="{{ route('riwayatPerawatan.store') }}">
          <div class="modal-body">
            @csrf
            <div class="form-group row">
                <label for="kode_inventaris" class="col-sm-3 col-form-label">Kode Inventaris<span style="color:red">
									* </span>
                </label>
                <div class="col-sm-4">
                    <select class="form-control" name="kode_inventaris" required>
                    <option value="">
                      Pilih Inventaris
                    </option>
                      @foreach($data2 as $i)
                        <option value='{{$i->kode}}' id='add_{{$i->kode}}'>
                          {{$i->nama}}
                        </option>
                      @endforeach
                    </select> 
                </div>
            </div>  
            <div class="form-group row">
                <label for="kendala" class="col-sm-3 col-form-label">Kendala</label>
                <div class="col-sm-9">
                <input type="text" value="" name="kendala" class="form-control" id="kendala" placeholder="kendala">
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
<!-- END TAMBAH PERAWATAN INVENTARIS WITH MODALS & AJAX-->

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
  Inventaris <small>perusahaan</small>
</h2>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="fa fa-home"></i>
      <a href="/">Beranda</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="#">Inventaris</a>
    </li>
  </ul>
</div>

<div class="content">
  <!-- START DAFTAR INVENTARIS -->
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Inventaris
        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse"></a>
          <a href="javascript:;" class="reload"></a>
        </div>
      </div>
      <div class="portlet-body"> 
        @if(session('statusInventaris'))
          <div class="alert alert-success">
            <strong>Sukses! </strong>
            {{ session('statusInventaris') }}
          </div>
        @endif
        @if(session('errorInventaris'))
          <div class="alert alert-danger">
            <strong>Gagal! </strong>
            {{ session('errorInventaris') }}
          </div>
        @endif
        @if(Auth::user()->role == "manajer")
          <div class="btn-group"> 
              <a type="button" class="btn btn-info" data-toggle="modal" href="#buatInventaris">
                <i class="fa fa-plus"></i>   
                Tambah Data Inventaris
              </a>
          </div>
          <hr>
        @endif
        <table class="table table-striped table-bordered table-advance table-hover datatable-np" id="table_inventaris">
          <thead>
            <tr>
              <th style="width:10%" class="col text-center">Kode</th>
              <th style="width:30%">Nama</th>
              <th style="width:20%">Tanggal Pembelian</th>
              <th style="width:15%">Tahun Pembuatan</th>
              <th style="width:10%">Status</th>

              @if(Auth::user()->role == "manajer")
                <th style="width:20%" class="col text-center">Actions</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
              <tr id='tr_{{$d->kode}}'>
                <td class="col text-center">{{ $d->kode }}</td>
                <td id='td_nama_{{$d->kode}}'>
                    <a data-toggle="modal" href="#detail_{{$d->kode}}">{{ $d->nama }}</a>
                    <!-- START DETAIL INVENTARIS WITH MODALS-->
                      <div class="modal fade" id="detail_{{$d->kode}}" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{$d->nama}}</h4>
                            </div>
                            <div class="modal-body">
                              <h4><b>Foto :</b></h4> <br><br>
                              <div class="col text-center">
                                @if( !empty($d->foto))
                                  <a href="{{ asset('images/'. $d->foto) }}" target="_blank">
                                    <img style="max-height: 200px;" src="{{ asset('images/'. $d->foto) }}">
                                  </a>
                                  @if(Auth::user()->role == "manajer")
                                  <br>
                                  <a href="#modalEditFoto{{ $d->kode }}" data-toggle="modal" class="btn btn-default btn-xs" onClick="$('.modal').modal('hide')">
                                    Edit Foto
                                  </a>
                                  @endif
                                @else
                                  Tidak Ada Foto
                                  <br>
                                  <a href="#modalEditFoto{{ $d->kode }}" data-toggle="modal" class="btn btn-default btn-xs" onClick="$('.modal').modal('hide')">
                                    Tambah Foto
                                  </a>
                                @endif
                              </div>
                              <br><hr>
                              <table class="table">
                                <tr>
                                  <th>Kode</th>
                                  <th>=</th>
                                  <td>{{ $d->kode }}</td>
                                </tr>
                                <tr>
                                  <th>Nama</th>
                                  <th>=</th>
                                  <td>{{ $d->nama }}</td>
                                </tr>
                                <tr>
                                  <th>Tanggal Pembelian</th>
                                  <th>=</th>
                                  <td>{{ $d->tanggalPembelian }}</td>
                                </tr>
                                <tr>
                                  <th>Tahun Pembuatan</th>
                                  <th>=</th>
                                  <td>
                                    @if( !empty($d->tahunPembuatan))
                                      {{$d-> tahunPembuatan}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                </tr>
                                @if( !empty($d->platNomor))
                                <tr>
                                  <th>Plat Nomor</th>
                                  <th>=</th>
                                  <td>{{$d->platNomor}}</td>
                                </tr>
                                @endif   
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
                <td id='td_tanggalPembelian_{{$d->kode}}'>{{ $d->tanggalPembelian }}</td>
                <td id='td_tahunPembuatan_{{$d->kode}}'>
                    @if( !empty($d->tahunPembuatan))
                      {{$d-> tahunPembuatan}}
                    @else
                      -
                    @endif
                </td>
                <td>{{$d-> status}}</td>
                @if(Auth::user()->role == "manajer")
                  <!-- <td>
                    <div class="col text-center">
                      <a class="btn btn-lg btn-link" href="#modalEdit2{{$d->kode}}" data-toggle="modal">
                        Edit
                        <i class="fa fa-edit"></i>
                      </a>
                    </div>
                  </td> -->
                  <td>
                    <div class="col text-center">
                      <a href="#modalEdit" data-toggle="modal" class="btn btn-lg btn-link btn-xs" onclick="getEditForm('{{$d->kode}}')">
                        <i class="fa fa-edit"></i>
                        Edit
                      </a>
                      <!-- <a href="#modalEdit" data-toggle="modal" class="btn btn-lg btn-link" onclick="getEditForm2('{{$d->kode}}')">
                        Edit
                        <i class="fa fa-edit"></i>
                      </a> -->
                      @if($d->status == 'Aktif')
                        <a class="btn btn-danger btn-xs" onclick="if(confirm('Apakah anda yakin?')) deleteDataRemoveTR('{{$d->kode}}')">
                          <i class="fa fa-trash-o "></i>
                            Hapus
                        </a>
                      @else
                        <a class="btn btn-danger btn-xs" onclick="if(confirm('Apakah anda yakin?')) deleteDataRemoveTR('{{$d->kode}}')" disabled>
                          <i class="fa fa-trash-o "></i>
                            Hapus
                        </a>
                      @endif
                    </div>
                  </td>
                @endif
                
                <!-- START EDIT FOTO WITH MODALS-->
                  <div class="modal fade" id="modalEditFoto{{ $d->kode }}" tabindex="-1" role="basic" aria-hidden="true"> 
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                          <h4 class="modal-title">
                            Edit Foto
                          </h4>
                        </div>
                        <form enctype="multipart/form-data" method="POST" action="{{ route('inventaris.editFoto') }}">
                        @csrf
                          <div class="modal-body">
                              <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                  <input type="file" value="" name="foto" class="form-control" id="foto" placeholder="Foto" required>
                                </div>
                                <input type="hidden" name="kode" value="{{ $d->kode}}">
                              </div> 
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >
                              Simpan
                            </button>
                            <button type="button" class="btn btn-primary" onClick="$('.modal').modal('hide');" >
                              Batal
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <!-- END EDIT FOTO WITH MODALS-->
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  <!-- END DAFTAR INVENTARIS -->

  <!-- START RIWAYAT PERAWATAN -->
    <div class="portlet">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Riwayat Perawatan
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
        @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif
        @if(Auth::user()->role == "manajer")
          <a type="button" class="btn btn-info" data-toggle="modal" href="#buatPerawatan">
            <i class="fa fa-plus"></i>   
            Tambah Perawatan
          </a>
          <hr>
        @endif
        <table class="table table-striped table-bordered table-advance table-hover datatable-np" id="table_riwayatPerawatan">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama</th>
              <th>Kendala</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Selesai</th> 
            </tr>
          </thead>
          <tbody>
            @foreach($qrRiwayat as $d)
            <tr>
              <td>{{ $d->kode }}</td>
              <td>
                <a data-toggle="modal" href="#detailPerawatan_{{$d->idRiwayat}}">{{ $d->nama }}</a>
                <!-- START DETAIL PERAWATAN INVENTARIS WITH MODALS-->
                  <div class="modal fade" id="detailPerawatan_{{$d->idRiwayat}}" tabindex="-1" role="basic" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">{{$d->nama}}</h4>
                          </div>
                          <div class="modal-body">
                            <h4><b>Foto :</b></h4> <br><br>
                            <div class="col text-center">
                              @if( !empty($d->foto))
                                <a href="{{ asset('images/'. $d->foto) }}" target="_blank">
                                  <img style="max-height: 200px;" src="{{ asset('images/'. $d->foto) }}">
                                </a>
                              @else
                                Tidak Ada Foto
                              @endif
                            </div>
                            <br><hr>
                            <table class="table">
                              <tr>
                                <th>Bertanggung Jawab</th>
                                <th>=</th>
                                <td>{{ $d->namaDepan }} {{ $d->namaBelakang }}</td>
                              </tr>
                              <tr>
                              <tr>
                                <th>ID Perawatan</th>
                                <th>=</th>
                                <td>{{ $d->idRiwayat }}</td>
                              </tr>
                                <th>Kode</th>
                                <th>=</th>
                                <td>{{ $d->kode }}</td>
                              </tr>
                              <tr>
                                <th>Nama</th>
                                <th>=</th>
                                <td>{{ $d->nama }}</td>
                              </tr>
                              @if( !empty($d->platNomor))
                              <tr>
                                <th>Plat Nomor</th>
                                <th>=</th>
                                <td>{{$d->platNomor}}</td>
                              </tr>
                              @endif 
                              <tr>
                                <th>Kendala</th>
                                <th>=</th>
                                <td>
                                  @if( !empty($d->kendala))
                                    {{$d-> kendala}}
                                  @else
                                    -
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th>Catatan</th>
                                <th>=</th>
                                <td>
                                  @if( !empty($d->tanggalSelesai))
                                    @if( !empty($d->catatan))
                                      {!! nl2br($d-> catatan) !!}
                                    @else
                                      -
                                    @endif
                                  @else
                                  <b>Sedang Dalam Proses Perawatan</b>
                                  @endif
                                </td>
                              </tr> 
                              <tr>
                                <th>Tanggal Mulai</th>
                                <th>=</th>
                                <td>
                                  @if( !empty($d->tanggalMulai))
                                    {{$d-> tanggalMulai}}
                                  @else
                                    -
                                  @endif
                                </td>
                              </tr> 
                              <tr>
                                <th>Tanggal Selesai</th>
                                <th>=</th>
                                <td>
                                  @if( !empty($d->tanggalSelesai))
                                    {{$d-> tanggalSelesai}}
                                  @else
                                    @if(Auth::user()->role == "manajer")
                                    <a href="#modalEdit" data-toggle="modal" class="btn btn-danger btn-xs" onclick="getEditPerawatan('{{$d->idRiwayat}}')" data-dismiss="modal">
                                      <i class="fa fa-edit"></i>
                                      Berakhir
                                    </a>
                                    @else
                                      Sedang Dalam Proses Perawatan
                                    @endif
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
                <!-- END DETAIL PERAWATAN WITH MODALS-->
              </td>
              <td>
                @if( !empty($d->kendala))
                  {{ $d->kendala }}
                @else
                  Sedang Dalam Proses Perawatan
                @endif
              </td>
              <td align=center>{{ $d->tanggalMulai }}</td>
              <td align=center>
                @if( !empty($d->tanggalSelesai))
                  {{ $d->tanggalSelesai }}
                @else
                  <div class="col text-center">
                    @if(Auth::user()->role == "manajer")
                      <a href="#modalEdit" data-toggle="modal" class="btn btn-danger btn-block btn-xs" onclick="getEditPerawatan('{{$d->idRiwayat}}')">
                          Berakhir
                          <i class="fa fa-edit"></i>
                      </a>
                    @else
                      Sedang Dalam Proses Perawatan
                    @endif
                  </div>
                  <!-- <div class="col text-center">
                    <form method="POST" action="{{ route('riwayatPerawatan.update', $d->id) }}">
                      @method("PUT")
                      @csrf
                        <button  class="btn btn-danger btn-xs" type = "submit">
                          Berakhir<i class="fa fa-edit"></i>
                        </button>
                    </form>
                  </div> -->
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>  
  <!-- END RIWAYAT PERAWATAN -->  
</div> 
<!-- MODEL -->
@endsection

@section('tempat_script')
<script>
  function getEditForm(kode)
  {
    $.ajax({
      type:'POST',
      url: '{{route("inventaris.getEditForm")}}',
      data: {'_token':'<?php echo csrf_token() ?>',
              'kode':kode
            },
      success: function(data){
        $('#modalContent').html(data.msg);
      }
    });
  }

  // function getEditForm2(kode)
  // {
  //   $.ajax({
  //     type:'POST',
  //     url: '{{route("inventaris.getEditForm2")}}',
  //     data: {'_token':'<?php echo csrf_token() ?>',
  //             'kode':kode
  //           },
  //     success: function(data){
  //       $('#modalContent').html(data.msg);
  //     }
  //   });
  // }

  // function saveDataUpdateTD(kode)
  // {
  //   var eNama=$('#eNama').val();
  //   var eTahunPembuatan=$('#eTahunPembuatan').val();
  //   var ePlatNomor=$('#ePlatNomor').val();
  //   var eFoto=$('#eFoto').val();

  //   $.ajax({
  //     type:'POST',
  //     url: '{{route("inventaris.saveData")}}',
  //     data: {'_token':'<?php echo csrf_token() ?>',
  //             'kode':kode,
  //             'nama':eNama,
  //             'tahunPembuatan':eTahunPembuatan,
  //             'platNomor':ePlatNomor,
  //             'foto':eFoto,
  //           },
  //     success: function(data){
  //       if(data.status == 'ok')
  //       {
  //         alert(data.msg);
  //         $('#td_nama_'+kode).html(eNama);
  //         $('#td_tahunPembuatan_'+kode).html(eNama);
  //       } 
  //       else{
  //         alert(data.msg);
  //       }
  //     }
  //   });
  // }

  function deleteDataRemoveTR(kode)
  {
    $.ajax({
      type:'POST',
      url: '{{route("inventaris.deleteData")}}',
      data: {'_token':'<?php echo csrf_token() ?>',
              'kode':kode
            },
      success: function(data){
        if(data.status == 'ok')
        {
          alert(data.msg);
          $('#tr_'+kode).remove();
          $('#add_'+kode).remove();
        } 
        else{
          alert(data.msg);
        }
      }
    });
  }

  function getEditPerawatan(id)
  {
    $.ajax({
      type:'POST',
      url: '{{route("riwayatPerawatan.getEditPerawatan")}}',
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
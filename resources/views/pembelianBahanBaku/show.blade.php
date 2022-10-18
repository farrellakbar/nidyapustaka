@extends('layout.conquer')
<!-- @section('a')
{{$namaSup->id}}
@endsection -->
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
                <label for="nama" class="col-sm-2 col-form-label">Nama<span style="color:red">
									* </span>
                </label>
                <div class="col-sm-10">
                  <input type="text" value="" name="nama" class="form-control" id="nama" placeholder="Nama" required>
                </div>
            </div> 
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Supplier</label>
                <div class="col-sm-10">
                  <input type="text" value="{{$namaSup->nama}}" name="namaSupplier" class="form-control" id="namaSupplier"  readonly>
                  <input type="hidden" value="{{$namaSup->id}}" name="id_supplier" class="form-control" id="id_supplier"  readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori<span style="color:red">
									* </span>
                </label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_kategori" required>
                    <option value="">
                      Pilih Kategori
                    </option>
                    @foreach($dataKategori as $i)
                      <option value='{{$i->id}}' id='add_{{$i->id}}'>
                        {{$i->nama}}
                      </option>
                    @endforeach
                    </select> 
                </div>
            </div>  
            <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Harga<span style="color:red">
									* </span>
                </label>     
                <div class="col-md-1">
                  <h4>Rp.</h4>
                </div>
                <div class="col-md-6"> 
                  <input type="number" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="" name="harga" class="form-control" placeholder="Harga" step="1000" required>
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
      <a href="/pembelianBahanBaku">Bahan Baku</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="/pembelianBahanBaku">Pembelian</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="">{{$namaSup->nama}}</a>
    </li>
  </ul>
</div>

<div class="dropdown dp">
  <button type="button" class="btn btn-warning btn-sm btnDp" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          Keranjang
          <span class="badge badge-pill badge-danger">
            {{ count((array) session('keranjang')) }}
          </span>
  </button>
  <div class="dropdown-menu dp-menu">
          <div class="row total-header-sectionDp">
            <?php
             $total = 0;
             $sup = "";            
            ?>
            @foreach((array) session('keranjang') as $id => $details)
                <?php $total += $details['harga'] * $details['jumlahSediaan'];
                $sup = $details['supplier'];
                ?>
            @endforeach
            <div class="col-lg-6 col-sm-6 col-6">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                <span class="badge badge-pill badge-danger">
                  {{ count((array) session('keranjang')) }}
                </span>
                <br>
                <h4><b>{{ $sup }}</b></h4>
            </div>
            <div class="col-lg-6 col-sm-6 col-6 total-sectionDp text-right">
                <p> <b>Total: </b> <span class="text-info">Rp. {{ $total }}</span></p>
            </div>
          </div>
          <div class="row cart-detailDp">
              <div class="col-lg-5 col-sm-5 col-5">
                <b>Bahan Baku</b>
              </div>
              <div class="col-lg-3 col-sm-3 col-3">
                  <span class="text-info"><b>Harga</b></span> 
              </div>
              <div class="col-lg-4 col-sm-4 col-4">
                  <span class="count"><b>Jumlah </b></span>
              </div>
          </div>

          @if(session('keranjang'))
              @foreach(session('keranjang') as $id => $details)
                  <div class="row cart-detailDp">
                      <div class="col-lg-5 col-sm-5 col-5">
                        <p>{{ $details['nama'] }}</p>
                      </div>
                      <div class="col-lg-3 col-sm-3 col-3">
                          <span class="text-info">Rp. {{ number_format($details['harga']) }}</span> 
                      </div>
                      <div class="col-lg-4 col-sm-4 col-4" id="updateBahanBaku">
                        <input type="hidden" value="{{ $id }}" name="idBahanBaku2" class="form-control" id="idBahanBaku2" placeholder="idBahanBaku2">
                        <input type="number" value="{{ $details['jumlahSediaan'] }}" name="jumlahBahanBaku" class="form-control" id="jumlahBahanBaku" placeholder="Jumlah" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
                        <span class="count"> {{ $details['satuan'] }}</span>
                      </div>
                  </div>
              @endforeach
          @endif
          @if(Auth::user()->role == "manajer")
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center checkoutDp">
                    <a href="{{ url('keranjang') }}" class="btn btn-primary btn-block">View all</a>
                </div>
            </div>
          @endif
  </div>
</div>

<div class="content">
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN INLINE NOTIFICATIONS PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Bahan Baku {{$namaSup->nama}} 
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="javascript:;" class="reload"></a>
							</div>
              @if(Auth::user()->role == "manajer")
                <div class="actions">
                  <a type="button" href="#buatSediaan"  data-toggle="modal" class="btn btn-info btn-sm">
                    <i class="fa fa-plus"></i> 
                    Tambah Bahan Baku
                  </a>
                </div>
              @endif
						</div>
						<div class="portlet-body">
              @if(session('success'))
                <div class="alert alert-success">
                  <strong>Sukses! </strong>
                  {{ session('success') }}
                </div>
              @endif
							<div class="row margin-bottom-40">
								<!-- Pricing -->
              @foreach($data as $index => $d)
								<div class="col-md-3">
									<div class="pricing hover-effect">
										<div class="pricing-head">
											<h3>
                        {{ $d->sed }} 
                        <span>
                          {{ $d->kat }}
                        </span>
											</h3>
                      <h4>
                        <i>Rp.</i>
                        {{ number_format($d->harga,0) }}
                        <span>
                        Per {{$d->satuan}} </span>
											</h4>
										</div>
                    @if(Auth::user()->role == "manajer")
                      <div class="pricing-footer"> 
                        <br>
                        <a href="{{url('tambahKeranjang/'.$d->idSupplier.'/'.$d->id)}}" class="btn btn-success">
                          Tambah
                          <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                      </div>
                    @endif
									</div>
                </div>
              @endforeach
								<!--//End Pricing -->
							</div>
						</div>
					</div>
					<!-- END INLINE NOTIFICATIONS PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
</div>
@endsection

@section('tempat_script')
  <script>
    $(document).ready(function () {
        function update()
        {
          var eIdBahanBaku=$('#idBahanBaku2').val();
          var eJumlah=$('#jumlahBahanBaku').val();

          $.ajax({
            type:'POST',
            url: '{{route("pembelianBahanBaku.keranjangBahanBaku")}}',
            data: {'_token':'<?php echo csrf_token() ?>',
                    'idBahanBaku':eIdBahanBaku,
                    'jumlahBahanBaku':eJumlah,
                  },
            success: function(data){
              if(data.status == 'ok')
              {
                $('#updateBahanBaku').empty();
                $("#updateBahanBaku").html(data);
              }
            }
          });
        }

      $("#jumlahBahanBaku").change(function(){  
        update();
		  }); 
    });
  </script>
@endsection
@extends('layout.conquer')
@section('content')
    <!-- START TAMBAH KONSUMEN WITH MODALS & AJAX-->
        <div class="modal fade" id="buatKonsumen" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">
                    Tambah Konsumen
                </h4>
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ route('konsumen.store') }}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Pemesan<span style="color:red">
                           * </span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" value="" name="namaPemesan" class="form-control" id="namaPemesan" placeholder="Nama Pemesan" required>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Alamat Pemesan<span style="color:red">
                           * </span>
                        </label>
                        <div class="col-sm-8">
                        <input type="text" value="" name="alamatPemesan" class="form-control" id="alamatPemesan" placeholder="Alamat Pemesan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Toko
                        </label>
                        <div class="col-sm-8">
                        <input type="text" value="" name="namaToko" class="form-control" id="namaToko" placeholder="Nama Toko">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Alamat Toko
                        </label>
                        <div class="col-sm-8">
                        <input type="text" value="" name="alamatToko" class="form-control" id="alamatToko" placeholder="Alamat Toko">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nomor Telepon<span style="color:red">
                           * </span>
                        </label>
                        <div class="col-sm-8">
                        <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  maxlength="14" name="nomorTelepon" class="form-control" id="nomorTelepon" placeholder="No Telepon" required>
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
    <!-- END TAMBAH KONSUMEN WITH MODALS & AJAX-->

	<!-- BEGIN PAGE HEADER-->
        <h2 class="page-title">
            Keranjang <small>Penjualan Buku</small>
        </h2>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/">Beranda</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="/buku">Produksi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="/buku">Buku</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Penjualan</a> 
                </li>
            </ul>
        </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <?php
        $cart = session()->get('KeranjangPenjualan');
    ?>
 
    <div class="content"> 
        <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
            <i class="fa fa-reorder"></i>Penjualan Buku
            </div>
            <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="javascript:;" class="reload"></a>
            </div>
        </div>
        <div class="portlet-body form">
            <form method="POST" action="{{ route('penjualanBuku.submitcheckout') }}">
                <?php 
                    $total = 0;
                    $no = 1;
                ?>
                @if(session('KeranjangPenjualan'))
                <div class="modal-body">
                    @csrf
                    @foreach(session()->get('KeranjangPenjualan') as $id => $details)
                    <?php $total += $details['jumlahPenjualan'] ?>
                        <div class="form-group row"> 
                            <label for="kode_inventaris" class="col-sm-4 col-form-label"><strong>ITEM #{{ $no++ }}</strong></label>
                        </div>  
                        <div class="form-group row"> 
                            <label for="kode_inventaris" class="col-sm-4 col-form-label">Nama Buku</label>
                            <div class="col-sm-4">
                                <input type="text" value="{{ $details['nama'] }}" name="nama" class="form-control" id="nama" readonly>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="kendala" class="col-sm-4 col-form-label">Jumlah Produksi</label>
                            <div class="col-md-4"> 
                            <input type="text" value="{{ $details['jumlahPenjualan'] }}" name="jumlah" class="form-control" id="jumlah" readonly>
                            </div>
                            <div class="col-md-2">
                            <input type="text" value="Buku" name="satuan" class="form-control" placeholder="Satuan" readonly>   
                            </div>
                        </div> 
                       
                    @endforeach
                    <div class="form-group row"> 
                        <label for="kode_inventaris" class="col-sm-4 col-form-label">Total Buku</label>
                        <div class="col-md-4"> 
                            <input type="text" value="{{ number_format($total)}}" name="total" class="form-control" id="total" readonly>
                        </div>
                        <div class="col-md-2">
                            <input type="text" value="Buku" name="satuan" class="form-control" placeholder="Satuan" readonly>   
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="waktuPengerjaan" class="col-sm-4 col-form-label">
                            Konsumen
                            <span style="color:red;">
                                * 
                            </span>
                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="id_konsumen" required>
                            <option value=''>Pilih Konsumen</option>
                            @foreach($data3 as $i)
                                <option value='{{$i->id}}' id='add_{{$i->id}}'>
                                @if(!empty($i->namaToko))
                                    {{$i->namaPemesan}} - {{$i->namaToko}}
                                @else
                                    {{$i->namaPemesan}}
                                @endif
                                </option>
                            @endforeach
                            </select> 
                        </div>
                        <div class="col-sm-4">
                            <a type="button" href="#buatKonsumen" data-toggle="modal" class="btn btn-link">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </a>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="kode_Kendaraan" class="col-sm-4 col-form-label">Kode Kendaraan</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="kode_Kendaraan">
                            <option value=''>Pilih Kendaraan</option>
                            @foreach($data as $i)
                                <option value='{{$i->kode}}' id='add_{{$i->kode}}'>
                                {{$i->nama}}
                                </option>
                            @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_Kendaraan" class="col-sm-4 col-form-label">Nama Pengirim</label>
                        <div class="col-md-4">
                            <select class="form-control" name="id_pengirim1">
                            <option value=''>Pilih Pengirim 1</option>
                            @foreach($data2 as $i)
                                <option value='{{$i->id}}' id='add_{{$i->id}}'>
                                    {{$i->namaDepan}}
                                </option>
                            @endforeach
                            </select> 
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="id_pengirim2">
                            <option value=''>Pilih Pengirim 2</option>
                            @foreach($data2 as $i)
                                <option value='{{$i->id}}' id='add_{{$i->id}}'>
                                    {{$i->namaDepan}}
                                </option>
                            @endforeach
                            </select> 
                        </div>
                    </div>  -->
                </div> 
                @endif
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Checkout Penjualan</button>
                    <a href ="{{ URL::previous() }}" type="button" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
@endsection

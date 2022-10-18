@extends('layout.conquer')
@section('content')
  <h2 class="page-title hidden-print">
    <div>Nota <small>Pembelian Bahan Baku</small>
  </h2>
  <div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <i class="fa fa-home"></i>
        <a href="/">Beranda</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="/riwayatPembelian">Transaksi</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="/riwayatPembelian">Pembelian</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="">Nota</a>
      </li>
    </ul>
  </div>
  <div class="invoice">
		<div class="row invoice-logo">
			<div class="col-xs-4 invoice-logo-space"><br>
				<img src="{{ asset('assets/img/logoNp.png')}}" alt=""/>
			</div>
      <div class="col-xs-4">
      </div> 
      <div class="col-xs-4">
        @foreach($datas as $a )
          @if ($loop->first)
          <p>
            <h3>
              <b>
                #{{$a->idNota}} / {{$a->tanggalPembelian}}
              </b>
            </h3>
            <span class="muted">
              Bukti Pembelian Bahan Baku
            </span>
          </p>
          @endif
        @endforeach
			</div>
		</div>
		<hr/>
    <div class="row">
	  	<div class="col-xs-4">
	  		<h4><b>Supplier :</b></h4>
        @foreach($datas as $a )
          @if ($loop->first)
          <ul class="list-unstyled">
            <li>
              {{$a->namaSupplier}}
            </li>
            <li>
              {{$a->alamatSupplier}}, {{$a->kota}}
            </li>
            <li> 
              @if(!empty($a->noTelepon))
                {{$a->noTelepon}} 
              @else
                -
              @endif
            </li>
          </ul>
          @endif
        @endforeach
	  	</div>
	  	<div class="col-xs-4">
	  	</div>
	  	<div class="col-xs-4">
        <h4><b>Karyawan :</b></h4>
        @foreach($datas as $a )
          @if ($loop->first)
          <ul class="list-unstyled">
            <li>
              {{$a->namaDepan}} {{$a->namaBelakang}}
            </li>
          </ul>
          @endif
        @endforeach
	  	</div>
	  </div>
		<div class="row">
			<div class="col-xs-12">
        <table id="cart" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width:5%" class="text-center"> No.</th>
                    <th style="width:10%"> Kategori</th>
                    <th style="width:35%"> Nama Bahan Baku</th>
                    <th style="width:15%">Jumlah Pembelian</th>
                    <th style="width:15%">Harga</th>
                    <th style="width:20%" class="text-center">Sub Total</th>
                </tr>
            </thead>
            <tbody> 
            @foreach($datas as $index => $d )
                  <tr>
                      <td data-th="Price" class="text-center">{{ $index +1 }}</td> 
                      <td data-th="Price">{{$d->namaKategori}}</td>
                      <td data-th="Price">{{$d->namaSediaan}}</td>
                      <td data-th="Quantity">{{$d->jumlahPembelian}}</td>
                      <td data-th="Price">Rp.{{$d->harga}}</td>
                      <td data-th="Subtotal" class="text-center">Rp. {{$d->subTotal}}</td>
                      </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
			</div>
		</div>
    <div class="row">
			<div class="col-xs-4">
				<div class="well">
					<address>
            <strong>PENERBIT<br> NIDYA PUSTAKA</strong><br/>
            Tambak Sari, Surabaya<br/>
            Jawa Timur, Indonesia. 60135<br/>
            <abbr title="Phone">P: </abbr> (031) 000-0000 
          </address>
          <address>
            <strong>Email</strong><br/>
            <a href="mailto:nidyapustaka@gmail.com">nidyapustaka@gmail.com</a>
					</address>
				</div>
			</div>

      
			<div class="col-xs-8 invoice-block">
				<ul class="list-unstyled amounts">
					<li>
            @foreach($datas as $a )
              @if ($loop->first)
                <h4><strong>Grand Total:</strong> Rp. {{$a->totalHarga}}</h4>
              @endif
            @endforeach
					</li>
				</ul>
				<br/>
        <a class="btn btn-lg btn-success hidden-print" href="/riwayatPembelian">Kembali</a>
				<a class="btn btn-lg btn-info hidden-print" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
			</div>
		</div>
	</div> 
@endsection

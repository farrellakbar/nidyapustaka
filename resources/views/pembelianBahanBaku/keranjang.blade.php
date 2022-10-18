@extends('layout.conquer')
@section('content')
	<!-- BEGIN PAGE HEADER-->
        <h2 class="page-title">
            Keranjang <small>pembelian</small>
        </h2>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/">Beranda</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Keranjang</a>
                </li>
            </ul>
        </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <?php
        $cart = session()->get('keranjang');
    ?>
    <div class="invoice">
		<div class="row invoice-logo">
			<div class="col-xs-6 invoice-logo-space">
				<img src="assets/img/logoNP.png" alt=""/>
			</div>
		</div>
		<hr/>
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

                    <?php 
                        $total = 0;
                        $no = 1;
                    ?>
                    
                    @if(session('keranjang'))
                        @foreach(session()->get('keranjang') as $id => $details)
                            <?php $total += $details['harga'] * $details['jumlahSediaan'] ?>
                            <tr>
                                <td data-th="Price" class="text-center">{{ $no++ }}</td> 
                                <td data-th="Price">{{ $details['kategori'] }}</td>
                                <td data-th="Price">{{ $details['nama'] }}</td>
                                <td data-th="Quantity">{{ $details['jumlahSediaan'] }}</td>
                                <td data-th="Price">Rp. {{ $details['harga'] }}</td>
                                <td data-th="Subtotal" class="text-center">Rp. {{ $details['harga'] * $details['jumlahSediaan'] }}</td>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                    <tfoot>
                        <tr class="visible-xs">
                            <td class="text-center"><strong>Total {{ $total }}</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> 
                                    Kembali
                                </a>
                            </td>
                            <td class="hidden-xs"></td>
                            <td class="hidden-xs"></td>
                            <td class="hidden-xs"></td>
                            <td>
                                <a href="{{ route('pembelianBahanBaku.submitcheckout') }}" class="btn btn-success"> Checkout Pembelian 
                                    <i class="fa fa-check"></i> 
                                </a>
                            </td>
                            <td class="hidden-xs text-center"><strong>Total Rp. {{ $total }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
			</div>
		</div>
	</div>
    <!-- END PAGE CONTENT-->
@endsection

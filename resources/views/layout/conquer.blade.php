<!DOCTYPE html>
<?php
	use App\Http\Controllers\ProduksiController;
	use App\Http\Controllers\SediaanBahanBakuController;

?>
<!-- 
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Sistem Informasi Nidya Pustaka</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('assets/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>

<link href="{{ asset('assets/plugins/jcrop/css/jquery.Jcrop.min.css')}}" rel="stylesheet"/>


<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{ asset('assets/css/print.css" rel="stylesheet')}}" type="text/css" media="print"/>
<link href="{{ asset('assets/css/style-conquer.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/themes/blue.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ asset('assets/css/pages/invoice.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/pages/login.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('assets/css/pages/about-us.css')}}" rel="stylesheet" type="text/css"/>


<link rel="stylesheet" type="text/css" href="{{ asset('css/keranjang.css') }}">

<link href="{{ asset('assets/css/pages/pricing-tables.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('assets/css/pages/portfolio.css')}}" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="{{ asset('favicon.ico')}}"/>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-sidebar-closed">
	<!-- BEGIN HEADER -->
	<div class="header navbar  navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="header-inner">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="/">
					<img src="{{ asset('assets/img/logo.png')}}" alt="logo" class= img-responsive style="max-width: 80%;"/> 
				</a>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<img src="{{ asset('assets/img/menu-toggler.png')}}" alt=""/>
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<ul class="nav navbar-nav pull-right">
			@if(Auth::user())
				<!-- BEGIN NOTIFICATION DROPDOWN -->
					<li class="dropdown" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> 
						<i class="icon-bell"></i>
						<span class="badge badge-danger">
							{{ProduksiController::getDataJumlahNotifikasiHabis()}} 
						</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>
								@if(ProduksiController::getDataJumlahNotifikasiHabis() == 0)
									Tidak ada notifikasi	
								@else
									Terdapat {{ProduksiController::getDataJumlahNotifikasiHabis()}} notifikasi
								@endif
								</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;">
									@foreach(SediaanBahanBakuController::getDataSediaan() as $d)
										<li>
											<a href="#">
											<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bell"></i>
											</span>
												{{$d->nama}} habis!
											</a>
										</li>
									@endforeach
									@foreach(SediaanBahanBakuController::getDataSediaanHampirHabis() as $d)
										<li>
											<a href="#">
											<span class="label label-sm label-icon label-warning">
											<i class="fa fa-bullhorn"></i>
											</span>
												{{$d->nama}} hampir habis!
											</a>
										</li>
									@endforeach
									@foreach(ProduksiController::getDataJumlahBuku() as $d)
										<li>
											<a href="#">
											<span class="label label-sm label-icon label-danger">
											<i class="fa fa-book"></i>
											</span>
												Buku {{$d->nama}} habis!
											</a>
										</li>
									@endforeach
									@foreach(ProduksiController::getDataJumlahBukuHampirHabis() as $d)
										<li>
											<a href="#">
											<span class="label label-sm label-icon label-warning">
											<i class="fa fa-bullhorn"></i>
											</span>
												Buku {{$d->nama}} hampir habis!
											</a>
										</li>
									@endforeach
								</ul>
							</li>
							<li class="external">
								<a href="#">Lihat semua notifikasi <i class="fa fa-angle-right"></i></a>
							</li>
						</ul>
					</li>
				<!-- END NOTIFICATION DROPDOWN -->
				<!-- BEGIN TODO DROPDOWN -->
					<li class="dropdown" id="header_task_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-calendar"></i>
						<span class="badge badge-success">
							@foreach(ProduksiController::getDataJumlahNotifikasiProduksi() as $d)
								{{$d->jumlahProduksi}}
							@endforeach 
						</span>
						</a>
						<ul class="dropdown-menu extended tasks">
							<li>
								<p>
									@foreach(ProduksiController::getDataJumlahNotifikasiProduksi() as $d)
										@if($d->jumlahProduksi == 0)
											Tidak ada notifikasi
										@else
											Terdapat {{$d->jumlahProduksi}} proses produksi
										@endif
									@endforeach
								</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;">
									@foreach(ProduksiController::getDataProduksi() as $d)
										<li>
											<?php
												if($d->tahap == null)
												{
													$persen = 0;
												}
												else if($d->tahap == 1)
												{
													$persen = 10;
												}
												else if($d->tahap == 2)
												{
													$persen = 20;
												}
												else if($d->tahap == 3)
												{
													$persen = 35;
												}
												else if($d->tahap == 4)
												{
													$persen = 50;
												}
												else if($d->tahap == 5)
												{
													$persen = 75;
												}
												else if($d->tahap == 6)
												{
													$persen = 90;
												}
											?>
											@if($d->tahap == null)
												<a href="/produksi">
											@else
												<a href="{{ route('produksi.linimasa', $d->idProduksi)}}">
											@endif
												<span class="task">
													<span class="desc">
														{{$d->nama}} ({{$d->idProduksi}})
													</span>
													<span class="percent">
														{{$persen}} %
													</span>
												</span>
												<span class="progress progress-striped">
													<span style="width: {{$persen}}%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">				
													</span>
												</span>
											</a>
										</li>
									@endforeach
								</ul>
							</li>
							<li class="external">
								<a href="/produksi">Lihat Semua <i class="fa fa-angle-right"></i></a>
							</li>
						</ul>
					</li>
				<!-- END TODO DROPDOWN -->
			@endif 

				<li class="devider">
					&nbsp;
				</li>
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					@if(Auth::user())
					<?php
						$idKaryawan = Auth::user()->id;
						$data  = DB::select("select foto from karyawans where id = ?",[$idKaryawan]);
					?>
					@endif 
					@if(Auth::user())
						@foreach($data as $i)
							@if(!isset($i->foto))
								<img alt="" src="{{ asset('images/karyawan/guess.jpg')}}" class="img-responsive" width="20" height="20"/>
							@else
								<img alt="" src="{{ asset('images/karyawan')}}/{{$i->foto}}" class="img-responsive" width="20" height="20"/>
							@endif
                        @endforeach
					@endif 
						<span class="username">
							@if(Auth::user())
								{{Auth::user()->username}}
							@else
								{{'Tamu'}}
							@endif 
						</span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
					@if(Auth::user())
						@if(Auth::user()->role == "root")
						<li>
							<a href="/karyawan/daftar"><i class="fa fa-user"></i> Akun Karyawan</a>
						</li>
						@elseif(Auth::user()->role == "manajer")
						<li>
							<a href="/karyawan"><i class="fa fa-user"></i> Profilku</a>
						</li>
						<li>
							<a href="/karyawan/daftar"><i class="fa fa-user"></i> Akun Karyawan</a>
						</li>
						@else
						<li>
							<a href="/karyawan"><i class="fa fa-user"></i> Profilku</a>
						</li>	
						@endif
						<li class="divider">
						</li>
					@endif
						<li>
							@if(Auth::user())
								<form action="{{ route('logout') }}" method="POST">
								@csrf
									<button type="submit" class="btn btn-block btn-danger btn-xs">
										<i class="fa fa-key"></i>Log Out
									</button>
								</form>
							@else
								<form action="login">
									@csrf
									<button type="submit" class="btn btn-block btn-primary btn-xs">
										<i class="fa fa-key"></i>Log In
									</button>
								</form>
							@endif 
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<div class="clearfix">
	</div>
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<ul class="page-sidebar-menu">
					<li class="sidebar-toggler-wrapper">
						<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
						<div class="sidebar-toggler">
						</div>
						<div class="clearfix">
						</div>
						<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					</li>
					<li class="start {{ Request::is('/') ? 'active' : '' }} ">
						<a href="/">
						<i class="icon-home"></i>
						<span class="title"><b>Beranda</b></span>
						<span class="selected"></span>
						</a>
					</li>
					<li class="start {{ Request::is('inventaris') ? 'active' : '' }} " >
						<a href="/inventaris" >
						<i class="fa fa-cubes"></i>
						<span class="title"><b>Inventaris</b></span>
						</a>
					</li>
					<li class="start {{ Request::is('sediaanBahanBaku') ? 'active' : '' }} 
									{{ Request::is('supplier') ? 'active' : '' }} 
									{{ Request::is('pembelianBahanBaku') ? 'active' : '' }}
									{{ Request::is('pb.id') ? 'active' : '' }}
									{{ Request::is('keranjang') ? 'active' : '' }}
									">
						<a href="javascript:;">
							<i class="fa fa-tasks"></i>
							<span class="title"><b>Bahan Baku</b></span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li class="start {{ Request::is('sediaanBahanBaku') ? 'active' : '' }} ">
								<a href="/sediaanBahanBaku">
								Sediaan</a>
							</li>
							<li class="start {{ Request::is('supplier') ? 'active' : '' }} ">
								<a href="/supplier">
								Supplier</a>
							</li>
							<li class="start {{ Request::is('pembelianBahanBaku') ? 'active' : '' }} ">
								<a href="/pembelianBahanBaku">
								Pembelian</a>
							</li>
						</ul>
					</li>
					<li class="start {{ Request::is('produksi') ? 'active' : '' }} 
									{{ Request::is('buku') ? 'active' : '' }} 
									{{ Request::is('buku/keranjangPenjualan') ? 'active' : '' }}
									{{ Request::is('keteranganTahapan') ? 'active' : '' }}
									">					
						<a href="javascript:;">
							<i class="fa fa-gear"></i>
							<span class="title"><b>Produksi</b></span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li class="start {{ Request::is('produksi') ? 'active' : '' }} ">
								<a href="/produksi">
								Proses</a>
							</li>
							<li class="start {{ Request::is('buku') ? 'active' : '' }} ">
								<a href="/buku">
								Buku</a>
							</li>
						</ul>
					</li>
					<li class="start {{ Request::is('lokasiPenyimpanan') ? 'active' : '' }} ">
						<a href="/lokasiPenyimpanan">
						<i class="fa fa-building"></i>
						<span class="title"><b>Gudang Penyimpanan</b></span>
						</a>
					</li>
					<li class="start {{ Request::is('pengiriman') ? 'active' : '' }} ">
						<a href="/pengiriman">
						<i class="fa fa-truck"></i>
						<span class="title"><b>Pengiriman</b></span>
						</a>
					</li>
					<li class="start {{ Request::is('riwayatPembelian') ? 'active' : '' }} 
									{{ Request::is('riwayatPenjualan') ? 'active' : '' }} 
									">					
						<a href="javascript:;">
							<i class="fa fa-shopping-cart"></i>
							<span class="title"><b>Transaksi</b></span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li class="start {{ Request::is('riwayatPembelian') ? 'active' : '' }} ">
								<a href="/riwayatPembelian">
								Pembelian</a>
							</li>
							<li class="start {{ Request::is('riwayatPenjualan') ? 'active' : '' }} ">
								<a href="/riwayatPenjualan">
								Penjualan</a>
							</li>
						</ul>
					</li>
					<li class="last {{ Request::is('karyawan') ? 'active' : '' }}
									{{ Request::is('karyawan/daftar') ? 'active' : '' }}
									{{ Request::is('karyawan/create') ? 'active' : '' }} ">
						@if(Auth::user())
							@if(Auth::user()->role == "root")
								@csrf
								<a href="/karyawan/daftar">
									<i class="icon-user"></i>
									<span class="title"><b>Hi, {{Auth::user()->username}}!</b></span>
								</a>
							@else
								@csrf
								<a href="/karyawan">
									<i class="icon-user"></i>
									<span class="title"><b>Hi, {{Auth::user()->username}}!</b></span>
								</a>
							@endif 
						@else
								<a href="/login">
								<i class="icon-user"></i>
								<span class="title">Login</span>
								</a>
						@endif 
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				@yield("content")
			</div>
		</div>
		<!-- END CONTENT -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2022 &copy;Nidya Pustaka.
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="fa fa-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
		<script src="{{ asset('assets/plugins/jquery-1.11.0.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
		<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
		<script type="text/javascript" src="{{ asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
		<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

		<script type="text/javascript" src="{{ asset('assets/plugins/fuelux/js/spinner.min.js')}}"></script>
		
		<script type="text/javascript" src="{{ asset('assets/plugins/jquery-mixitup/jquery.mixitup.min.js')}}"></script>
		<script type="text/javascript" src="{{ asset('assets/plugins/fancybox/source/jquery.fancybox.pack.js')}}"></script>

		<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
		<script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>

		<script src="{{ asset('assets/plugins/jcrop/js/jquery.color.js')}}"></script>
		<script src="{{ asset('assets/plugins/jcrop/js/jquery.Jcrop.min.js')}}"></script>

		<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js')}}"></script>
		<script type="text/javascript" src="{{ asset('assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>

		<script type="text/javascript" src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
		<script type="text/javascript" src="{{ asset('assets/plugins/jquery-validation/js/additional-methods.min.js')}}"></script>
		<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
		
	<!-- END PAGE LEVEL PLUGINS -->



	<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="{{ asset('assets/scripts/app.js')}}"></script>
		<script src="{{ asset('assets/scripts/login.js')}}" type="text/javascript"></script>

		<script src="{{ asset('assets/scripts/portfolio.js')}}"></script>

		<script src="{{ asset('assets/scripts/form-components.js')}}"></script>

		<script src="{{ asset('assets/scripts/form-image-crop.js')}}"></script>

		<script src="{{ asset('assets/scripts/datatable.js')}}"></script>
		<script src="{{ asset('assets/scripts/table-ajax.js')}}"></script>

		<script src="{{ asset('assets/scripts/table-advanced.js')}}"></script>

		<script src="{{ asset('assets/scripts/form-wizard.js')}}"></script>


		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

	<!-- END PAGE LEVEL SCRIPTS -->
	@yield("tempat_script")
	<script>
		jQuery(document).ready(function() {    
			App.init();
			$('#table_inventaris').DataTable();
			$('#table_riwayatPerawatan').DataTable();
			$('#table_praProduksi').DataTable();
			$('#table_prosesProduksi').DataTable();
			$('#table_riwayatPembelian').DataTable();
			$('#table_penyimpanan').DataTable();
			$('#table_lokasiPenyimpanan').DataTable();
			$('#table_riwayatPenjualan').DataTable();
			$('#table_supplier').DataTable();
			$('#table_sediaan').DataTable();
			$('#table_pengiriman').DataTable();
			$('#table_ekspedisi').DataTable();
			// $('#datetimepicker9').datepicker({
			//  viewMode: 'years'
			// });
			FormImageCrop.init();
			Portfolio.init();
			FormComponents.init();
			TableAjax.init();
			FormWizard.init();
			Login.init();

			// TableAdvanced.init();


			// $("input[name='demo2']").TouchSpin({
			//         min: -1000000000,
			//         max: 1000000000,
			//         stepinterval: 50,
			//         maxboostedstep: 10000000,
			//         prefix: '$'
			//     });
		});
	</script>	
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
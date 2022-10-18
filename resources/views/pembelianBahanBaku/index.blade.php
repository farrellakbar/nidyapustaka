@extends('layout.conquer')
@section('content')
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
      <a href="">Bahan Baku</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="">Pembelian</a>
    </li>
  </ul>
</div>
<div class="content">
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN INLINE NOTIFICATIONS PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Bahan Baku Supplier
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="javascript:;" class="reload"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="row margin-bottom-40">
								<!-- Pricing -->
              @foreach($dataSupplier as $index => $d)
              <a href="{{ route('pb', $d->id) }}"> 
								<div class="col-md-3">
									<div class="pricing hover-effect">
										<div class="pricing-head">
											<h3>
                        {{ $d->nama }} 
                        <span>
                          {{ $d->alamat }}, {{ $d->kota }}
                        </span>
											</h3>
											<h4>
                        @if( !empty($d->nomorTelepon))
                          <i>{{ $d->nomorTelepon }}</i>
                        @else
                          -
                        @endif
                          <span>
                            Nomor Telepon
                          </span>
											</h4>
										</div>
										<!-- <div class="pricing-footer">
                      <br>
                      <a href="#" class="btn btn-success">
                        Sign Up 
                        <i class="m-icon-swapright m-icon-white"></i>
                      </a>
										</div> -->
									</div>
                </div>
              </a>
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


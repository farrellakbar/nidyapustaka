@extends('layout.conquer')
@section('content')
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
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="#">Edit Inventaris</a>
    </li>
  </ul>
</div>
<div class="portlet">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i> Edit Inventaris
		</div>
		<div class="tools">
			<a href="" class="collapse"></a>
			<a href="#portlet-config" data-toggle="modal" class="config"></a>
			<a href="" class="reload"></a>
			<a href="" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<form role="form" method="POST" action="{{url('inventaris/'.$data->kode)}}">
		@csrf
        @method("PUT")
			<div class="form-body">
                <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" value="{{ $data->kode }}" name="kode" class="form-control" id="kode" placeholder="kode" required>
                    </div>
                </div> 
                <div class="form-group">
					<label>Nama</label>
					<input type="text" value="{{$data->nama}}" class="form-control" name="nama" placeholder="Nama">
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-info">Tambah</button>
				<a href ="{{url('inventaris')}}" type="button" class="btn btn-default">Batal</button>
			</div>
		</form>
	</div>
</div>
@endsection
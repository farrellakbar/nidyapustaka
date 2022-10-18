@extends('layout.conquer')
@section('content')
<h2 class="page-title">
    Profil <small>kamu</small>
</h2>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="fa fa-home"></i>
      <a href="/">Beranda</a>
      <i class="fa fa-angle-right"></i>
    </li>
    <li>
      <a href="#">Profil</a> 
    </li>
  </ul>
</div>

<div class="row profile">
    @if(session('status'))
        <div class="alert alert-success">
          <strong>Sukses! </strong>
          {{ session('status') }}
        </div>
      @endif
	<div class="col-md-12">
		<!--BEGIN TABS-->
		<div class="tabbable tabbable-custom">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab_1_1" data-toggle="tab">Sekilas</a>
				</li>
				<li>
					<a href="#tab_1_3" data-toggle="tab">Akun</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1_1">
					<div class="row">
						<div class="col-md-3">
							<ul class="list-unstyled profile-nav">
								<li>
                                    @foreach($data as $d)
                                        <div class="cropped">
                                        @if(!$d->foto)
                                            <img src="images/karyawan/guess.jpg" class="img-responsive" alt="">
                                        @else
                                            <img src="images/karyawan/{{$d->foto}}" class="img-responsive" alt=""/>
                                        @endif
                                        </div>
                                    @endforeach
								</li>
							</ul>
						</div>
						<div class="col-md-9">
                            <form role="form">
                            @foreach($data as $d)
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" value="{{$d->user->username}}" name="username" placeholder ="Username" class="form-control" readonly/>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" value="{{$d->user->email}}" name="email" placeholder ="Email" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nama Depan</label>
                                            <input type="text" value="{{$d->namaDepan}}" placeholder ="Nama Depan" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nama Belakang</label>
                                            <input type="text" value="{{$d->namaBelakang}}" placeholder ="Nama Belakang" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Agama</label>
                                            <input type="text" value="{{$d->agama->nama}}" placeholder ="Agama" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Jenis Kelamin</label>
                                            <input type="text" value="{{$d->kelamin->jenisKelamin}}" placeholder ="Jenis Kelamin" class="form-control input-medium" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tempat Lahir</label>
                                            <input type="text" value="{{$d->tempatLahir}}" placeholder ="Tempat Lahir" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tanggal Lahir</label>
                                            <input type="text" value="{{$d->tanggalLahir}}" placeholder ="Tanggal Lahir" class="form-control input-medium" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" value="{{$d->alamat}}" placeholder ="Alamat" class="form-control" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nomor HandPhone</label>
                                    <input type="text" value="{{$d->nomorHP}}" placeholder ="Nomor HandPhone" class="form-control input-medium" readonly/>
                                </div>
                            @endforeach
                            </form>
							<!--end row-->
						</div>
					</div>
				</div>
				<!--tab_1_2-->
				<div class="tab-pane" id="tab_1_3">
					<div class="row profile-account">
						<div class="col-md-3" >
							<ul class="ver-inline-menu tabbable margin-bottom-10">
								<li class="active">
									<a data-toggle="tab" href="#tab_1-1">
									<i class="fa fa-cog"></i> Info Personal </a>
									<span class="after">
									</span>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_2-2">
                                    <i class="fa fa-picture-o"></i> Ganti Foto</a>
								</li>
							</ul>
						</div>
						<div class="col-md-9" >
							<div class="tab-content">
								<div id="tab_1-1" class="tab-pane active">
									<form method="POST" action="{{ route('karyawan.update', ['karyawan' => $d->id]) }}">
                                    @foreach($data as $d)
                                            @csrf
                                            @method("PUT")
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Depan</label>
                                                        <input type="text" value="{{$d->namaDepan}}" name="namaDepan" placeholder ="Nama Depan" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Belakang</label>
                                                        <input type="text" value="{{$d->namaBelakang}}" name="namaBelakang" placeholder ="Nama Belakang" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="id_agama" class="col-form-label">Agama</label>
                                                        <select class="form-control" name="id_agama">
                                                            @foreach($dataAgama as $i)
                                                                <option value='{{$i->id}}' id="{{$i->id == $d->id_agama ? 'selected' : ''}}"
                                                                @if ($i->id == $d->id_agama)
                                                                    selected
                                                                @endif> {{ $i->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="id_kelamin" class="form-label">Jenis Kelamin</label>
                                                    <select class="form-control" name="id_kelamin">
                                                        @foreach($dataKelamin as $i)
                                                            <option value='{{$i->id}}' id="{{$i->id == $d->id_kelamin ? 'selected' : ''}}"
                                                            @if ($i->id == $d->id_kelamin)
                                                                selected
                                                            @endif> {{ $i->jenisKelamin}}</option>
                                                        @endforeach
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tempat Lahir</label>
                                                        <input type="text" value="{{$d->tempatLahir}}" name="tempatLahir" placeholder ="Tempat Lahir" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tanggal Lahir</label>
                                                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-end-date="+0d">
                                                            <input type="text" value="{{$d->tanggalLahir}}" name="tanggalLahir" class="form-control"  readonly>
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Alamat</label>
                                                <input type="text" value="{{$d->alamat}}" name="alamat" placeholder ="Alamat" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Nomor HandPhone</label>
                                                <input type="text" value="{{$d->nomorHP}}" maxlength="14" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="nomorHandPhone" placeholder ="Nomor HandPhone" class="form-control input-medium"/>
                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                            </div>
                                    @endforeach
									</form>
								</div>
								<div id="tab_2-2" class="tab-pane">
                                    <div class="row">
                                    @foreach($data as $d)
                                        <div class="col-md-4">
                                            <!-- This is the image we're attaching Jcrop to -->
                                                <div class="cropped">
                                                @if(!$d->foto)
                                                    <img src="images/karyawan/guess.jpg" class="img-responsive" alt="">
                                                @else
                                                    <img src="images/karyawan/{{$d->foto}}" class="img-responsive" alt=""/>
                                                @endif
                                                </div>
                                        </div>
                                        <div class="col-md-8"> 
                                            <h2><b>Ganti Foto</b></h2>
                                            <form enctype="multipart/form-data" role="form" method="POST" action="{{ route('karyawan.editFoto') }}">
                                            @csrf
                                                <div class="form-group">
                                                    <input type="hidden" id="id" name="id" value="{{$d->id}}"> 
                                                    <input type="file" value="" name="foto" class="form-control" id="foto" placeholder="Foto" required>
                                                </div>
                                                <button type="submit" class="btn btn-info">Tambah</button>
                                        </div>
                                    @endforeach 
                                    </div> 
								</div>
							</div>
						</div>
						<!--end col-md-9-->
					</div>
				</div>
				<!--end tab-pane-->
			</div>
		</div>
		<!--END TABS-->
	</div>
</div>

@endsection
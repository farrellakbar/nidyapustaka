@extends('layout.conquer')
@section('content')
    <h2 class="page-title">
        Buat <small>Akun Profil</small>
    </h2>
    <div class="page-bar">
		<ul class="page-breadcrumb">
            <li>
            <i class="fa fa-home"></i>
            	<a href="/">Beranda</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="/karyawan/daftar">Daftar Karyawan</a> 
				<i class="fa fa-angle-right"></i>
            </li>
			<li>
                <a href="#">Buat</a> 
            </li>
        </ul>
    </div>

    <div class="row">
		<div class="col-md-12">
			<div class="portlet" id="form_wizard_1">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i> Buat Akun Profil - <span class="step-title">
						Step 1 of 3 </span>
					</div>
					<div class="tools hidden-xs">
						<a href="javascript:;" class="collapse"></a>
						<a href="javascript:;" class="reload"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<form action="#" class="form-horizontal" id="submit_form">
           			@csrf
					   @method('PUT')
						<div class="form-wizard">
							<div class="form-body">
								<ul class="nav nav-pills nav-justified steps">
									<li>
										<a href="#tab1" data-toggle="tab" class="step">
										<span class="number">
										1 </span>
										<span class="desc">
										<i class="fa fa-check"></i> Akun </span>
										</a>
									</li>
									<li>
										<a href="#tab2" data-toggle="tab" class="step">
										<span class="number">
										2 </span>
										<span class="desc">
										<i class="fa fa-check"></i> Profil </span>
										</a>
									</li>
									<li>
										<a href="#tab4" data-toggle="tab" class="step">
										<span class="number">
										3 </span>
										<span class="desc">
										<i class="fa fa-check"></i> Konfirmasi </span>
										</a>
									</li>
								</ul>
								<div id="bar" class="progress progress-striped" role="progressbar">
									<div class="progress-bar progress-bar-success">
									</div>
								</div>
								<div class="tab-content">
									<div class="alert alert-danger display-none">
										<button class="close" data-close="alert"></button>
										You have some form errors. Please check below.
									</div>
									<div class="alert alert-success display-none">
										<button class="close" data-close="alert"></button>
										Your form validation is successful!
									</div>
									<div class="tab-pane active" id="tab1">
										<h3 class="block">Masukkan Detail Akun</h3>
										<div class="form-group">
											<label class="control-label col-md-3">Username <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
												<input type="text" class="form-control"  placeholder="Username" name="username" id="username"/>
												<span class="help-block">
												Masukkan username </span>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-md-3">Email <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
												<input type="text" class="form-control" placeholder="Email" name="email" id="email"/>
												<span class="help-block">
												Masukkan alamat email </span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Password <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
												<input id="submit_form_password" type="password" placeholder="Password" class="form-control" name="password" required autocomplete="new-password">
												<span class="help-block">
												Masukkan password. </span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Confirm Password <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
												<input type="password" class="form-control" placeholder="Re-Type Password" name="rpassword"/>
												<span class="help-block">
												Masukkan password </span>
											</div>
										</div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Role<span class="required">
											* </span>
                                            </label>
                                            <div class="col-md-2">
                                                <!-- <div class="radio-list">
                                                    <label>
                                                    <input type="radio" name="role" id="role" value="manajer" data-title="Manajer"/>
                                                    Manajer </label>
                                                    <label>
                                                    <input type="radio" name="role" id="role" value="supervisor" data-title="Supervisor" checked="checked"/>
                                                    Supervisor </label>
                                                    <label>
                                                    <input type="radio" name="role" id="role" value="pelaksana" data-title="Pelaksana"/>
                                                    Pelaksana </label>
                                                </div> -->
												<select class="form-control" name="roles" id="roles" required>
													<option value="">
														Pilih Role
													</option>
													@foreach(["manajer" => "Manajer", 
															"supervisor" => "Supervisor",
															"pelaksana" => "Pelaksana"] AS $roles => $role)    
													<option value="{{ $roles }}" {{ old("roles", $data->first()) == $roles ? "selected" : "" }}>
														{{ $role }}
													</option>
													@endforeach
												</select>
												<div id="form_role_error">
												</div>
                                            </div>
                                        </div>
									</div>
									<div class="tab-pane" id="tab2">
										<h3 class="block">Masukkan Detail Profil</h3>
										<div class="form-group">
											<label class="control-label col-md-3">Nama Depan <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
												<input type="text" class="form-control" placeholder ="Nama Depan" name="namaDepan" id="namaDepan"/>
												<span class="help-block">
												Masukkan Nama Depan </span>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-md-3">Nama Belakang <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
												<input type="text" class="form-control" placeholder ="Nama Belakang" name="namaBelakang" id="namaBelakang"/>
												<span class="help-block">
												Masukkan Nama Belakang </span>
											</div>
										</div>      
                                        <div class="form-group">
											<label class="control-label col-md-3">Alamat <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
												<input type="text" class="form-control" placeholder ="Alamat" name="alamat" id="alamat"/>
												<span class="help-block">
												Masukkan alamat </span>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-md-3">Tempat Lahir <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
												<input type="text" class="form-control" placeholder ="Tempat Lahir" name="tempatLahir" id="tempatLahir"/>
												<span class="help-block">
												Masukkann Tempat Lahir </span>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-md-3">Tanggal Lahir <span class="required">
											* </span>
											</label>
											<div class="col-md-4">
                                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-end-date="+0d">
                                                    <input type="text" value="" name="tanggalLahir" id="tanggalLahir" class="form-control"  readonly>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                                <span class="help-block">
                                                    Pilih Tanggal 
                                                </span>
											</div>
										</div>               
										<div class="form-group">
											<label class="control-label col-md-3">Nomor HP
											</label>
											<div class="col-md-4">
												<div class="input-medium">
													<input type="text" class="form-control" placeholder ="Nomor HandPhone" name="nomorHandPhone" id='nomorHandPhone'/>
													<span class="help-block">
													Masukkan Nomor HandPhone </span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Jenis Kelamin <span class="required">
											* </span>
											</label>
											<div class="col-md-2">
                                                <select class="form-control" name="id_kelamin" id='id_kelamin' required>
													<option value="">
														Pilih Jenis Kelamin
													</option>
                                                    @foreach($dataKelamin as $i)
                                                        <option value='{{$i->id}}' id='add_{{$i->id}}'>
                                                        {{$i->jenisKelamin}}
                                                        </option>
                                                    @endforeach
                                                </select>  
												<div id="form_kelamin_error">
												</div>
											</div>
										</div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Agama <span class="required">
											* </span>
											</label>
                                            <div class="col-md-2">
                                                <select class="form-control" name="id_agama" id='id_agama' required>
													<option value="">
														Pilih Agama
													</option>
                                                    @foreach($dataAgama as $i)
                                                        <option value='{{$i->id}}' id='add_{{$i->id}}'>
                                                        {{$i->nama}}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                                <div id="form_agama_error">
												</div>
                                            </div>
                                        </div>
									</div>
									<div class="tab-pane" id="tab4">
										<h3 class="block">Konfirmasi Akunn</h3>
										<h4 class="form-section">Akun</h4>
										<div class="form-group">
											<label class="control-label col-md-3">Username:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="username">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Email:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="email">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Role:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="roles">
												</p>
											</div>
										</div>
										<h4 class="form-section">Profile</h4>
										<div class="form-group">
											<label class="control-label col-md-3">Nama Depan:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="namaDepan">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Nama Belakang:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="namaBelakang">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Alamat:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="alamat">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Tempat Lahir:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="tempatLahir">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Tanggal Lahir:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="tanggalLahir">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Nomor HP:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="nomorHandPhone">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Jenis Kelamin:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="id_kelamin">
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Agama:</label>
											<div class="col-md-4">
												<p class="form-control-static" data-display="id_agama">
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions fluid">
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-offset-3 col-md-9">
											<a href="javascript:;" class="btn btn-default button-previous">
												<i class="m-icon-swapleft"></i> Kembali </a>
											<a href="javascript:;" class="btn btn-info button-next">
												Lanjut <i class="m-icon-swapright m-icon-white"></i>
											</a>
											<a href="javascript:;" class="btn btn-success button-submit">
												Buat <i class="m-icon-swapright m-icon-white"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

    <!-- <div class="portlet">
        <div class="portlet-title">
            <div class="caption"> 
                <i class="fa fa-reorder"></i> Lengkapi Data Profil 
            </div>
            <div class="tools">
                <a href="" class="collapse"></a>
                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                <a href="" class="reload"></a>
                <a href="" class="remove"></a>
            </div>
        </div>
        <div class="portlet-body form">
            <form enctype="multipart/form-data" role="form" method="POST" action="{{route('karyawan.store')}}">
            @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Depan</label>
                                <input type="text" value="" name="namaDepan" placeholder ="Nama Depan" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Belakang</label>
                                <input type="text" value="" name="namaBelakang" placeholder ="Nama Belakang" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_agama" class="col-form-label">Agama</label>
                                <select class="form-control" name="id_agama">
                                    @foreach($dataAgama as $i)
                                        <option value='{{$i->id}}' id='add_{{$i->id}}'>
                                        {{$i->nama}}
                                        </option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" name="id_kelamin">
                                    @foreach($dataKelamin as $i)
                                        <option value='{{$i->id}}' id='add_{{$i->id}}'>
                                        {{$i->jenisKelamin}}
                                        </option>
                                    @endforeach
                                </select>  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tempat Lahir</label>
                                <input type="text" value="" name="tempatLahir" placeholder ="Tempat Lahir" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-end-date="+0d">
                                    <input type="text" value="{{ date('Y-m-d') }}" name="tanggalLahir" class="form-control"  readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <span class="help-block">
                                    Pilih Tanggal 
                                </span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                        <input type="text" value="" name="alamat" placeholder ="Alamat" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nomor HandPhone</label>
                        <input type="text" value="" maxlength="14" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="nomorHandPhone"  class="form-control input-medium" required/>
                    </div>
                    <div class="form-group">
                        <label for="Foto" class="col-sm-2 col-form-label">Foto</label>
                        <input type="file" value="" name="foto" class="form-control" id="foto" placeholder="Foto" required>
                    </div>
                </div>  
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-info">Tambah</button>
                </div>
            </form>
        </div>
    </div> -->
@endsection 

@section('tempat_script')
<script>

			$('#form_wizard_1 .button-submit').click(function () {
                var eUsername=$('#username').val();
				var eEmail=$('#email').val();
                var ePassword=$('#submit_form_password').val();
				var eRole=$('#roles').val();

				var eNamaDepan=$('#namaDepan').val();
				var eNamaBelakang=$('#namaBelakang').val();
				var eTanggalLahir=$('#tanggalLahir').val();
				var eTempatLahir=$('#tempatLahir').val();
				var eId_kelamin=$('#id_kelamin').val();
				var eId_agama=$('#id_agama').val();
				var eAlamat=$('#alamat').val();
				var eNomorHandPhone=$('#nomorHandPhone').val();

                $.ajax({
                  type:'POST',
                  url: '{{route("karyawan.buatAkun")}}',
                  data: {'_token':'<?php echo csrf_token() ?>',
                          'username':eUsername,
						  'email':eEmail,
                          'password':ePassword,
                          'role':eRole,

						  'namaDepan':eNamaDepan,
						  'namaBelakang':eNamaBelakang,
						  'tanggalLahir':eTanggalLahir,
						  'tempatLahir':eTempatLahir,
						  'id_kelamin':eId_kelamin,
						  'id_agama':eId_agama,
						  'alamat':eAlamat,
						  'nomorHandPhone':eNomorHandPhone,
                        },
                  success: function(data){
                    if(data.status == 'ok')
                    {
						alert(data.msg);
						document.location.href="/karyawan/daftar";
                    }
                    else{
                        alert(data.msg);
                    }
                  }
                });
            }).hide();
</script>
@endsection 
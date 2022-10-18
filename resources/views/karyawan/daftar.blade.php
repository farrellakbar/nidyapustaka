@extends('layout.conquer')
@section('content')

    <!-- START EDIT DATA WITH MODALS & AJAX-->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true"> 
        <div class="modal-dialog">
        <div class="modal-content" id="modalContent">

        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END EDIT DATA WITH MODALS & AJAX-->

    <h2 class="page-title">
        Daftar <small>Karyawan</small>
    </h2>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
            <i class="fa fa-home"></i>
            <a href="/">Beranda</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Daftar</a> 
            </li>
        </ul>
    </div>
    @if(session('status'))
            <div class="alert alert-success">
            <strong>Sukses! </strong>
            {{ session('status') }}
            </div>
        @endif
    <div class="headline">
        @if(Auth::user()->role == "root")
            <div class="btn-group"> 
                <a type="button" class="btn btn-info" href="/karyawan/create">
                    <i class="fa fa-plus"></i> Buat Akun
                </a>
            </div>
        @endif
	</div>
	<div class="row thumbnails">
        @foreach($data as $d) 
            <div class="col-md-3">
                <div class="meet-our-team">
                    <h3>{{$d->namaDepan}} {{$d->namaBelakang}}
                    @if($d->user->role != "manajer" AND Auth::user()->role == "manajer" or  Auth::user()->role == "root")
                        <a type="button" class="btn btn-link" href="#modalEdit" data-toggle="modal" onclick="getEditForm('{{$d->id}}')">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endif

                        <small>{{$d->user->role}}</small>
                    </h3>
                    <div class="cropped img-responsive">
                        @if(!$d->foto)
                            <img src="{{ asset('images/karyawan/guess.jpg')}}" class="img-responsive" alt="">
                        @else
                            <img src="{{ asset('images/karyawan')}}/{{$d->foto}}" class="img-responsive" alt=""/>
                        @endif
                    </div>
                    <div class="team-info">
                        <div class="row ">
                            <div class="col-xs-5">
                                <strong>Kelamin</strong>
                            </div>
                            <div class="col-xs-1">
                                <strong>:</strong>
                            </div> 
                            <div class="col-xs-6">
                                {{$d->kelamin->jenisKelamin}} 
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xs-5">
                                <strong>Agama</strong>
                            </div>
                            <div class="col-xs-1">
                                <strong>:</strong>
                            </div> 
                            <div class="col-xs-6">
                                {{$d->agama->nama}} 
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xs-5">
                                <strong>No Hp</strong>
                            </div>
                            <div class="col-xs-1">
                                <strong>:</strong>
                            </div> 
                            <div class="col-xs-6">
                                {{$d->nomorHP}} 
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xs-5">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-xs-1">
                                <strong>:</strong>
                            </div> 
                            <div class="col-xs-6">
                                {{$d->alamat}} 
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xs-5">
                                <strong>Tempat, Tanggal Lahir</strong>
                            </div>
                            <div class="col-xs-1">
                                <strong>:</strong>
                            </div> 
                            <div class="col-xs-6">
                                {{$d->tempatLahir}}, {{$d->tanggalLahir}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        @endforeach
	</div>
@endsection

@section('tempat_script')
    <script>
        function getEditForm(id)
        {
            $.ajax({
            type:'POST',
            url: '{{route("karyawan.getEditForm")}}',
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
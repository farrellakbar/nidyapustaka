<form role="form" method="POST" action="{{ route('karyawan.editRole') }}">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">
        Edit Karyawan
      </h4>
  </div>
  <div class="modal-body">
    @if(session('status'))
      <div class="alert alert-success">
        <strong>Sukses! </strong>
        {{ session('status') }}
      </div>
    @endif
    @csrf
    @method("PUT")
    <div class="form-group row">
        <label for="kode" class="col-sm-4 col-form-label">Kode</label>
        <div class="col-sm-2">
        <input type="text" value="{{ $id }}" name="id" class="form-control" id="id" placeholder="ID" readonly>
        </div>
    </div>  
    <div class="form-group row">
        <label for="kode" class="col-sm-4 col-form-label">Nama Lengkap</label>
        <div class="col-sm-4">
        <input type="text" value="{{ $data2->namaDepan }} {{ $data2->namaBelakang }}" name="nama" class="form-control" id="nama" placeholder="nama" readonly>
        </div>
    </div>  
    <div class="form-group row">
      <label for="role" class="col-sm-4 col-form-label">Role</label>
      <div class="col-sm-4">
        @if(Auth::user()->role == "root")
          <select class="form-control" name="roles" id="roles">
            @foreach(["manajer" => "Manajer", 
                "supervisor" => "Supervisor",
                "pelaksana" => "Pelaksana"] AS $roles => $role)    
                <option value="{{ $roles }}" id="{{$data->role == $roles ? 'selected' : ''}}"
                  @if ($data->role == $roles)
                    selected
                  @endif> 
                  {{ $role}}
                </option>
            @endforeach
          </select>
        @else
          <select class="form-control" name="roles" id="roles">
            @foreach(["supervisor" => "Supervisor",
                "pelaksana" => "Pelaksana"] AS $roles => $role)    
                <option value="{{ $roles }}" id="{{$data->role == $roles ? 'selected' : ''}}"
                  @if ($data->role == $roles)
                    selected
                  @endif> 
                  {{ $role}}
                </option>
            @endforeach
          </select>
        @endif
				<div id="form_role_error">
				</div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
</form>  
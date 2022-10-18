@extends('layouts.login')
@section('content')
    <form action="{{ route('register') }}" method="post">
    @csrf
		<h3>Registrasi</h3>
		<p>
			 Enter your account details below:
		</p>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
                <input id="username" type="text" class="form-control placeholder-no-fix" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
			</div>
		</div>
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
                <input id="email" type="email" class="form-control placeholder-no-fix" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
		</div>

		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
			<div class="controls">
				<div class="input-icon">
					<i class="fa fa-check"></i>
                    <input id="password-confirm" type="password" placeholder="Re-Type Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
				</div>
			</div>
		</div>
		<div class="form-actions">
			<a type="button" class="btn btn-default"href="{{ route('login') }}"> Back </a>
			<button type="submit" id="register-submit-btn" class="btn btn-info pull-right">
			Sign Up <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
@endsection 

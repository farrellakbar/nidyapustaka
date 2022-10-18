@extends('layouts.login')
@section('content')
    <form class="login-form" action="{{ route('login') }}" method="post">
    @csrf
		<h3 class="form-title">Login</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
                Masukkan e-mail dan password
			</span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">{{ __('E-Mail Address') }}</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
                <input id="email" type="email" class="form-control placeholder-no-fix @error('email') is-invalid @enderror" name="email" placeholder="email" value="{{ old('email') }}" required autocomplete="email" autofocus>	
                @error('email')
                    <span style="color:red">
                        <strong>Email dan Password tidak cocok</strong>
                    </span>
                @enderror
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
                <input id="password" type="password" class="form-control placeholder-no-fix @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
			    @error('password')
                    <span style="color:red">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>
		</div>
		<div class="form-actions">
			<!-- <label class="checkbox">
				<input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}> 
				Remember me 
			</label> -->
			<button type="submit" class="btn btn-info pull-right">
				{{ __('Login') }}
			</button>
		</div>
		<!-- <div class="forget-password">
			<h4>Lupa Password ?</h4>
			<p>
				no worries, click 
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" id="forget-password">
                        here
                    </a>
                @endif
				to reset your password.
			</p>
		</div> -->
    </form>
@endsection

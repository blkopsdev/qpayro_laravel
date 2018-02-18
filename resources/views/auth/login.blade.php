@extends('layouts.app')

@section('content')
<style>
  body{
    background-attachment: fixed;
    padding-top: 0px !important;
    /*background-image: url("./images/background.png");*/
 
    background-size: 100% 100%;
  }
</style>
<body class="page-login layout-full page-dark">
<div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">
@if($settingdata)
    @foreach($settingdata as $view)
	<div class="page-content vertical-align-middle" style="background: rgba(40, 41, 41, 0.77);">
      
      <p> {{ trans('app.sing_into_your_pages_account')}}</p>
       <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

      @if ($errors->has('email'))
        <span class="help-block">
          <strong>Incorrect username and / or password</strong>
        </span>
      @endif
						<input id="email" type="username" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>

				</div>

		 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<input id="password" type="password" required class="form-control" name="password" placeholder="{{ trans('app.password')}}">

				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
		</div>
		{{ Session::forget('status') }}

          <div class="form-group clearfix">
		  @if($view->remember_me == 'ON')
            <div class="checkbox-custom checkbox-inline checkbox-primary pull-left">
              <input type="checkbox" id="remember" name="checkbox">
              <label for="inputCheckbox">{{ trans('app.remember_me')}}</label>
            </div>
			@endif
			  @if($view->forget_password == 'ON')
				<a class="pull-right" href="{{ url('/password/reset') }}">{{ trans('app.forget_password')}} </a>
			  @endif

		  </div>
          <!--<button type="submit" class="btn btn-primary btn-block" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading..">{{ trans('app.sign_in')}}</button>-->

		<button type="submit" class="btn btn-primary ladda-button btn-block" data-plugin="ladda" data-style="expand-left">
			  {{ trans('app.sign_in')}}
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
		</form>
		 <p>{{ trans('app.still_no_account_please_go_to')}} <a href="{{ url('/register') }}"> {{ trans('app.register')}} </a></p>
      <footer style="padding:20px">
          <!-- <div class="social">
            <a class="btn btn-icon btn-round social-facebook" href="{{ url('/redirect/facebook') }}">
              <i class="icon bd-facebook" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-google-plus" href="{{ url('/redirect/google') }}">
              <i class="icon bd-google-plus" aria-hidden="true"></i>
            </a>
			 <a class="btn btn-icon btn-round social-twitter" href="{{ url('/redirect/twitter') }}">
              <i class="icon bd-twitter" aria-hidden="true"></i>
            </a>
          </div> -->
        </footer>
    </div>

@endforeach
@endif

@endsection

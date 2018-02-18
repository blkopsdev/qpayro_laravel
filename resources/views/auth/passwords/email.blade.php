@extends('layouts.app')

<!-- Main Content -->
@section('content')
<body class="page-forgot-password layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
      <img src="{{URL::to('/')}}/uploads/logo_dark.png" width="200">
      <h2>¿Olvidaste tu contraseña?</h2>
      <p>Ingresa tu email para enviarte un link para reiniciar la contraseña</p>
		
       @if (Session::has('status'))
		<div class="alert alert-success">
			Te hemos enviado un correo con las instrucciones para reiniciar tu contraseña.
		</div>
		{{ Session::forget('status') }}
		{{ Session::save() }}
	@endif

		<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
			{{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

				<input id="email" placeholder="Correo Electrónico"  type="email" class="form-control" name="email" value="{{ old('email') }}">

				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
		</div>


        <div class="form-group">
		<button type="submit" class="btn btn-primary ladda-button btn-block" data-plugin="ladda" data-style="expand-left">
			 Reiniciar Contraseña
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
          <!--<button type="submit" class="btn btn-primary btn-block">Reset Your Password</button>-->
        </div>
      </form>
	  <p>Regresar al <a href="{{ url('/login') }}">Inicio de Sesión</a></p>
      <footer>
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
@endsection

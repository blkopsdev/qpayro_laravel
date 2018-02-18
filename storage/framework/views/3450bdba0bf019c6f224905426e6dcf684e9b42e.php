<!-- Main Content -->
<?php $__env->startSection('content'); ?>
<body class="page-forgot-password layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
      <img src="<?php echo e(URL::to('/')); ?>/uploads/logo_dark.png" width="200">
      <h2>¿Olvidaste tu contraseña?</h2>
      <p>Ingresa tu email para enviarte un link para reiniciar la contraseña</p>
		
       <?php if(Session::has('status')): ?>
		<div class="alert alert-success">
			Te hemos enviado un correo con las instrucciones para reiniciar tu contraseña.
		</div>
		<?php echo e(Session::forget('status')); ?>

	<?php endif; ?>

		<form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/password/email')); ?>">
			<?php echo e(csrf_field()); ?>


        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">

				<input id="email" placeholder="Correo Electrónico"  type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">

				<?php if($errors->has('email')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('email')); ?></strong>
					</span>
				<?php endif; ?>
		</div>


        <div class="form-group">
		<button type="submit" class="btn btn-primary ladda-button btn-block" data-plugin="ladda" data-style="expand-left">
			 Reiniciar Contraseña
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
          <!--<button type="submit" class="btn btn-primary btn-block">Reset Your Password</button>-->
        </div>
      </form>
	  <p>Regresar al <a href="<?php echo e(url('/login')); ?>">Inicio de Sesión</a></p>
      <footer>
          <!-- <div class="social">
            <a class="btn btn-icon btn-round social-facebook" href="<?php echo e(url('/redirect/facebook')); ?>">
              <i class="icon bd-facebook" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-google-plus" href="<?php echo e(url('/redirect/google')); ?>">
              <i class="icon bd-google-plus" aria-hidden="true"></i>
            </a>
			 <a class="btn btn-icon btn-round social-twitter" href="<?php echo e(url('/redirect/twitter')); ?>">
              <i class="icon bd-twitter" aria-hidden="true"></i>
            </a>
          </div> -->
        </footer>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
 <!-- Stylesheets -->
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/pages/profile.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/forms/advanced.css">
<script src="<?php echo e(URL::to('assets/js')); ?>/ui-bootstrap-tpls-0.11.0.js"></script>
<script src="<?php echo e(URL::to('assets')); ?>/croppie.js"></script>
<link rel="stylesheet" href="<?php echo e(URL::to('assets')); ?>/croppie.css">
<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>
<div class="page-header">
  <h1 class="page-title font_lato"><?php if(@$sucess): ?><?php echo e(@$sucess); ?> <?php else: ?> Codigo Embed Botón <?php endif; ?></h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="<?php echo e(URL::to('/dashboard')); ?>"><?php echo e(trans('app.home')); ?></a></li>
		<li><a href="<?php echo e(URL::to('business_products_detail', $business->business_id)); ?>">Regresar a listado de botones</a></li>
		<li class="active"><?php echo e($products->name); ?></li>
	</ol>
  </div>
</div>
<div class="page-content container-fluid page-profile">
  <div class="row">
	<div class="col-md-12">
	  <!-- Panel -->
	  <div class="panel">
		<div class="panel-body nav-tabs-animate nav-tabs-horizontal">
		<!------------------------start insert, update, delete message ---------------->
			<div class="col-lg-12">
			<?php if(session('msg_success')): ?>
				<div class="alert dark alert-icon alert-success alert-dismissible alertDismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				  </button>
				  <i class="icon wb-check" aria-hidden="true"></i>
				  <?php echo e(session('msg_success')); ?>

				</div>
			<?php endif; ?>
			<?php if(session('msg_update')): ?>
				<div class="alert dark alert-icon alert-info alert-dismissible alertDismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				  </button>
				  <i class="icon wb-check" aria-hidden="true"></i>
				  <?php echo e(session('msg_update')); ?>

				</div>
			<?php endif; ?>
			<?php if(session('msg_delete')): ?>
				<div class="alert dark alert-icon alert-danger alert-dismissible alertDismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				  </button>
				  <i class="icon wb-check" aria-hidden="true"></i>
				  <?php echo e(session('msg_delete')); ?>

				</div>
			<?php endif; ?>
			</div>
      <div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
      <div class="btn-group">
      <a href="<?php echo e(URL::to('business_products_send',$products->product_id)); ?>" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.add_user')); ?>"><i class="icon fa-send" aria-hidden="true"></i>Enviar link de pago</a><br/>
      </div>
      </div>
		  <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
			<li role="presentation" class=""><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-expanded="true">Detalles</a></li>
			<li class="dropdown" role="presentation" style="display: none;">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
				<span class="caret"></span>Menu </a>
			  <ul class="dropdown-menu" role="menu">
				<li role="presentation" style="display: none;"><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Detalles</a></li>
			  </ul>
			</li>
		  </ul>
		  <div class="tab-content">

<!------- Profile tab------------->
			<div class="tab-pane animation-slide-left active" id="profile" role="tabpanel">
			<table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">Tu link de pago es: <a target="_blank" href="<?php echo e(env('APP_PAYMENTS')); ?><?php echo e($business->public_key); ?>/<?php echo e($products->product_id); ?>" target="_blank"><?php echo e(env('APP_PAYMENTS')); ?><?php echo e($business->public_key); ?>/<?php echo e($products->product_id); ?></a></th>
					</tr>
				</thead>
      </table>
      <table class="table table-hover table-details">
				<tbody>
					<tr>
						<td>Vista Previa:<br><br> <a href="#"><?php echo e($products->button_text); ?></a></td>
					</tr>
          <tr>
            <td>Codigo Embed
              <pre>&lta href="<?php echo e(env('APP_PAYMENTS')); ?><?php echo e($business->public_key); ?>/<?php echo e($products->product_id); ?>" target="_blank" &gt <?php echo e($products->button_text); ?> &lt/a&gt</pre>
            </td>
          </tr>
				 </tbody>
			</table>
			<p style="border-bottom:1px dashed green;"></p>
      <table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">Vista Previa de Botón</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Vista Previa:<br><br>
              <a href="#" style="
                -webkit-border-radius: 28;
                -moz-border-radius: 28;
                border-radius: 5px;
                font-family: Arial;
                color: #ffffff;
                font-size: 20px;
                background: <?php echo e($products->color); ?>;
                padding: 10px 20px 10px 20px;
                text-decoration: none;"><?php echo e($products->button_text); ?></a></td>
					</tr>
          <tr>
						<td><pre>&lta href="<?php echo e(env('APP_PAYMENTS')); ?><?php echo e($business->public_key); ?>/<?php echo e($products->product_id); ?>" target="_blank" style="-webkit-border-radius: 28;-moz-border-radius: 28;border-radius: 5px;font-family: Arial;color: #ffffff;font-size: 20px;background: <?php echo e($products->color); ?>;padding: 10px 20px 10px 20px;text-decoration: none;"&gt <?php echo e($products->button_text); ?> &lt/a&gt</pre></td>
					</tr>
				 </tbody>
			</table>
			</div>
		  </div>
		</div>
	  </div>
	  <!-- End Panel -->
	</div>
  </div>
</div>

<br/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
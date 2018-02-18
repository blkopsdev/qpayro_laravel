<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/filament-tablesaw/tablesaw.css">


<div class="page-header">
  <h1 class="page-title font_lato">Links de Pago del comercio <?php if($business): ?> <?php echo e($business->business_name); ?> <?php endif; ?></h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="<?php echo e(URL::to('/dashboard')); ?>"><?php echo e(trans('app.home')); ?></a></li>
		<li class="active">Links de Pago</li>
	</ol>
  </div>
</div>

	
<div class="page-content">
<div class="panel">
<div class="panel-body container-fluid">

<!------------------------start insert, update, delete message ---------------->
<div class="row">

<?php if($business): ?>
	<?php if($business->status == null): ?>
	<p>
	<a class="btn btn-warning"><span class="icon fa-warning"></span>Esta opción estara habilitada al realizar el proceso correspondiente de afiliación</a>
	</p>
	<?php endif; ?>

<?php else: ?>
	<p>
	No tienes un comercio registrado, para registrarlo <a href="<?php echo e(URL::to('/register_user')); ?>" class="btn btn-info">click aquí</a>
	</p>
<?php endif; ?>
	
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

<?php if($business): ?>
	<?php if($business->step == 'finish' and $business->number_afiliation != null and $business->payment_success == '1' and $business->status == '1'): ?>
		<?php if($plans): ?>
			<?php if($limit < $plans->quantity_buttons OR $plans->quantity_buttons == '-1'): ?>
			<div class="bs-example" data-example-id="single-button-dropdown" style="float:left; ">
				<div class="btn-group">
					<a href="<?php echo e(URL::to('business_products_register',$business->business_id)); ?>" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.add_user')); ?>"><i class="icon fa-plus" aria-hidden="true"></i> Nuevo Link de Pago</a><br/>
				</div>
			</div>
			<?php endif; ?>
		
		
			<?php if($plans->custom_payment_form=='1'): ?>
			<div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
				<div class="btn-group">
					<a href="<?php echo e(URL::to('custom_form_payment',$business->business_id)); ?>" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.add_user')); ?>"><i class="icon fa-plus" aria-hidden="true"></i> Personalizar pagina de pago</a><br/>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

<div class="btn-group">
	<form class="form-inline ng-pristine ng-valid" action="<?php echo e(URL::to('business_products_view')); ?>" method="get">
		<!--<div class="form-group">
			<input type="text" name="search" class="form-control" id="search" placeholder="<?php echo e(trans('app.search_for_action')); ?>" value="<?php echo e(Request::get('search')); ?>">

		<button type="submit" class="btn btn-outline btn-default"><i class="icon fa-search" aria-hidden="true"></i></button>

		<?php if(Request::get('search') != ''): ?>
	   <a href="<?php echo e(URL::to('business_products_view')); ?>" class="btn btn-outline btn-danger" type="button">
		  <i class="icon fa-remove" aria-hidden="true"></i>
		</a>
	<?php endif; ?>
	</div>-->
</form>
</div>
</div>
<div style="clear:both;"></div><br/>

<?php if($business_products): ?>
	
	<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
		<thead>
			<tr>
				<th data-tablesaw-priority="4" class="tablesaw-priority-5 tablesaw-cell-visible">Nombre Link de Pago</th>
				<th data-tablesaw-priority="5">Comercio</th>
				<th data-tablesaw-priority="2" class="tablesaw-priority-5 tablesaw-cell-visible">Monto</th>
				<th data-tablesaw-priority="3" class="tablesaw-priority-5 tablesaw-cell-visible">Moneda</th>
				<th data-tablesaw-priority="3" class="tablesaw-priority-5 tablesaw-cell-visible">Estado</th>
				<th id='myColumnId' data-tablesaw-priority="1" class="tablesaw-priority-5 tablesaw-cell-visible"><?php echo e(trans('app.actions')); ?></th>
			</tr>
		</thead>
		<tbody>
	
			<?php $__currentLoopData = $business_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="tablesaw-priority-1 tablesaw-cell-visible"><a href="<?php echo e(URL::to('business_products_edit',$view->product_id)); ?>"><?php echo e($view->name); ?></a></td>
					<td class="tablesaw-priority-4"><?php echo e($business->business_name); ?></td>
					<td class="tablesaw-priority-3 tablesaw-cell-visible"><?php echo e($view->price); ?></td>
					<td class="tablesaw-priority-4"><?php echo e($view->currency); ?></td>
					<td class="tablesaw-priority-4">
						<?php if($view->status == '1'): ?>
							<button type="button" class="btn btn-floating btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.active')); ?>">  <i class="icon fa-check" aria-hidden="true"></i></button>
						<?php else: ?>
							<button type="button" class="btn btn-floating btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.inactive')); ?>"><i class="icon fa-ban" aria-hidden="true"></i></button>
						<?php endif; ?>
					</td>
					<td class="tablesaw-priority-2 tablesaw-cell-visible">
					<?php if($plans): ?>
						<?php if($plans->custom_fields == '1'): ?>
							<a title="Crear campos personalizados" data-toggle="tooltip" data-placement="top" data-original-title="Crear campos personalizados" class="btn btn-icon btn-info btn-outline btn-round" href="<?php echo e(URL::to('custom_fields',$view->product_id)); ?>"><i class="icon fa-bars" aria-hidden="true"></i></a>
						<?php endif; ?>
					<?php endif; ?>
					<a title="Editar" data-toggle="tooltip" data-placement="top" data-original-title="Editar" class="btn btn-icon btn-info btn-outline btn-round" href="<?php echo e(URL::to('business_products_edit',$view->product_id)); ?>"><i class="icon wb-pencil" aria-hidden="true"></i> </a>
					<a title="Ver link de pago" data-toggle="tooltip" data-placement="top" data-original-title="Ver Link de Pago" class="btn btn-icon btn-primary btn-outline btn-round " href="<?php echo e(URL::to('business_products_embed',$view->product_id)); ?>"><i class="icon fa-code" aria-hidden="true"></i></a>
					<?php if($view->status == 1): ?>
						
						<a data-placement="top" data-toggle="modal" rel="tooltip" title="Enviar"  data-original-title="Enviar"  class="btn btn-icon btn-success btn-outline btn-round" type="button" href="<?php echo e(URL::to('business_products_send',$view->product_id)); ?>"><i class="icon fa-paper-plane" aria-hidden="true"></i></a>
					<?php else: ?>
						
					<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</tbody>
		</table>
  <div style="clear:both;"></div>

	<?php echo e($business_products->links()); ?>

	
	<?php else: ?>
	<p class="text-center">No existen registros a mostrar.</p>		
	<?php endif; ?>
	
  <!-- /.panel -->
  </div>
  
  <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  </div><br/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
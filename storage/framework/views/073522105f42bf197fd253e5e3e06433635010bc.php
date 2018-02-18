<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/filament-tablesaw/tablesaw.css">
<div class="page-header">
  <h1 class="page-title font_lato">Transacciones</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="<?php echo e(URL::to('/dashboard')); ?>"><?php echo e(trans('app.home')); ?></a></li>
		<li class="active">Transacciones</li>
	</ol>
  </div>
</div>
<div class="page-content">
<div class="panel">
	<div class="panel-body container-fluid">
	<!------------------------start insert, update, delete message ---------------->
		<div class="row">
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
				<a href="<?php echo e(URL::to('list_business')); ?>" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.add_user')); ?>"><i class="icon wb-arrow-left" aria-hidden="true"></i>Regresar</a>
			</div>
		</div>
		<?php if($business): ?>
		<div class="btn-group">
			<form class="form-inline ng-pristine ng-valid" action="<?php echo e(URL::to('transactions_list',$business->business_id)); ?>" method="get">
				<div class="form-group">
					<input type="text" name="search" class="form-control" id="search" placeholder="Buscar Cliente..." value="<?php echo e(Request::get('search')); ?>">
		
				<button type="submit" class="btn btn-outline btn-default"><i class="icon fa-search" aria-hidden="true"></i></button>
		
				<?php if(Request::get('search') != ''): ?>
				 <a href="<?php echo e(URL::to('transactions_list',$business->business_id)); ?>" class="btn btn-outline btn-danger" type="button">
					<i class="icon fa-remove" aria-hidden="true"></i>
				</a>
			<?php endif; ?>
			</div>
			</form>
		</div>
		<?php endif; ?>
	</div>
	<div style="clear:both;"></div>

	<?php if($transactions): ?>
	<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
  <thead>
    <tr>
      <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">Cliente</th>
      <th data-tablesaw-priority="4" class="tablesaw-priority-5 tablesaw-cell-visible">Monto</th>
      <th data-tablesaw-priority="3">Razón</th>
      <th data-tablesaw-priority="3">Visa Cuota</th>
      <th data-tablesaw-priority="3">Fecha y hora</th>
      <th data-tablesaw-priority="3">Detalle</th>
      <th data-tablesaw-priority="2" class="tablesaw-priority-5 tablesaw-cell-visible">Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php $var_visaencuotas = ""  ?>
	
  <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td class="tablesaw-priority-6 tablesaw-cell-visible"><a href="<?php echo e(URL::to('detail_transaction',$view->transaction_id)); ?>"><?php echo e($view->cc_name); ?></a></td>
          <td class="tablesaw-priority-5 tablesaw-cell-visible"><?php echo e($view->currency); ?> <?php echo e($view->amount); ?></td>
          <td class="tablesaw-priority-4"><?php echo e($view->response_text); ?></td>
          <td class="tablesaw-priority-4">
					<?php if($view->additional_data): ?>
            <?php $__currentLoopData = json_decode($view->additional_data, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($value!=0): ?>
                 Pago realizado en <?php echo e($value); ?> visacuotas
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
          </td>
          <td class="tablesaw-priority-4"><?php echo e($view->created_at); ?></td>
          <td class="tablesaw-priority-4 ">
            <a href="<?php echo e(URL::to('detail_transaction',$view->transaction_id)); ?>" class="btn btn-outline <?php if($view->status == '1'): ?> btn-success <?php endif; ?> <?php if($view->status == '0'): ?> btn-warning <?php endif; ?>">Ver detalle</a>
          </td>
          <td class="tablesaw-priority-2 tablesaw-cell-visible">
          <?php if($view->status == '1'): ?>
            <button type="button" class="btn btn-floating btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.active')); ?>">  <i class="icon fa-check" aria-hidden="true"></i></button>
          <?php else: ?>
            <button type="button" class="btn btn-floating btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.inactive')); ?>"><i class="icon fa-close" aria-hidden="true"></i></button>
          <?php endif; ?>
          </td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
  </table>
	<div style="clear:both;"></div>
		
	<?php echo e($transactions->links()); ?>

	
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
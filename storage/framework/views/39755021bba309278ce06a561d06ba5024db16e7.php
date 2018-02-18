<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/filament-tablesaw/tablesaw.css">
<div class="page-header">
  <h1 class="page-title font_lato">Payment Method</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="<?php echo e(URL::to('/dashboard')); ?>"><?php echo e(trans('app.home')); ?></a></li>
		<li class="active">Payment Method</li>
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
<a href="<?php echo e(URL::to('payment_method_register')); ?>" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.add_user')); ?>"><i class="icon fa-plus" aria-hidden="true"></i> Nuevo Payment Method</a>
</div>
</div>

<div class="btn-group">
	<form class="form-inline ng-pristine ng-valid" action="<?php echo e(URL::to('payment_method')); ?>" method="get">
		<div class="form-group">
			<input type="text" name="search" class="form-control" id="search" placeholder="<?php echo e(trans('app.search_for_action')); ?>" value="<?php echo e(Request::get('search')); ?>">

		<button type="submit" class="btn btn-outline btn-default"><i class="icon fa-search" aria-hidden="true"></i></button>

		<?php if(Request::get('search') != ''): ?>
	   <a href="<?php echo e(URL::to('payment_method')); ?>" class="btn btn-outline btn-danger" type="button">
		  <i class="icon fa-remove" aria-hidden="true"></i>
		</a>
	<?php endif; ?>
	</div>
</form>
</div>
</div>
<div style="clear:both;"></div><br/>

<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
  <thead>
    <tr>
      <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">Merchant</th>
      <th data-tablesaw-priority="4">Namespace</th>
      <th data-tablesaw-priority="3">Name</th>
      <th data-tablesaw-priority="2">Estado</th>
      <th id='myColumnId' data-tablesaw-priority="1"><?php echo e(trans('app.actions')); ?></th>
    </tr>
  </thead>
  <tbody>
  <?php $__currentLoopData = $payment_method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td class="tablesaw-priority-6 tablesaw-cell-visible"><?php echo e($view->merchant_id); ?></td>
      <td class="tablesaw-priority-5"><?php echo e($view->namespace); ?></td>
      <td class="tablesaw-priority-4"><?php echo e($view->name); ?></td>
      <td class="tablesaw-priority-2">
      <?php if($view->status == '1'): ?>
      <button ng-if="status == 1" type="button" class="btn btn-floating btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.active')); ?>">  <i class="icon fa-check" aria-hidden="true"></i></button>
     <?php else: ?>
      <button ng-if="status == 0" type="button" class="btn btn-floating btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.inactive')); ?>"><i class="icon fa-close" aria-hidden="true"></i></button>
    <?php endif; ?>
      </td>
      <td class="tablesaw-priority-1">

      <a title="<?php echo e(trans('app.edit')); ?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.edit')); ?>" class="btn btn-icon btn-info btn-outline btn-round" href="<?php echo e(URL::to('payment_method_edit',$view->payment_method_id)); ?>"><i class="icon wb-pencil" aria-hidden="true"></i> </a>
      <?php if(Auth::user()->hasRole('Admin')): ?>
      <button data-placement="top" data-toggle="modal" rel="tooltip" title="<?php echo e(trans('app.delete')); ?>"  data-original-title="<?php echo e(trans('app.delete')); ?>"  class="btn btn-icon btn-danger btn-outline btn-round" data-target=".exampleNiftyFlipVertical"  type="button" data-href="<?php echo e(URL::to('payment_method_destroy',$view->payment_method_id)); ?>"><i class="icon fa-remove" aria-hidden="true"></i></button>
      <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
  </table>
  <div style="clear:both;"></div><br/>


  <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  </div><br/>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
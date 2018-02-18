<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/filament-tablesaw/tablesaw.css">
<div class="page-header">
  <h1 class="page-title font_lato">Planes</h1>
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
<a href="<?php echo e(URL::to('addplan')); ?>" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.add_coupon')); ?>"><i class="icon fa-plus" aria-hidden="true"></i> <?php echo e(trans('app.add_plan')); ?></a>			
</div>
<div class="btn-group">
	<form class="form-inline ng-pristine ng-valid" action="<?php echo e(URL::to('planes_list_detail')); ?>" method="get"> 
		<div class="form-group">  
			<input type="text" name="search" class="form-control" id="search" placeholder="<?php echo e(trans('app.search_for_action')); ?>" value="<?php echo e(Request::get('search')); ?>"> 
		
		<button type="submit" class="btn btn-outline btn-default"><i class="icon fa-search" aria-hidden="true"></i></button>
		 
		<?php if(Request::get('search') != ''): ?>
	   <a href="<?php echo e(URL::to('planes_list_detail')); ?>" class="btn btn-outline btn-danger" type="button">
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
			  <th style="border-right:none;"><span>plans</span></th>
			  <th data-tablesaw-priority="4" style="border-right:none;border-left:none;"><?php echo e(trans('app.state')); ?></th>
			  <th data-tablesaw-priority="4" style="border-right:none;border-left:none;"><?php echo e(trans('app.plan_trial')); ?></th>
			  <th style="border-left:none;"><span style="float:right;"><?php echo e(trans('app.actions')); ?></span></th>
		  </tr>
		</thead>
		<tbody>
		<?php $__currentLoopData = $userdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
			  <td style="border-right:none;"><div><?php echo e($view->plan_name); ?></div>
			  	<?php if($view->plan_currency==='USD'): ?>
			  	<?php if($view->plan_interval_term==='Daily'): ?>
              <div>US$ <?php echo e($view->plan_amount); ?> / Cada <?php echo e($view->plan_interval_number); ?> <?php echo e(trans('app.day')); ?></div>
              <?php elseif($view->plan_interval_term==='Weekly'): ?>
              
              <div>US$ <?php echo e($view->plan_amount); ?> / Cada <?php echo e($view->plan_interval_number); ?> <?php echo e(trans('app.week')); ?></div>
              <?php elseif($view->plan_interval_term==='Monthly'): ?>
              
              <div>US$ <?php echo e($view->plan_amount); ?> / Cada <?php echo e($view->plan_interval_number); ?> <?php echo e(trans('app.month')); ?></div>
              <?php else: ?>
                <div>US$ <?php echo e($view->plan_amount); ?> / Cada <?php echo e($view->plan_interval_number); ?> <?php echo e(trans('app.year')); ?></div>
              
              <?php endif; ?>
                
                <?php else: ?>
                <?php if($view->plan_interval_term==='Daily'): ?>
              <div>Q <?php echo e($view->plan_amount); ?> / Cada <?php echo e($view->plan_interval_number); ?> <?php echo e(trans('app.day')); ?></div>
              <?php elseif($view->plan_interval_term==='Weekly'): ?>
              
              <div>Q <?php echo e($view->plan_amount); ?> / Cada <?php echo e($view->plan_interval_number); ?> <?php echo e(trans('app.week')); ?></div>
              <?php elseif($view->plan_interval_term==='Monthly'): ?>
              
              <div>Q <?php echo e($view->plan_amount); ?> / Cada <?php echo e($view->plan_interval_number); ?> <?php echo e(trans('app.month')); ?></div>
              <?php else: ?>
                <div>Q <?php echo e($view->plan_amount); ?> / Cada <?php echo e($view->plan_interval_number); ?> <?php echo e(trans('app.year')); ?></div>
              
              <?php endif; ?>
                
                <?php endif; ?>
			  </td>	
			  <td class="tablesaw-priority-2" style="border-right:none;border-left:none;">	  
			  <?php if($view->plan_status == 'Enable'): ?>	 
				<button ng-if="status == 1" type="button" class="btn btn-floating btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.active')); ?>">  <i class="icon fa-check" aria-hidden="true"></i></button>
			 <?php else: ?>
				<button ng-if="status == 0" type="button" class="btn btn-floating btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.inactive')); ?>"><i class="icon fa-close" aria-hidden="true"></i></button>
			<?php endif; ?>
			  </td>
			  <td style="border-right:none;border-left:none;">
			  	<?php echo e($view->plan_trial); ?> 
			  </td>
			  <td style="border-left:none;">
			  <span style="float:right;">		
			  <a title="<?php echo e(trans('app.edit')); ?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(trans('app.edit')); ?>" class="btn btn-icon btn-info btn-outline btn-round" href="<?php echo e(URL::to('planedit',$view->id)); ?>"><i class="icon wb-pencil" aria-hidden="true"></i> </a> 
				
				<button data-placement="top" data-toggle="modal" rel="tooltip" title="<?php echo e(trans('app.delete')); ?>"  data-original-title="<?php echo e(trans('app.delete')); ?>"  class="btn btn-icon btn-danger btn-outline btn-round" data-target=".exampleNiftyFlipVertical"  type="button" data-href="<?php echo e(URL::to('plandestroy',$view->id)); ?>"><i class="icon fa-remove" aria-hidden="true"></i></button>
			</span>
				</td>			
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  
		</tbody>
	  </table>
<div style="clear:both;"></div><br/>

<!--<?php echo e($userdata->render()); ?>-->
<?php echo e($userdata->appends(Request::only('search'))->links()); ?>

<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div><br/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
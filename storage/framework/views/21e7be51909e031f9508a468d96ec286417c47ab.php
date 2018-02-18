<?php $__env->startSection('content'); ?>

<div class="page-content padding-20 container-fluid">
<style>
@media  screen and (max-width: 1200px) {
    .clearbothsub{
	clear:both !important;
	}
	.clearbothmain{
	width:100% !important;
	}
}
canvas{
        width: 95% !important;
        max-width: 100%;
        height: auto !important;
    }
</style>


<!-------------------------------- Start first step graph--------------->
<div class="row" data-plugin="matchHeight" data-by-row="true">
<!-- First Row -->
<div class="col-lg-3 col-sm-6 col-xs-12 info-panel">
  <div class="widget widget-shadow">
	<div class="widget-content bg-white padding-20">
	  <button type="button" class="btn btn-floating btn-sm btn-primary">
		<i class="icon wb-users" aria-hidden="true"></i>
	  </button>
	  <span class="margin-left-15 font-weight-400 example-title"><?php echo e(trans('app.total_users')); ?></span>
	  <div class="content-text text-center margin-bottom-0">
		<i class="text-danger icon wb-triangle-up font-size-20">
				  </i>
		<span class="font-size-40 font-weight-100"><?php echo e($totaluser); ?></span>
		<p class="blue-grey-400 font-weight-100 margin-0"><?php echo e(trans('app.total_redistered_users')); ?></p>
	  </div>
	</div>
  </div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12 info-panel">
  <div class="widget widget-shadow">
	<div class="widget-content bg-white padding-20">
	  <button type="button" class="btn btn-floating btn-sm btn-primary">
		<i class="icon wb-user-add" aria-hidden="true"></i>
	  </button>
	  <span class="margin-left-15 font-weight-400 example-title"> <?php echo e(trans('app.new_users')); ?></span>
	  <div class="content-text text-center margin-bottom-0">
		<i class="text-danger icon wb-triangle-up font-size-20">
				  </i>
		<span class="font-size-40 font-weight-100"><?php echo e($newuser); ?></span>
		<p class="blue-grey-400 font-weight-100 margin-0"><?php echo e(trans('app.new_users_this_month')); ?></p>
	  </div>
	</div>
  </div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12 info-panel">
  <div class="widget widget-shadow">
	<div class="widget-content bg-white padding-20">
	  <button type="button" class="btn btn-floating btn-sm btn-primary">
		<i class="icon wb-eye"></i>
	  </button>
	  <span class="margin-left-15 font-weight-400 example-title"><?php echo e(trans('app.visitors')); ?></span>
	  <div class="content-text text-center margin-bottom-0">
		<i class="text-danger icon wb-triangle-up font-size-20">
				  </i>
		<span class="font-size-40 font-weight-100"><?php echo e($monthvisitor); ?></span>
		<p class="blue-grey-400 font-weight-100 margin-0"><?php echo e(trans('app.this_month_visitors')); ?></p>
	  </div>
	</div>
  </div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12 info-panel">
  <div class="widget widget-shadow">
	<div class="widget-content bg-white padding-20">
	  <button type="button" class="btn btn-floating btn-sm btn-primary">
		<i class="icon wb-calendar" aria-hidden="true"></i>
	  </button>
	  <span class="margin-left-15 font-weight-400 example-title"><?php echo e(trans('app.visitors')); ?></span>
	  <div class="content-text text-center margin-bottom-0">
		<i class="text-danger icon wb-triangle-up font-size-20">
				  </i>
		<span class="font-size-40 font-weight-100"><?php echo e($todayvisitor); ?></span>
		<p class="blue-grey-400 font-weight-100 margin-0"><?php echo e(trans('app.today_visitors')); ?></p>
	  </div>
	</div>
  </div>
</div>
<!-- End First Row -->
</div>

<div class="row">

<div class="col-lg-4 clearbothsub">
<div class="widget widget-shadow widget-responsive" style="height: 420px;">
  <!-- Panel Followers -->
  <div class="panel" id="followers">
	<div class="panel-heading">
	<h3 class="panel-title">
		<?php echo e(trans('app.latest_registrations')); ?> <a href="<?php echo e(URL::to('/userlist')); ?>" class="pull-right"><button class="btn btn-outline btn-primary btn-round btn-xs"><?php echo e(trans('app.view_all')); ?></button> </a>
	  </h3>
	</div>
	<div class="panel-body">
	  <ul class="list-group list-group-dividered list-group-full">
		<?php $__currentLoopData = $recentuser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li class="list-group-item">
		  <div class="media">
			<div class="media-left">
			  <a class="avatar <?php echo e(Auth::user()->id == $value->id ? 'avatar-online' : 'avatar-away'); ?> " href="">
			    <?php if(!$value->image): ?>
					<img src="<?php echo e(URL::to('/images')); ?>/default.png" alt="">
			    <?php else: ?>
					<img src="<?php echo e(URL::to('/uploads')); ?>/<?php echo e($value->image); ?>" alt="">
				 <?php endif; ?>
				<i></i>
			  </a>
			</div>

			<div class="media-body">
			  <div class="pull-right">
				<em class="badge">
			      <?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->diffForHumans()); ?>

		     </em>
			  </div>
			  <div>
				<a href=""><span><strong><?php echo e($value->first_name); ?> <?php echo e($value->last_name); ?></strong></span></a>
			  </div>
			</div>
		  </div>
		</li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  </ul>
	</div>
  </div>
  <!-- End Panel Followers -->
</div>
</div>
</div>
 <!-------------------------------- end second step graph--------------->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
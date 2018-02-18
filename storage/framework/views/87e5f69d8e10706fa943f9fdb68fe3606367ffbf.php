<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/filament-tablesaw/tablesaw.css">
<style>
canvas{
	width: 95% !important;
	max-width: 100%;
	height: auto !important;
}
</style>
<div class="page-content padding-20 container-fluid">
<!------------------------------ Start Alert message--------------->
<!--<div class="alert alert-primary alert-dismissible alertDismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">×</span>
  </button>
 <?php echo e(trans('app.welcome')); ?>  <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> !
</div> -->
<!-------------------------------- End alert message--------------->
	<!------------------------------ Start Alert message--------------->
	<div role="alert" class="alert dark alert-primary alert-dismissible">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button">
      <span aria-hidden="true">×</span>
    </button>
    <h4><?php echo e(trans('app.welcome')); ?>  <?php echo e(Auth::user()->first_name); ?>!</h4>
    <p class="margin-top-15">
				<?php if($business->step == 'step2' or $business->step == 'step3' or $business->step == 'step4' or $business->step == 'step5' or $business->step == 'step6'): ?>
				<p>
				 Aun tienes información pendiente para completar tu aplicación.
				</p>
	      <a class="btn btn-primary btn-inverse btn-outline" href="<?php echo e(URL::to($business->step,$business->business_id)); ?>">Completar</a>
				<?php endif; ?>
    </p>
  </div>
	<?php if($business->step == 'complete' and $business->number_afiliation == null): ?>
	<a href="<?php echo e(URL::to('/list_business')); ?>" class="btn btn-block btn-warning"><span class="icon fa-warning"></span> Aún tienes el comercio <?php echo e($business->business_name); ?>  pendiente de confirmación.</a>
	<?php endif; ?>
	<?php if($business->step == 'complete' and $business->number_afiliation != null): ?>
	<a href="<?php echo e(URL::to('/payment', [$business->business_id])); ?>" class="btn btn-block btn-success"><span class="icon fa-credit-card"></span> Tu comercio <?php echo e($business->business_name); ?> fue autorizado, haz click aqui para realizar el pago.</a>
	<?php endif; ?>
	<?php if($business->step == 'finish' and $business->number_afiliation != null and $business->payment_success == '1' and $business->status == '0'): ?>
	<a href="<?php echo e(URL::to('/list_business')); ?>" class="btn btn-block btn-warning"><span class="icon fa-credit-card"></span> Tu pago fue procesado exitosamente, estaremos informandote cuando tus credenciales esten configuradas. (3-5 días habiles)</a>
	<?php endif; ?>
	<?php if($business->step == 'finish' and $business->number_afiliation != null and $business->payment_success == '1' and $business->status == '1'): ?>
	<a href="<?php echo e(URL::to('/list_business')); ?>" class="btn btn-block btn-success"><span class="icon fa-check"></span> Tu comercio <?php echo e($business->business_name); ?> esta listo para efectuar cobros</a>
	<?php endif; ?>
		<!-------------------------------- End alert message--------------->
</div>

<!-------------------------------- start second step graph--------------->
<div class="row">
<div class="col-md-12">
<div class="widget widget-shadow widget-responsive">
<h3 class="panel-title">Ventas ultimos 6 meses</h3>

<?php echo $chart_gtq->render(); ?>


</div>

</div>

</div>
 <!-------------------------------- end second step graph--------------->
 <!-------------------------------- start second step graph--------------->
 <div class="row">
 <div class="col-md-12">
 <div class="widget widget-shadow widget-responsive">
 <h3 class="panel-title">Ventas ultimos 6 meses</h3>

 <?php echo $chart_usd->render(); ?>


 </div>

 </div>

 </div>
  <!-------------------------------- end second step graph--------------->
 <!-------------------------------- start second step graph--------------->
 <div class="row">
 <div class="col-md-12">
 <div class="widget widget-shadow widget-responsive">
 <h3 class="panel-title">Ultimas 10 transacciones</h3>
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
		 <?php if(@$transactions): ?>
   <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr>
           <td class="tablesaw-priority-6 tablesaw-cell-visible"><a href="<?php echo e(URL::to('detail_transaction',$view->transaction_id)); ?>"><?php echo e($view->cc_name); ?></a></td>
           <td class="tablesaw-priority-5 tablesaw-cell-visible"><?php echo e($view->currency); ?> <?php echo e($view->amount); ?></td>
           <td class="tablesaw-priority-4"><?php echo e($view->response_text); ?></td>
					 <td class="tablesaw-priority-4">
					 <?php if($view->additional_data): ?>
						 <?php $__currentLoopData = json_decode($view->additional_data, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		             <?php if($value!=0 and $view->status == '1'): ?>
								 	Pago realizado en <?php echo e($value); ?> visacuotas
								 <?php endif; ?>
								 <?php if($value!=0 and $view->status == '0'): ?>
								 	Intento realizado con <?php echo e($value); ?> visacuotas
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
		 <?php endif; ?>
   </tbody>
   </table>
 </div>

 </div>

 </div>
  <!-------------------------------- end second step graph--------------->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
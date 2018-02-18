<!DOCTYPE html>
<html class="no-js css-menubar" lang="es">
<head>
  <meta charset="utf-8">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="My QPayPro">
  <meta name="author" content="">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <title><?php $__currentLoopData = $settingdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($view->app_title); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  </title>
  <!-- Stylesheets -->
  <link href="<?php echo e(URL::to('assets/css')); ?>/bootstrap-fileupload.min.css" rel="stylesheet">
	 
		<?php echo Charts::assets(); ?>

  
		<?php echo e(Html::style('global/css/bootstrap.min.css')); ?>

  <?php echo e(Html::style('global/css/bootstrap-extend.min.css')); ?>


  <?php echo e(Html::style('assets/css/site.min.css')); ?>

		
		<?php echo e(Html::style('css/custom.css')); ?>


  <!-- Plugins -->
   <?php echo e(Html::style('global/vendor/animsition/animsition.css')); ?>

   <?php echo e(Html::style('global/vendor/asscrollable/asScrollable.css')); ?>

   <?php echo e(Html::style('global/vendor/switchery/switchery.css')); ?>

   <?php echo e(Html::style('global/vendor/intro-js/introjs.css')); ?>

   <?php echo e(Html::style('global/vendor/slidepanel/slidePanel.css')); ?>

   <?php echo e(Html::style('global/vendor/jvectormap/jquery-jvectormap.css')); ?>

   <?php echo e(Html::style('assets/examples/css/dashboard/v1.css')); ?>

   <?php echo e(Html::style('assets/examples/css/dashboard/analytics.css')); ?>


   <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/ladda-bootstrap/ladda.css">
   <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/uikit/buttons.css">
   <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/uikit/dropdowns.css">

  <!-- Fonts -->
  <?php echo e(Html::style('global/fonts/font-awesome/font-awesome.css')); ?>

  <?php echo e(Html::style('global/fonts/weather-icons/weather-icons.css')); ?>

  <?php echo e(Html::style('global/fonts/web-icons/web-icons.min.css')); ?>

  <?php echo e(Html::style('global/fonts/brand-icons/brand-icons.min.css')); ?>

  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

  <!------------------------new mail css-------------------->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-markdown/bootstrap-markdown.css">
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/select2/select2.css">
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/apps/mailbox.css">
  <!------------------------end new mail css-------------------->

	<style>
	.page-content {padding: 0px 30px;}
	</style>

  <?php echo e(Html::script('global/vendor/modernizr/modernizr.js')); ?>

  <?php echo e(Html::script('global/vendor/breakpoints/breakpoints.js')); ?>

  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>
  <!--<script src="<?php echo e(URL::to('assets/js')); ?>/angular.js"></script>-->
  <script>
  Breakpoints();
  </script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
 <?php echo e(Html::script('global/vendor/jquery/jquery.js')); ?>


	 <?php echo $__env->yieldContent('top.scripts'); ?>
	
	<?php if(App::environment('production')): ?>
		
	<!-- Start of qpaypro Zendesk Widget script -->
<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="qpaypro.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
/*]]>*/</script>
<!-- End of qpaypro Zendesk Widget script -->
  
	<?php endif; ?>
	
  </head>
<body class="dashboard app-mailbox" onload="">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <?php $__currentLoopData = $settingdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<img class="navbar-brand-logo" src="<?php echo e(URL::to('/')); ?>/uploads/logo_dark.png" title="<?php echo e($view->app_name); ?>">

		<span class="navbar-brand-text hidden-xs"> <?php echo e($view->app_name); ?> </span>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <!--<li class="hidden-float" id="toggleMenubar">
            <a data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>-->
          <li class="hidden-xs" id="toggleFullscreen">
            <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
              <span class="sr-only">Toggle fullscreen</span>
            </a>
          </li>

        </ul>
        <!-- End Navbar Toolbar -->
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
<?php if(Auth::user()->hasRole('Admin')): ?>
          <li class="dropdown">
            <a class="dropdown-toggle" title="<?php echo e(trans('app.languages')); ?>" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
            aria-expanded="false" role="button">

			 <?php if(Session::get('locale_image')): ?>
			<img width="18.66" height="14" src="<?php echo e(URL::to('/')); ?>/assets/flags/<?php if(Session::get('locale_image')): ?><?php echo e(Session::get('locale_image')); ?> <?php endif; ?>"/>
			 <?php else: ?>
				 <img width="22.66" height="16" src="<?php echo e(URL::to('/')); ?>/assets/flags/1489443532.png"/>
			  <?php endif; ?>
            </a>
			<ul class="dropdown-menu" role="menu">

			  <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $viewdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li role="presentation">
                <a href="<?php echo e(URL::to('/LanguageController/chooser_language/')); ?>/<?php echo e($viewdata->foldername); ?>" role="menuitem">
                  <?php if(!empty($viewdata->flag_image)): ?>	<img src="<?php echo e(URL::to('assets/flags')); ?>/<?php echo e($viewdata->flag_image); ?>"  width="18.66" height="14" /> <?php endif; ?> <?php echo e($viewdata->languagename); ?>


              </a>
			  </li>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </li>
					<?php endif; ?>
          <!-- -->
										 <?php if($current_business): ?>
          <li class="dropdown">
										  <a  class="" >
													Comercio: <b><?php echo e(strtoupper($current_business->business_name)); ?></b>
												</a>
          </li>
										<li>
											
												<a class="" title="<?php echo e(trans('app.switch')); ?>"  data-target="#fillIn" data-toggle="modal"
            data-animation="scale-up" role="button">
											 
												<i class="icon fa-exchange" aria-hidden="true"></i> Cambiar</label>
            </a>
            
												
										</li>
											<?php endif; ?>
          <!-- -->
          <li class="dropdown">
            <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" title="<?php echo e(trans('app.my_profile')); ?>"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
              <!--  <img src="<?php echo e(URL::to('/')); ?>/global/portraits/5.jpg" alt="...">-->
			  <?php if(!empty(Auth::user()->image)): ?>
                <img src="<?php echo e(URL::to('/')); ?>/uploads/<?php echo e(Auth::user()->image); ?>" alt="...">
			  <?php else: ?>
				   <img src="<?php echo e(URL::to('/')); ?>/images/default.png" alt="...">
				 <?php endif; ?>
                <i></i>
              </span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="<?php echo e(URL::to('profileEdit')); ?>" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> <?php echo e(trans('app.my_profile')); ?></a>
              </li>
              <!--<li role="presentation">
                <a href="javascript:void(0)" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Billing</a>
              </li>-->
			  <?php if(Auth::user()->hasRole('Admin')): ?>
              <li role="presentation">
                <a href="<?php echo e(URL::to('settings')); ?>" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i><?php echo e(trans('app.settings')); ?></a>
              </li>
			  <?php endif; ?>
              <li class="divider" role="presentation"></li>
              <li role="presentation">
			  <a href="<?php echo e(url('/logout')); ?>"
					onclick="event.preventDefault();
							 document.getElementById('logout-form').submit();">
					<?php echo e(trans('app.logout')); ?>

				</a>
				<form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
					<?php echo e(csrf_field()); ?>

				</form>
               <!-- <a href="<?php echo e(URL::to('logout')); ?>" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> <?php echo e(trans('app.logout')); ?></a>-->
              </li>
            </ul>
          </li>

		  <?php if(Auth::user()->hasRole('Admin')): ?>
          <li id="toggleChat">
            <a data-toggle="site-sidebar" href="javascript:void(0)" title="<?php echo e(trans('app.sidebar')); ?>" data-url="<?php echo e(URL::to('SettingController/sidebar/')); ?>">

              <!--<i class="icon wb-chat" aria-hidden="true"></i>-->
			  <i class="icon wb-more-vertical" aria-hidden="true"></i>
            </a>
          </li>
		  <?php endif; ?>
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->
      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search" action="<?php echo e(URL::to('userlist')); ?>">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="search" placeholder="<?php echo e(trans('app.search_for_users')); ?>">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
  <div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu">
           <!-- <li class="site-menu-category">General</li>-->
          <br/>
 <!-------------- Dashboard menu --------------->
	 <li class="site-menu-category" style="margin-top:1px; text-transform:none;font-size:16px; color:white; "><b><!--Menú--></b></li>
            <li class="site-menu-item has-sub <?php echo e(Request::is('dashboard') ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title"><?php echo e(trans('app.dashboard')); ?></span>
               <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>">
                  <a class="animsition-link" href="<?php echo e(URL::to('/dashboard_business')); ?><?php if(@Session::get('business_details')): ?>/<?php echo e(Session::get('business_actual')); ?><?php endif; ?>">
                    <!--<span class="site-menu-title">Dashboard</span>-->
                    <span class="site-menu-title"><?php echo e(trans('app.home')); ?></span>
                  </a>
                </li>
              </ul>
              <ul class="site-menu-sub">
													
														  <li class="site-menu-item <?php echo e(Request::is('transactions_list') ? 'active' : ''); ?>">
                  <a class="animsition-link" href="<?php echo e(URL::to('/transactions_list')); ?><?php if(@Session::get('business_details')): ?>/<?php echo e(Session::get('business_actual')); ?><?php endif; ?>">
                    <!--<span class="site-menu-title">Dashboard</span>-->
                    <span class="site-menu-title">Transacciones</span>
                  </a>
                </li>
              </ul>
            </li>
	<!-------------- Users menu --------------->
 <?php if (\Entrust::can(['users.manage', 'users.activity'])) : ?>

			<li class="site-menu-item has-sub  <?php echo e(Request::is('userlist','registration','activity') ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
			  <i class="site-menu-icon wb-user" aria-hidden="true"></i>
                <span class="site-menu-title"><?php echo e(trans('app.users')); ?></span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
               <?php if (\Entrust::can('users.manage')) : ?>
				<li class="site-menu-item <?php echo e(Request::is('registration') ? 'active' : ''); ?>">
                  <a class="animsition-link" href="<?php echo e(URL::to('/registration')); ?>">
                    <span class="site-menu-title"><?php echo e(trans('app.add_user')); ?></span>
                  </a>
                </li>
                <li class="site-menu-item <?php echo e(Request::is('userlist') ? 'active' : ''); ?>">
                  <a class="animsition-link " href="<?php echo e(URL::to('userlist')); ?>">
                    <span class="site-menu-title"><?php echo e(trans('app.users')); ?></span>
                  </a>
                </li>
				<?php endif; // Entrust::can ?>
				<?php if (\Entrust::can('users.activity')) : ?>
                <li class="site-menu-item <?php echo e(Request::is('activity') ? 'active' : ''); ?>">
                  <a class="animsition-link" href="<?php echo e(URL::to('activity')); ?>">
                    <span class="site-menu-title"><?php echo e(trans('app.activity_log')); ?></span>
                  </a>
                </li>
				<?php endif; // Entrust::can ?>
              </ul>
            </li>
			<?php endif; // Entrust::can ?>
<!-------------- Mantenimientos --------------->
<?php if (\Entrust::can('manteinance.manteinance')) : ?>
<li class="site-menu-item has-sub <?php echo e(Request::is('manteinance') ? 'active open' : ''); ?>">
       <a href="javascript:void(0)">
 <i class="site-menu-icon icon wb-hammer" aria-hidden="true"></i>
         <span class="site-menu-title">Mantenimientos</span>
         <span class="site-menu-arrow"></span>
       </a>
       <ul class="site-menu-sub">
         <li class="site-menu-item <?php echo e(Request::is('merchant') ? 'active' : ''); ?>">
           <a class="animsition-link" href="<?php echo e(URL('/merchant')); ?>">
             <span class="site-menu-title">Merchants</span>
           </a>
         </li>
       </ul>
       <ul class="site-menu-sub">
         <li class="site-menu-item <?php echo e(Request::is('payment_method') ? 'active' : ''); ?>">
           <a class="animsition-link" href="<?php echo e(URL('/payment_method')); ?>">
             <span class="site-menu-title">Payment Method</span>
           </a>
         </li>
       </ul>
       <ul class="site-menu-sub">
         <li class="site-menu-item <?php echo e(Request::is('payment_gateway') ? 'active' : ''); ?>">
           <a class="animsition-link" href="<?php echo e(URL('/payment_gateway')); ?>">
             <span class="site-menu-title">Payment Gateway</span>
           </a>
         </li>
       </ul>
       <ul class="site-menu-sub">
         <li class="site-menu-item <?php echo e(Request::is('business') ? 'active' : ''); ?>">
           <a class="animsition-link" href="<?php echo e(URL('/business')); ?>">
             <span class="site-menu-title">Business</span>
           </a>
         </li>
       </ul>
       <ul class="site-menu-sub">
         <li class="site-menu-item <?php echo e(Request::is('business_products') ? 'active' : ''); ?>">
           <a class="animsition-link" href="<?php echo e(URL('/business_products')); ?>">
             <span class="site-menu-title">Business Products</span>
           </a>
         </li>
       </ul>
     </li>
<?php endif; // Entrust::can ?>
<!-------------- Fin Mantenimientos --------------->
<!-------------- Mantenimientos --------------->
<?php if (\Entrust::can('visanet.visanet')) : ?>
<li class="site-menu-item has-sub <?php echo e(Request::is('manteinance') ? 'active open' : ''); ?>">
       <a href="javascript:void(0)">
 <i class="site-menu-icon icon wb-hammer" aria-hidden="true"></i>
         <span class="site-menu-title">VisaNet</span>
         <span class="site-menu-arrow"></span>
       </a>
       <ul class="site-menu-sub">
         <li class="site-menu-item <?php echo e(Request::is('business_visanet') ? 'active' : ''); ?>">
           <a class="animsition-link" href="<?php echo e(URL('/business_visanet')); ?>">
             <span class="site-menu-title">Listado de Comercios</span>
           </a>
         </li>
       </ul>
     </li>
<?php endif; // Entrust::can ?>
<!-------------- Fin Mantenimientos --------------->
<?php if(Auth::user()->hasRole('Admin') or Auth::user()->hasRole('User')): ?>
<!-------------- Mantenimientos --------------->
<?php if (\Entrust::can('register_user.register_user')) : ?>
<li class="site-menu-item has-sub <?php echo e(Request::is('register_user') ? 'active open' : ''); ?>">
       <a href="javascript:void(0)">
 <i class="site-menu-icon icon wb-hammer" aria-hidden="true"></i>
         <span class="site-menu-title">Comercio</span>
         <span class="site-menu-arrow"></span>
       </a>
       <ul class="site-menu-sub">
         <li class="site-menu-item <?php echo e(Request::is('register_user') ? 'active' : ''); ?>">
           <a class="animsition-link" href="<?php echo e(URL('/register_user')); ?>">
             <span class="site-menu-title">Registrar Comercio</span>
           </a>
         </li>
       </ul>
       <ul class="site-menu-sub">
         <li class="site-menu-item <?php echo e(Request::is('list_business') ? 'active' : ''); ?>">
           <a class="animsition-link" href="<?php echo e(URL('/list_business')); ?>">
             <span class="site-menu-title">Listado de Comercios</span>
           </a>
         </li>
       </ul>
     </li>
     <li class="site-menu-item has-sub <?php echo e(Request::is('register_user') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)">
      <i class="site-menu-icon icon fa-cubes" aria-hidden="true"></i>
              <span class="site-menu-title">Integraciones</span>
              <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
              <li class="site-menu-item <?php echo e(Request::is('third_integration') ? 'active' : ''); ?>">
                <a class="animsition-link" href="<?php echo e(URL('/third_integration')); ?>">
                  <span class="site-menu-title">Modulos disponibles</span>
                </a>
              </li>
            </ul>
          </li>
      <li class="site-menu-item has-sub <?php echo e(Request::is('register_user') ? 'active open' : ''); ?>">
             <a href="javascript:void(0)">
       <i class="site-menu-icon icon fa-cube" aria-hidden="true"></i>
               <span class="site-menu-title">Links de Pago</span>
               <span class="site-menu-arrow"></span>
             </a>
             <ul class="site-menu-sub">
               <li class="site-menu-item <?php echo e(Request::is('business_products_detail') ? 'active' : ''); ?>">
                 <a class="animsition-link" href="<?php echo e(URL('/business_products_detail')); ?><?php if(@Session::get('business_details')): ?>/<?php echo e(Session::get('business_actual')); ?><?php endif; ?>">
                   <span class="site-menu-title">Ver Links de Pago</span>
                 </a>
               </li>
             </ul>
             <ul class="site-menu-sub">
               <li class="site-menu-item <?php echo e(Request::is('custom_form_payment') ? 'active' : ''); ?>">
                 <a class="animsition-link" href="<?php echo e(URL('/custom_form_payment')); ?><?php if(@Session::get('business_details')): ?>/<?php echo e(Session::get('business_actual')); ?><?php endif; ?>">
                   <span class="site-menu-title">Página de pago</span>
                 </a>
               </li>
             </ul>
           </li>
    <li class="site-menu-item has-sub <?php echo e(Request::is('register_user') ? 'active open' : ''); ?>">
             <a href="javascript:void(0)">
       <i class="site-menu-icon icon fa-cube" aria-hidden="true"></i>
               <span class="site-menu-title">Suscripciones</span>
               <span class="site-menu-arrow"></span>
             </a>
             <ul class="site-menu-sub">
               <li class="site-menu-item <?php echo e(Request::is('business_products_detail') ? 'active' : ''); ?>">
                 <a class="animsition-link" href="<?php echo e(URL('/coupons_list_detail')); ?>">
                   <span class="site-menu-title">Cupones</span>
                 </a>
               </li>
               <li class="site-menu-item <?php echo e(Request::is('business_products_detail') ? 'active' : ''); ?>">
                 <a class="animsition-link" href="<?php echo e(URL('/planes_list_detail')); ?>">
                   <span class="site-menu-title">Planes</span>
                 </a>
               </li>
             </ul>
           </li>
<?php endif; // Entrust::can ?>
<!-------------- Fin Mantenimientos --------------->
<?php endif; ?>
	<!-------------- language menu --------------->
			 <?php if (\Entrust::can('languages.languages')) : ?>
			 <li class="site-menu-item has-sub <?php echo e(Request::is('language') ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
			  <i class="site-menu-icon fa-language" aria-hidden="true"></i>
                <span class="site-menu-title"><?php echo e(trans('app.languages')); ?></span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e(Request::is('language') ? 'active' : ''); ?>">
                  <a class="animsition-link" href="<?php echo e(URL('/language')); ?>">
                    <span class="site-menu-title"><?php echo e(trans('app.languages')); ?></span>
                  </a>
                </li>
              </ul>
            </li>
			<?php endif; // Entrust::can ?>
<!-------------- roles and permission  menu --------------->
		 <?php if (\Entrust::can(['roles.manage', 'permissions.manage'])) : ?>
			 <li class="site-menu-item has-sub <?php echo e(Request::is('permissions','roles') ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
			  <i class="site-menu-icon fa-lock" aria-hidden="true"></i>
                <span class="site-menu-title"><?php echo e(trans('app.roles_and_permissions')); ?></span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
			   <?php if (\Entrust::can('roles.manage')) : ?>
                <li class="site-menu-item <?php echo e(Request::is('roles') ? 'active' : ''); ?>">
                  <a class="animsition-link" href="<?php echo e(URL::to('/roles')); ?>">
                    <span class="site-menu-title"><?php echo e(trans('app.roles')); ?></span>
                  </a>
                </li>
				<?php endif; // Entrust::can ?>
				 <?php if (\Entrust::can('roles.manage')) : ?>
				<li class="site-menu-item <?php echo e(Request::is('permissions') ? 'active' : ''); ?>">
                  <a class="animsition-link" href="<?php echo e(URL::to('/permissions')); ?>">
                    <span class="site-menu-title"><?php echo e(trans('app.permissions')); ?></span>
                  </a>
                </li>
				<?php endif; // Entrust::can ?>
              </ul>
            </li>
		<?php endif; // Entrust::can ?>
<!-------------- Message  menu --------------->
		<?php if (\Entrust::can('message.messages')) : ?>
			 <li class="site-menu-item has-sub <?php echo e(Request::is('message') ? 'active open' : ''); ?>">
              <a href="javascript:void(0)">
			  <i class="site-menu-icon fa fa-envelope-o" aria-hidden="true"></i>
                <span class="site-menu-title"><?php echo e(trans('app.messages')); ?></span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item <?php echo e(Request::is('message') ? 'active' : ''); ?>">
                  <a class="animsition-link" href="<?php echo e(URL::to('/message')); ?>">
                    <span class="site-menu-title"><?php echo e(trans('app.messages')); ?></span>
                  </a>
                </li>
              </ul>
            </li>
		<?php endif; // Entrust::can ?>

          </ul>
        </div>
      </div>
    </div>
    <div class="site-menubar-footer">
	<a href="<?php echo e(URL::to('profileEdit')); ?>" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo e(trans('app.edit_profile')); ?>">
       <i class="icon wb-pencil" aria-hidden="true"></i>
      </a>
       <?php if(Auth::user()->hasRole('Admin')): ?>
	  <a href="<?php echo e(URL::to('settings')); ?>" class="fold-show" data-placement="top" data-toggle="tooltip"
      data-original-title="<?php echo e(trans('app.settings')); ?>">
        <span class="icon wb-settings" aria-hidden="true"></span>
      </a>
	  <?php else: ?>
	  <a class="fold-show" data-placement="top" data-toggle="tooltip"
      data-original-title="">
        &nbsp;
      </a>
	  <?php endif; ?>
      <a href="<?php echo e(url('/logout')); ?>"
			onclick="event.preventDefault();
					 document.getElementById('logout-form').submit();" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo e(trans('app.logout')); ?>">
			<span class="icon wb-power" aria-hidden="true"></span>
		</a>
		<form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
			<?php echo e(csrf_field()); ?>

		</form>
    </div>
  </div>
<!-------------------- logo click menu---------------->
  <div class="site-gridmenu">
    <div>
      <div>
        <ul>
		 <li>
            <a href="<?php echo e(URL::to('/dashboard')); ?>">
              <i class="icon wb-dashboard"></i>
              <span><?php echo e(trans('app.dashboard')); ?></span>
            </a>
          </li>
		  <?php if (\Entrust::can('users.manage')) : ?>
		  <li>
            <a href="<?php echo e(URL::to('userlist')); ?>">
              <i class="icon wb-users" aria-hidden="true"></i>
              <span><?php echo e(trans('app.users')); ?></span>
            </a>
          </li>
		  <?php endif; // Entrust::can ?>
		  <?php if (\Entrust::can('languages.languages')) : ?>
		   <li>
            <a href="<?php echo e(URL::to('language')); ?>">
            <i class="icon fa-language" aria-hidden="true"></i>

              <span><?php echo e(trans('app.languages')); ?></span>
            </a>
          </li>
		   <?php endif; // Entrust::can ?>
		   <?php if (\Entrust::can('message.messages')) : ?>
          <li>
            <a href="<?php echo e(URL::to('message')); ?>">
              <i class="icon wb-envelope"></i>
              <span><?php echo e(trans('app.messages')); ?></span>
            </a>
          </li>
			 <?php endif; // Entrust::can ?>
			 <?php if (\Entrust::can('permissions.manage')) : ?>
          <li>
            <a href="<?php echo e(URL::to('permissions')); ?>">
              <i class="icon wb-lock"></i>
              <span><?php echo e(trans('app.permissions')); ?></span>
            </a>
          </li>
          <?php endif; // Entrust::can ?>
		  <?php if (\Entrust::can('settings.general')) : ?>
          <li>
            <a href="<?php echo e(URL::to('settings')); ?>">
              <i class="icon wb-settings" aria-hidden="true"></i>
              <span><?php echo e(trans('app.settings')); ?></span>
            </a>
          </li>
         <?php endif; // Entrust::can ?>

        </ul>
      </div>
    </div>
  </div>
  <!-- Page -->
		
	<maindd>
		<div class="loadersjew">
			<div class="loaderjew"><div class="line-scale"><div></div><div></div><div></div><div></div><div></div></div></div>
			<!--<div class="loaderjew"><div class="line-scale-party"><div></div><div></div><div></div><div></div></div></div>-->
			<!--<div class="loader"><div class="line-scale-pulse-out"><div></div><div></div><div></div><div></div><div></div></div></div>
			<div class="loader"><div class="line-scale-pulse-out-rapid"><div></div><div></div><div></div><div></div><div></div></div></div>-->
		</div>
	</maindd>
		
  <div class="page" style="animation-duration: 800ms; opacity: 1;">
   <!-- page content -->
	<?php echo $__env->yieldContent('content'); ?>
	<!-- /page content -->
  </div>
  <!-- End Page -->
  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© <?php echo e(date('Y')); ?> <a href="<?php echo e(URL::to('/')); ?>"><?php $__currentLoopData = $settingdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($view->app_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></a></div>
    <div class="site-footer-right">
     <?php echo e(trans('app.email')); ?> <i class="red-600 wb wb-heart"></i>  <?php $__currentLoopData = $settingdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($view->app_email); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </footer>
 <!-- Core  -->

   <?php echo e(Html::script('global/vendor/bootstrap/bootstrap.js')); ?>

   <?php echo e(Html::script('global/vendor/animsition/animsition.js')); ?>

   <?php echo e(Html::script('global/vendor/asscroll/jquery-asScroll.js')); ?>

   <?php echo e(Html::script('global/vendor/mousewheel/jquery.mousewheel.js')); ?>

   <?php echo e(Html::script('global/vendor/asscrollable/jquery.asScrollable.all.js')); ?>

   <?php echo e(Html::script('global/vendor/ashoverscroll/jquery-asHoverScroll.js')); ?>


  <!-- Plugins -->
  <?php echo e(Html::script('global/vendor/switchery/switchery.min.js')); ?>

  <?php echo e(Html::script('global/vendor/intro-js/intro.js')); ?>

  <?php echo e(Html::script('global/vendor/screenfull/screenfull.js')); ?>

  <?php echo e(Html::script('global/vendor/slidepanel/jquery-slidePanel.js')); ?>

  <?php echo e(Html::script('global/vendor/skycons/skycons.js')); ?>

  <?php echo e(Html::script('global/vendor/aspieprogress/jquery-asPieProgress.min.js')); ?>

  <?php echo e(Html::script('global/vendor/jvectormap/jquery.jvectormap.min.js')); ?>

  <?php echo e(Html::script('global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js')); ?>

  <?php echo e(Html::script('global/vendor/matchheight/jquery.matchHeight-min.js')); ?>

  <!-- Scripts -->
   <?php echo e(Html::script('global/js/core.js')); ?>

   <?php echo e(Html::script('assets/js/site.js')); ?>

   <?php echo e(Html::script('assets/js/sections/menu.js')); ?>

   <?php echo e(Html::script('assets/js/sections/menubar.js')); ?>

   <?php echo e(Html::script('assets/js/sections/gridmenu.js')); ?>

   <?php echo e(Html::script('assets/js/sections/sidebar.js')); ?>

   <?php echo e(Html::script('global/js/configs/config-colors.js')); ?>

   <?php echo e(Html::script('assets/js/configs/config-tour.js')); ?>

   <?php echo e(Html::script('global/js/components/asscrollable.js')); ?>

   <?php echo e(Html::script('global/js/components/animsition.js')); ?>

   <?php echo e(Html::script('global/js/components/slidepanel.js')); ?>

   <script src="<?php echo e(URL::to('/')); ?>/global/vendor/filament-tablesaw/tablesaw.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/filament-tablesaw/tablesaw-init.js"></script>

    <script src="<?php echo e(URL::to('/')); ?>/global/vendor/ladda-bootstrap/spin.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/ladda-bootstrap/ladda.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/js/components/ladda-bootstrap.js"></script>

  <?php echo e(Html::script('global/js/components/switchery.js')); ?>

   <?php echo e(Html::script('global/js/components/matchheight.js')); ?>

   <?php echo e(Html::script('global/js/components/jvectormap.js')); ?>

    <script src="<?php echo e(URL::to('/')); ?>/global/vendor/jquery-ui/jquery-ui.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-tmpl/tmpl.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-load-image/load-image.all.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-file-upload/jquery.fileupload.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-file-upload/jquery.fileupload-process.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-file-upload/jquery.fileupload-image.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-file-upload/jquery.fileupload-audio.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-file-upload/jquery.fileupload-video.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-file-upload/jquery.fileupload-validate.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/blueimp-file-upload/jquery.fileupload-ui.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/dropify/dropify.min.js"></script>

	<script src="<?php echo e(URL::to('/')); ?>/global/vendor/asprogress/jquery-asProgress.js"></script>
   <script src="<?php echo e(URL::to('/')); ?>/global/vendor/asrange/jquery-asRange.min.js"></script>
   <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/uikit/icon.js"></script>
   <script src="<?php echo e(URL::to('assets/js')); ?>/bootstrap-fileupload.min.js"></script>

   <script src="<?php echo e(URL::to('/')); ?>/global/vendor/owl-carousel/owl.carousel.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/slick-carousel/slick.js"></script>
    <!-- New for mail box -->
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/select2/select2.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
 <script src="<?php echo e(URL::to('/')); ?>/global/vendor/webui-popover/jquery.webui-popover.min.js"></script>


  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/isotope/isotope.pkgd.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/filterable.js"></script>
  <!--<script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/pages/gallery.js"></script>-->

  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/toolbar/jquery.toolbar.min.js"></script>
   <script src="<?php echo e(URL::to('/')); ?>/global/js/components/webui-popover.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/toolbar.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/uikit/tooltip-popover.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/magnific-popup/jquery.magnific-popup.js"></script>
 <script src="<?php echo e(URL::to('/')); ?>/global/vendor/raty/jquery.raty.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/toastr/toastr.js"></script>
   <script src="<?php echo e(URL::to('/')); ?>/global/vendor/html5sortable/html.sortable.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/nestable/jquery.nestable.js"></script>


  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/bootbox/bootbox.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/select2.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/plugins/action-btn.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/plugins/selectable.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/selectable.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/material.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/bootbox.js"></script>

 <script src="<?php echo e(URL::to('/')); ?>/assets/js/app.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/apps/mailbox.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/input-group-file.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/asprogress.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/uikit/progress-bars.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/pages/faq.js"></script>

  <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/advanced/animation.js"></script>
   <script src="<?php echo e(URL::to('/')); ?>/global/js/components/magnific-popup.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/advanced/lightbox.js"></script>
 <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/advanced/scrollable.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/raty.js"></script>
   <script src="<?php echo e(URL::to('/')); ?>/global/js/components/toastr.js"></script>
    <script src="<?php echo e(URL::to('/')); ?>/global/js/components/html5sortable.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/nestable.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/tasklist.js"></script>
    <script src="<?php echo e(URL::to('/')); ?>/global/js/components/bootstrap-sweetalert.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/advanced/bootbox-sweetalert.js"></script>

 <script src="<?php echo e(URL::to('/')); ?>/global/vendor/jquery-wizard/jquery-wizard.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/vendor/formvalidation/formValidation.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/vendor/formvalidation/framework/bootstrap.js"></script>
   <script src="<?php echo e(URL::to('/')); ?>/global/js/components/jquery-wizard.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/forms/wizard.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/forms/validation.js"></script>
 <script src="<?php echo e(URL::to('/')); ?>/global/vendor/formatter-js/jquery.formatter.js"></script>
  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/formatter-js.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/vendor/cropper/cropper.min.js"></script>
 <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/forms/image-cropping.js"></script>


  <script src="<?php echo e(URL::to('/')); ?>/global/js/components/dropify.js"></script>
   <script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/forms/uploads.js"></script>


   <script type="text/javascript">
	/* tab storage */
	$(function() {
		// for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			// save the latest tab; use cookies if you like 'em better:
			localStorage.setItem('lastTab', $(this).attr('href'));
		});

		// go to the latest tab, if it exists:
		var lastTab = localStorage.getItem('lastTab');
		if (lastTab) {
			$('[href="' + lastTab + '"]').tab('show');
		}
	});

	/* Activity info */
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();
	});
	</script>
		
	<!-- modals -->	
	<div class="modal fade" id="modal" aria-hidden="true" aria-labelledby="modal" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-sidebar modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<a class="btn btn-sm btn-white" data-dismiss="modal" href="javascript:void(0)"> <?php echo e(trans('app.close')); ?> </a>
				</div>
			</div>
		</div>
	</div>
	<!-- end modals -->	

		
  <div class="modal fade modal-3d-flip-vertical exampleNiftyFlipVertical" id="exampleNiftyFlipVertical" aria-hidden="true"
  aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		  </button>
		  <h4 class="modal-title"><?php echo e(trans('app.delete_confirm')); ?></h4>
		</div>
		<div class="modal-body">
		  <p> <?php echo e(trans('app.are_you_sure_delete_user')); ?></p>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default margin-0" data-dismiss="modal"><?php echo e(trans('app.close')); ?></button>
		  <a class="btn btn-danger btn-ok"><?php echo e(trans('app.yes_delete_him')); ?></a>
		</div>
	  </div>
	</div>
  </div>
  <!-- End Modal -->
		
		<!-- switch business -->
		
		<div class="modal fade modal-fill-in" id="fillIn" aria-hidden="false" aria-labelledby="fillIn" role="dialog" tabindex="-1" style="display: none;">
			<div class="modal-dialog">
					<div class="modal-content">
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
						</button>
						<h1 class="modal-title" id="fillInTitle"><?php echo e(_('Cambiar comercio:')); ?></h1>
				</div>
				<div class="modal-body">
					<?php if(count($business_all)): ?>
						
						<?php $__currentLoopData = $business_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<p>
							<a href="<?php echo e(route('business.switch', [$ba->business_id])); ?>">
							<button class="btn btn-link btn-md"><i class="icon fa-angle-right" aria-hidden="true"></i> <?php echo e(strtoupper($ba->business_name)); ?>

							<i class="icon fa-external-link" aria-hidden="true"></i></button>
							</button>
							</a>
							</p>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							
					<?php endif; ?>
				</div>
					</div>
			</div>
	 </div>
			
			<!-- end switch business -->
		
  <script>
  
		$('.exampleNiftyFlipVertical').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	
	/* for loading button */
	$('.loadingclick').on('click', function() {
		var $this = $(this);
	  $this.button('loading');
		setTimeout(function() {
		   $this.button('reset');
	   }, 22000);
	});
  $("[rel='tooltip']").tooltip();

/* for message timeout */
$(document).ready(function(){
	 $(".alertDismissible").fadeTo(3000, 800).slideUp(1000, function(){
       $(".alertDismissible").slideUp(1000);
	   });
});
</script>
<script src="<?php echo e(URL::to('/')); ?>/global/js/components/owl-carousel.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/uikit/carousel.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/js/components/table.js"></script>

<script src="<?php echo e(URL::to('/')); ?>/global/vendor/editable-table/mindmup-editabletable.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/vendor/editable-table/numeric-input-example.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/js/components/editable-table.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/tables/editable.js"></script>

<script src="<?php echo e(URL::to('/')); ?>/global/vendor/jsgrid/jsgrid.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/tables/jsgrid-db.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/tables/jsgrid.js"></script>

 <!----------- for datepicker ------------->
<script src="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/vendor/jt-timepicker/jquery.timepicker.min.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/vendor/datepair-js/datepair.min.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/vendor/datepair-js/jquery.datepair.min.js"></script>

<script src="<?php echo e(URL::to('/')); ?>/global/js/components/bootstrap-datepicker.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/js/components/jt-timepicker.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/global/js/components/datepair-js.js"></script>
<script src="<?php echo e(URL::to('/')); ?>/js/functions.js"></script>
	
<?php echo $__env->yieldContent('bottom.scripts'); ?>
<!--<script src="<?php echo e(URL::to('/')); ?>/assets/examples/js/forms/advanced.js"></script> -->

<?php if(App::environment('production')): ?>
<script>
$(window).load(function() {
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108079654-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108079654-1');
</script>
	$(".loadersjew").fadeOut("slow");;
});
</script>
<?php endif; ?>

</body>
</html>

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

app('debugbar')->disable();

/* home controller */

// Route::post('/ajax','CalendarController@ajax');
Route::post('/get_calendar','CalendarController@ajax');
Route::get('newsletterlist', 'SubscribersController@list');
Route::get('events', 'EventController@index');
Route::get('/addevent', 'EventController@addevent');
Route::get('/eventlist', 'EventController@eventlist');
Route::post('/eventstore', 'EventController@store');
Route::get('/eventdestroy/{id}', "EventController@destroy");
Route::post('newsletter', 'SubscribersController@newsletter');
Route::pattern('transaction_id', '[0-9]+');
Route::post('/productstore/{id}', 'ProductsController@store');
Route::get('/product/{id}', 'ProductsController@index');
Route::get('/addproduct/{id}', 'ProductsController@add');
Route::get('/addcategory/{id}', 'CategoryController@add');
Route::get('/productdestroy/{id}', "ProductsController@destroy");
Route::get('/productedit/{id1}/{id2}', "ProductsController@edit");
Route::post('/productupdate/{id2}', 'ProductsController@update');
Route::post('/categorystore/{id}', 'CategoryController@store');
Route::get('/categorydestroy/{id}', "CategoryController@destroy");
Route::get('/categoryedit/{id}', "CategoryController@edit");
Route::post('/categoryupdate/{id}', 'CategoryController@update');
Route::get('/frontspecial','FrontController@get_special');
// Route::get('/', 'HomeController@index');
// Route::get('/home', 'HomeController@index');

Route::get('/','FrontController@index');
// Route::post('/frontlog','FrontController@frontlogin');
// Route::get('/login', 'DashboardController@index');

Route::get('/frontlogin', 'FrontController@frontlogin');

Route::get('/home', 'DashboardController@index');
Route::get('submitted', ['as' => 'couponlist', 'uses' => 'CouponController@index']);
Route::get('/master', "master@index");
Route::get('/registration', "UserController@registration");
Route::get('/userlist', "UserController@index");
Route::post('/store', "UserController@store");
Route::get('/edit/{id}', "UserController@edit");
Route::get('/show/{id}', "UserController@show");
Route::post('/update/{id}', "UserController@update");
Route::get('/destroy/{id}', "UserController@destroy");
Route::post('/upload/{id}', "UserController@upload");
Route::post('/authentication/{id}', "UserController@authentication");
Route::post('/importcsv', "UserController@importcsv");
Route::get('/import', "UserController@importuser");
Route::get('/profile', "UserController@profile");
Route::get('/profileEdit', "UserController@profileEdit");
Route::get('/export', "UserController@xlsexport");
Route::get('/pdf', "UserController@pdfexport");
Route::get('/usersprint', "UserController@userlistprint");

/*Transactions*/
Route::get('/transactions', 'TransactionsController@index');
Route::get('/transactions_detalles/{id}', 'TransactionsController@show');

/*Register*/
Route::get('/register_user', 'RegisterController@index');
Route::get('/steps/{id}', 'RegisterController@steps');
Route::post('/steps', 'RegisterController@steps');
Route::post('/steps/{id}', 'RegisterController@steps');
Route::post('/step2', 'RegisterController@step2');
Route::get('/step2/{id}', 'RegisterController@step2_continue');
Route::post('/step2/{id}', 'RegisterController@step2');
Route::post('/step3/{id}', 'RegisterController@step3');
Route::get('/step3/{id}', 'RegisterController@step3');
Route::get('/step4/{id}', 'RegisterController@step4');
Route::post('/step4/{id}', 'RegisterController@step4');
Route::get('/step5/{id}', 'RegisterController@step5');
Route::post('/step5/{id}', 'RegisterController@step5');
Route::get('/step6/{id}', 'RegisterController@step6');
Route::post('/step6/{id}', 'RegisterController@step6');

/*Force to create a business*/
/*Route::get('/change_business', 'RegisterController@force_business');
Route::get('/dashboard_business', 'RegisterController@force_business');
Route::get('/transactions_list', 'RegisterController@force_business');
Route::get('/business_products_detail', 'RegisterController@force_business');
Route::get('/custom_form_payment', 'RegisterController@force_business');
*/


/* send email */

Route::get('/sendemail', "UserController@sendemail");
Route::post('/user/sendemail', "UserController@sendemail");

/* username and email exists ajax check */
Route::post('/uniqueuser', "UserController@uniqueuser");
Route::post('/uniqueemail', "UserController@uniqueemail");
Route::post('/uniqueuser_edit', "UserController@uniqueuser_edit");
Route::post('/uniqueemail_edit', "UserController@uniqueemail_edit");

/* Social Login facebook,google,twitter */
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');


// Route::get('home', array('as' => 'home', 'uses' => function(){
  // return view('home');
// }));

/* Language */
Route::get('/language', "LanguageController@index");
Route::post('LanguageController/store', ['as' => 'languages.store', 'uses' => 'LanguageController@store']);
Route::get('LanguageController/edit/{id}', "LanguageController@edit");
Route::post('LanguageController/update/{id}', "LanguageController@update");
Route::get('LanguageController/chooser_language/{id}',"LanguageController@chooser_language" );
Route::get('/LanguageController/destroy/{id}/{lan}', "LanguageController@destroy");

/* roles and Permission */
Route::get('/roles', "RoleController@index");
Route::get('/RoleController/edit/{id}', "RoleController@edit");
Route::post('roles', ['as' => 'roles.store', 'uses' => 'RoleController@store']);
Route::post('RoleController/update/{id}','RoleController@update');
Route::get('/RoleController/destroy/{id}', "RoleController@destroy");

//Route::post('/roles', "RoleController@index");
Route::get('/permissions', "PermissionController@index");
Route::get('/PermissionController/edit/{id}', "PermissionController@edit");
Route::post('permissions', ['as' => 'permission.store','uses' => 'PermissionController@store']);
Route::post('PermissionController/update/{id}','PermissionController@update');
Route::post('permissions/save', ['as' => 'permission.save', 'uses' => 'PermissionController@saveRolePermissions']);
Route::get('/PermissionController/destroy/{id}', "PermissionController@destroy");

/* User Activity activity */
Route::get('/activity/', "ActivityController@index");
Route::get('/activity/user/{id}', "ActivityController@activity_user");

/* Setting */
Route::get('/settings/', "SettingController@index");
Route::post('/settings/', "SettingController@store");
Route::post('/SettingController/upload/{id}', "SettingController@upload");
Route::post('/SettingController/auth_registration', "SettingController@auth_registration");

Route::get('/SettingController/sidebar', "SettingController@sidebar");


Route::get('/clear', "Controller@clear");
/* QPayPro */

Route::get('/business/{business_id}/transactions/', ['as' => 'business.transactions', 'uses' => 'businessController@transactions']);

Route::get('/transaction/{transaction_id}', ['as' => 'transactions', 'uses' => 'TransactionsController@view']);

/* Message */
Route::get('/message/', "MessageController@index");
Route::get('/SendMessage/', "MessageController@sendmail");
Route::get('/sendDetails/{id}', "MessageController@sendDetails");
Route::get('/inboxDetails/{id}/{replayidid}', "MessageController@inboxDetails");
Route::post('MessageController/save/', "MessageController@store");
Route::post('MessageController/destroy/', "MessageController@destroy");


Route::resource('permission', 'PermissionController');

/* Basic Elements */

Route::get('/buttons', 'ElementsController@buttons');
Route::get('/dropdowns', 'ElementsController@dropdowns');
Route::get('/icons', 'ElementsController@icons');
Route::get('/ElementsController/brandIcons', 'ElementsController@brandIcons');
Route::get('/ElementsController/fontAwesome', 'ElementsController@fontAwesome');
Route::get('/ElementsController/strokeIcon', 'ElementsController@strokeIcon');
Route::get('/ElementsController/glyphicons', 'ElementsController@glyphicons');
Route::get('/ElementsController/ionicons', 'ElementsController@ionicons');
Route::get('/ElementsController/materialDesign', 'ElementsController@materialDesign');
Route::get('/ElementsController/mfglabs', 'ElementsController@mfglabs');
Route::get('/ElementsController/octicons', 'ElementsController@octicons');
Route::get('/ElementsController/openIconic', 'ElementsController@openIconic');
Route::get('/ElementsController/themify', 'ElementsController@themify');
Route::get('/ElementsController/weatherIcons', 'ElementsController@weatherIcons');
Route::get('/ElementsController/webIcons', 'ElementsController@webIcons');
Route::get('/tooltip', 'ElementsController@tooltip');
Route::get('/modals', 'ElementsController@modals');
Route::get('/tabsAccordions', 'ElementsController@tabsAccordions');
Route::get('/imagesDes', 'ElementsController@imagesDes');
Route::get('/badgesLabels', 'ElementsController@badgesLabels');
Route::get('/progressBars', 'ElementsController@progressBars');
Route::get('/carousel', 'ElementsController@carousel');
Route::get('/carousel', 'ElementsController@carousel');
Route::get('/typography', 'ElementsController@typography');
Route::get('/colors', 'ElementsController@colors');
Route::get('/animation', 'ElementsController@animation');
Route::get('/lightbox', 'ElementsController@lightbox');
Route::get('/scrollable', 'ElementsController@scrollable');
Route::get('/rating', 'ElementsController@rating');
Route::get('/toastr', 'ElementsController@toastr');
Route::get('/sortableNestable', 'ElementsController@sortableNestable');
Route::get('/bootboxSweetalert', 'ElementsController@bootboxSweetalert');
Route::get('/alerts', 'ElementsController@alerts');
Route::get('/ribbon', 'ElementsController@ribbon');
Route::get('/pricingTables', 'ElementsController@pricingTables');
Route::get('/overlay', 'ElementsController@overlay');
Route::get('/cover', 'ElementsController@cover');
Route::get('/timeline', 'ElementsController@timeline');
Route::get('/step', 'ElementsController@step');
Route::get('/chat', 'ElementsController@chat');
Route::get('/social', 'ElementsController@social');
Route::get('/general', 'ElementsController@general');
Route::get('/material', 'ElementsController@material');
Route::get('/layouts', 'ElementsController@layouts');
Route::get('/wizard', 'ElementsController@wizard');
Route::get('/validation', 'ElementsController@validation');
Route::get('/masks', 'ElementsController@masks');
Route::get('/imageCropping', 'ElementsController@imageCropping');
Route::get('/fileUploads', 'ElementsController@fileUploads');
Route::get('/basicTables', 'ElementsController@basicTables');
Route::get('/responsiveTable', 'ElementsController@responsiveTable');
Route::get('/editableTable', 'ElementsController@editableTable');
Route::get('/jsgrid', 'ElementsController@jsgrid');
Route::get('/faq', 'ElementsController@faq');
Route::get('/gallery', 'ElementsController@gallery');
Route::get('/searchResult', 'ElementsController@searchResult');
Route::get('/invoice', 'ElementsController@invoice');
Route::get('/profiledemo', 'ElementsController@profiledemo');

/* Authentication routes...*/

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


/* Dashboard */
Route::get('/dashboard', ["as" => "dashboard.index", "uses" => "DashboardController@index"]);
Route::get('/business/switch/{business_id}', ['as' => 'business.switch', 'uses' => 'DashboardController@switchBusiness']);

Route::get('/maintenance/down', 'Controller@maintenance_down');
Route::get('/maintenance/up', 'Controller@maintenance_up');

Route::get('/error400', 'ElementsController@error400');
Route::get('/error500', 'ElementsController@error500');
//Route::get('/logout', 'DashboardController@index');

Route::auth();

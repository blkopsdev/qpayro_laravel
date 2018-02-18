<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use DB;
use App\Message;
use Auth;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
		$this->setting();
		$this->language_name();
    }

	public function setting(){
		 $datasetting = DB::table('settings')->get();
		View::composer('layouts.template', function($view) use($datasetting) {
		$view->with('settingdata',$datasetting);
		});
	}

	public function language_name() {
		 $datalanguages = DB::table('languages')->get();
		View::composer('layouts.template', function($view) use($datalanguages) {
		$view->with('language',$datalanguages);
		});
	 }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
		$this->app->alias('bugsnag.multi', \Illuminate\Contracts\Logging\Log::class);
		$this->app->alias('bugsnag.multi', \Psr\Log\LoggerInterface::class);
		
    }
}

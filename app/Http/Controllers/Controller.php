<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;
use View;
use App;
use Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct(){
		
		$this->setLang();
		
		
		Session::forget('errors');
		Session::save();
		
		/*\Artisan::call('view:clear');
				\Artisan::call('cache:clear');
				\Artisan::call('config:clear');*/
		
		/*\Debugbar::enable();*/
        //\Artisan::call('route:clear');
    }
	
	private function setLang(){
		$settingdata = DB::table('settings')->get();
		//dd($settingdata);
		
		View::share(compact('settingdata'));
	  
		$language = Session::get('locale');
		
        if ($language) {
            App::setLocale($language);
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.fallback_locale'));
        }
	}
	

	/*public function maintenance_down(){
		\Artisan::call('down');
		echo 'down';
	}
	
	public function maintenance_up(){
		\Artisan::call('up');
		echo 'up';
	}
	*/
	public function clear(){
		
		if(Auth::check()){
			if (Auth::user()->hasRole('Admin')) {
				\Artisan::call('view:clear');
				\Artisan::call('cache:clear');
				\Artisan::call('config:clear');
				
				echo 'cleared';
			}
		}
	}
}

<?php 

// app/Http/Middleware/Language.php

namespace App\Http\Middleware;

use Closure;
use DB;
use View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
		$settingdata = DB::table('settings')->get();
		
		View::share(compact('settingdata'));
	  
		$language = Session::get('locale');
		
        if ($language) {
            App::setLocale($language);
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.fallback_locale'));
        }
		
		Session::save();
		
		$response = $next($request);
		//echo 'labg';
		//dd(Session::all());
		
        return $next($request);
    }
}
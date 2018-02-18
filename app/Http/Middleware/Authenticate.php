<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
		
		if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
		
		/*$business = DB::table('business')->where('user_id', '=', Auth::id())->first();
      if($business === null){
        return view('register_user.list_business', compact('business'));
      }
      session()->put(['business_actual' => $business->business_id]);
      $business = DB::table('business')->where('user_id', '=', Auth::id())->get();
	  //dd($business);
      session()->put('business_details', $business);*/
		
        return $next($request);
    }
}

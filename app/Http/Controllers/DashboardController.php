<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepository;
use App\Http\Requests;
use App\User;
use App\Role;
use App\role_user;
use App\Transactions;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Foo;
use View;
use Charts;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{

	  /**
     * Display a listing of the __construct.
     *
     * @return \Illuminate\Http\Response
     */
	 private $activities;
	 //protected $foo;
	 
	public function __construct()
	{
		parent::__construct();
       $this->middleware('auth');

	  //$this->foo = $foo;
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function index(Request $request){
		
		if (Auth::user()->hasRole('Admin') or Auth::user()->hasRole('User')) {
			$totaluser = DB::table('users')->count();
			$newuser = DB::table('users')->where('created_at', '>=', Carbon::now()->startOfMonth())->count();
			$userdata1 = User::all();
			$todayvisitor = count(DB::table('user_activity')->groupBy('ip_address')->whereDate('created_at', '=', date('Y-m-d'))->get());
			$monthvisitor = count(DB::table('user_activity')->select([DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS `date`"),])->groupBy('ip_address')->groupBy('date')->where('created_at', '>=', Carbon::now()->startOfMonth())->get());
			$recentuser = DB::table('users')->orderBy('id','DES')->limit(5)->get();
			$graphregister = DB::table('users')->select([DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS `date`,DATE_FORMAT(created_at, '%m') AS `month`"),
			DB::raw('COUNT(id) AS count'),])->groupBy('date')->orderBy('date', 'ASC')->get();
			return view('dashboard.dashboard_page',compact('todayvisitor','monthvisitor','totaluser','newuser','recentuser','recentactivity','graphregister','userdata1'));
		}  else {
				return view('register_user.register_user');
				//return redirect('register_user');
			}
			
		 		
		}

	

	 private function ____defaultDashboard(){
		
		 
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }





}

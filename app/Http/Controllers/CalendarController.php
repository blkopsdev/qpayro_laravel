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
use Illuminate\Http\RedirectResponse;
use App\products;
use App\category;
use App\Event;
use Calendar;
class CalendarController extends Controller
{

	  /**
     * Display a listing of the __construct.
     *
     * @return \Illuminate\Http\Response
     */
	 private $activities;
	 //protected $foo;
	 
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function index(Request $request){
		return view('front');
		//return redirect('register_user');		
		 		
	}
	public function ajax(Request $request){
      
      
		$request->all(); 
		$category=$request->name;      
       $events = [];
       $data=Event::all()->where('category',$category);

       if($data->count()){
          foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->title,
                true,
                new \DateTime($value->start_date),
                new \DateTime($value->end_date.' +1 day')
            );
          }
       }
       
      // $calendars=[];
      //$calendars[] = Calendar::addEvents($events1)->setId('1');
      //$calendars[] = Calendar::addEvents($events2)->setId('2'); 
      //$calendars[] = Calendar::addEvents($events3)->setId('3');
      //$calendars[] = Calendar::addEvents($events4)->setId('4'); 
      $calendar = Calendar::addEvents($events);
		 	//echo json_encode($data);
		     return view('frontspecial')->with('calendar',$calendar);
		     //return view('ajax.index')->with('products',$products);

	}


}

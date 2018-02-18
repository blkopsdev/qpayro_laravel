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
use App\subscribers;
class FrontController extends Controller
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
       
      $allproduct=products::all();


		return view('front',compact('allproduct'));
		//return redirect('register_user');		
		 		
	}
    public function get_special(Request $request){

        $id = $request->session()->get('login');
        $category = $request['cat'];
        $newsletterlist=subscribers::all();

        $request->all();

        $events1 = [];$events2 = [];$events3 = [];$events4 = [];
        $data1=Event::all()->where('category',"sport");
        $data2=Event::all()->where('category',"fashion");
        $data3=Event::all()->where('category',"around me");
        $data4=Event::all()->where('category',"jerusalem");

        if($data1->count()){
            foreach ($data1 as $key => $value) {
                $events1[] = Calendar::event(
                    $value->title,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.' +1 day')
                );
            }
        }
        if($data2->count()){
            foreach ($data2 as $key => $value) {
                $events2[] = Calendar::event($value->title,true,
                new \DateTime($value->start_date),
                new \DateTime($value->end_date.' +1 day')
            );
          }
       }
       if($data3->count()){
          foreach ($data3 as $key => $value) {
            $events3[] = Calendar::event(
                $value->title,
                true,
                new \DateTime($value->start_date),
                new \DateTime($value->end_date.' +1 day')
            );
          }
       }
       if($data4->count()){
          foreach ($data4 as $key => $value) {
            $events4[] = Calendar::event(
                $value->title,
                true,
                new \DateTime($value->start_date),
                new \DateTime($value->end_date.' +1 day')
            );
          }
        }
        $calendar = Calendar::addEvents1($events1)->setOptions(['defaultview'=>'agendaWeek']);
        $calendar = Calendar::addEvents2($events2); 
        $calendar = Calendar::addEvents3($events3);
        $calendar = Calendar::addEvents4($events4); 

        if($category=="all"){
            $products=products::where('user_id','=',$id)->get();   
        }
        else{
            $products= products::where('user_id','=',$id)->where('category_id','=',$category)->get();   
        }
        $certain_cate = $category;
        $category=category::where('user_id','=',$id)->get();
        $data1 = array($id,$products, $category);
        $data2 = array($id,$products, $category);
        $data3 = array($id,$products, $category);
        $data4 = array($id,$products, $category);
            //echo json_encode($data);

        return view('frontspecial',compact('products','newsletterlist','category','calendar','calendar1','calendar2','calendar3','calendar4','certain_cate'));

    }
	public function frontlogin(Request $request){
        
        $email = $request->input("email");
        $password = $request->input("password");
        $check = DB::table('users')->where('email','=',$email)->get()->first();
        if($check!=null){
            $id=$check->id;
            $request->session()->put('login',$id);
            return redirect("frontspecial?cat=all");
        }
        else{
            return redirect('');
        }
	}


}

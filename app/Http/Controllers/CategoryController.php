<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\products;
use App\User;
use Mail;
use DB;
use Session;
use Excel;
use PDF;
use Auth;
use App\Role;
use App\Message;
use App\Foo;
use View;
use Route;
use App\category;

class CategoryController extends Controller
{
   protected $foo;
  public function __construct(Foo $foo)
  {
    parent::__construct();
    $this->middleware('auth');
    $this->foo = $foo;
    $this->middleware('permission:manteinance.manteinance');
  }

     public function index(Request $request,$id){
	   $searchname = $request->input('search');
	   $productdata = products::where('user_id','=',$id)
			->whereRaw("'name' like '%{$searchname}%'")
			->orderBy('id', 'DESC')
         ->paginate(20);
         $userdata1=User::all();
         $categorydata=category::all()->where('user_id',$id);
        
        return view('products.product_list',compact('productdata','languages','userdata1','id','categorydata'));

    }

   public function add($id){
     $userdata1=User::all();
    
     return view('products.category_add',compact('languages','userdata1','id'));

   }
     
public function edit($id){
     $categorydata = category::findOrFail($id);
      $userdata1=User::all();	
       return view('products.edit_category',compact('categorydata','userdata1','id'));
    }
   
    
    public function create()
    {
        //
    }


    public function store(Request $request,$id)
    {      
           $request->all();
        $input = new category;
        $input['user_id'] = $id; 
        $input['name'] = $request->input('category_name');     
       $input->save();
        return redirect::back()->with('msg_success', trans('app.insert_success_message'));
    }


     public function update(Request $request, $id)
    {   $data = category::findOrFail($id);
    	
         $input['name'] = $request->input('category_name');
        $data->update($input);
        return redirect::back()->with('msg_success', trans('app.insert_success_message'));
    }


    public function destroy($id)
    {
	  
	 
	  $data = category::findOrFail($id);
	  if ($data){
		 $data->delete();
		return Redirect::back()->with('msg_delete', trans('app.delete_success_message'));
		}
    else{
		return Redirect::back()->with('msg_delete', "Loged user don't delete able!");
	
 }

}
}

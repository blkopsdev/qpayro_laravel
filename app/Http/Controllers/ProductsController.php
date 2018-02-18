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
use \Input as Input;

class ProductsController extends Controller
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
     $categorydata=category::all()->where('user_id',$id);
     return view('products.product_add',compact('languages','userdata1','id','categorydata'));

   }
     
public function edit($id1,$id2){
     $productdata = products::findOrFail($id2);
        $userdata1=User::all();
	 $categorydata=category::all()->where('user_id',$id1);

       return view('products.edit_product',compact('productdata','userdata1','categorydata','id2','id1'));
    }
   
    
    public function create()
    {
        //
    }


    public function store(Request $request,$id)
    {      
        $request->all();
		$image = $request->file('image');           
	    $image->move('images', $image->getClientOriginalName());
        $video = $request->file('video');

        $video->move('videos', $video->getClientOriginalName());
			// $file->move('uploads', $file->getClientOriginalName());
        $input = new products;
        $input['name'] = $request->input('product_name');
        $input['user_id'] = $id;
        $input['category_id'] = $request->input('category_id');
        $input['image'] = $image->getClientOriginalName();
        $input['video'] = $video->getClientOriginalName();
        $input['text'] = $request->input('description');
        
        $input->save();
        return redirect::back()->with('msg_success', trans('app.insert_success_message'));
    }


    public function update(Request $request, $id)
    {   
        $data = products::findOrFail($id);	       

        $image = $request->file('image');  
            
        if($request->file('image')!=null){
            $image->move('images', $image->getClientOriginalName());
            $input['image'] = $image->getClientOriginalName();
        }

        $video = $request->file('video');
        if($request->file('video')!=null){
            $video->move('videos', $video->getClientOriginalName());            
            $input['video'] = $video->getClientOriginalName();   
        }        

        if($data){
            $input['name'] = $request->input('product_name');
            $input['category_id'] = $request->input('category_id');            
            $input['text'] = $request->input('description');
            $data->update($input);
        }
        return redirect::back()->with('msg_success', trans('app.insert_success_message'));    
    }

    public function destroy($id)
    {
	  
	 
	  $data = products::findOrFail($id);
	  if ($data){
		 $data->delete();
		return Redirect::back()->with('msg_delete', trans('app.delete_success_message'));
		}
    else{
		return Redirect::back()->with('msg_delete', "Loged user don't delete able!");
	
 }

}

}

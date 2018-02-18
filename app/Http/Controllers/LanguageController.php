<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Languages;
use File;
use Storage;
use App\user;
use DB;
use Session;
use Validator;
use App;
use View;
use Route;
use App\Foo;


class languageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   protected $foo;
	public function __construct(Foo $foo)
	{
		parent::__construct();
	
	   $this->foo = $foo;
		

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $userdata1=User::all();
		 $language = DB::table('languages')->get();
        return view('language.language',compact('userdata1','language'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$input = $request->all();
		$rules = array('flag_image' => 'required | mimes:jpeg,jpg,png,PNG,JPEG,JPG | max:3024');
		$validator = Validator::make($input, $rules);
		if ($validator->fails()) {
            return Redirect::back()
                ->with('msg_delete', "Please choose file jpeg,jpg,png & maximum size 2mb!");
        }
		$flag_image = $request->file('flag_image');
		if(!empty($flag_image)){
		 $flag_image  = time() . '.' . $flag_image->getClientOriginalExtension();
		 $request->file('flag_image')->move( base_path() . '/public/assets/flags/', $flag_image );

		}
		 $foldername = $request->input('foldername');
		 $input['flag_image'] = $flag_image;
		 $countdata = DB::table('languages')->where('foldername', $foldername)->get();
		  if(count($countdata) > 0){
			    return Redirect::back()->with('msg_delete', "Language already created!");
		  }else{
		  if(!empty($foldername)){
			  Languages::create($input);
			  $folder = mkdir(base_path() .'/resources/lang/'.$foldername, 0777, true);
			  File::copy(base_path() .'/resources/lang/en/app.php', base_path() .'/resources/lang/'.$foldername.'/app.php');

			/*for user activity */
			$description = array('description'=>'language Added');
			$this->foo->users_activity($description);

		  return Redirect::back()->with('msg_success', "Language create success!");
		}
	}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
	/**
     * Display the specified chooser_language.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function chooser_language(Request $request,$id)
    {
		$language = DB::table('languages')->where('foldername', $id)->first();
		if(empty($language)){
            
            $request->Session()->put('locale_image',$language->flag_image);
            $request->Session()->put('locale', $id);
            // print_r(session::get('locale'));
            // die();
          // App::setLocale('he');
		}
        else{
            $request->Session()->forget('locale');
            $request->Session()->forget('locale_image');
            session::save();
            $request->Session()->put('locale_image',$language->flag_image);
            $request->Session()->put('locale', $id);

        }
        //$locale = Session::get('locale');
        //return view('',compact('locale'));
		return Redirect::back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    $userdata1=User::all();
		 $language_data = File::getRequire(base_path()."/resources/lang/{$id}/app.php");
		  $foldername = $id;
		if($id == 'en'){
			return Redirect::back()->with('msg_delete',"This language not editable");
		}
        return view('language.language_edit',compact('language_data','foldername','userdata1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    $data =  $request->all();
		$foldername = $request->input('foldername');
		$languagekey = $request->input('language_key');
		$languageval = $request->input('language_value');
		foreach($languagekey as $key=>$keyvalue){
			$nd[] = '"'.$keyvalue.'"'.' =>'.'"'.$languageval[$key].'",';

		}
		 File::put( base_path() ."/resources/lang/{$foldername}/app.php","<?php return [ ".implode("\n",$nd)." ];");
        $description = array('description'=>'Language Updated.');
	    $this->foo->users_activity($description);
	return Redirect::back()->with('msg_update', trans('app.update_success_message'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id,$lan)
    {
		if(!empty($id) && !empty($lan) && ($lan != 'en')){

		 $data = Languages::findOrFail($id);
		 if(!empty($data)){
			 $data->delete();
			 File::deleteDirectory(base_path() ."/resources/lang/{$lan}");
			 /*for user activity */
			$description = array('description'=>'Language Delete.');
			$this->foo->users_activity($description);
			return Redirect::back()->with('msg_delete', trans('app.delete_success_message'));
		 }
		}

    }

}

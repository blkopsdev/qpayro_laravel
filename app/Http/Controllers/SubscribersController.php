<?php

namespace App\Http\Controllers;
use App\subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
class SubscribersController extends Controller
{
    //The method to show the form to add a new feed
public function getIndex() {
//We load a view directly and return it to be served
return View('subscribe_form');
}

public function newsletter(Request $request){
   $input = new subscribers;
    $input['email'] = $request->input('newsletter'); 
  $input->save();
        return redirect::back()->with('msg_success', trans('app.insert_success_message'));

}



public function list(Request $request){
$userdata1=User::all();
$data=subscribers::all();
return view('newsletterlist',compact('data','userdata1'));

}

public function postSubmit() {

  //we check if it's really an AJAX request
  if(Request::ajax()) {
    
    $validation = Validator::make(Input::all(), array(
      //email field should be required, should be in an email//format, and should be unique
      'email' => 'required|email|unique:subscribers,email'
    )
    );

    if($validation->fails()) {
      return $validation->errors()->first();
    } else {

      $create = Subscribers::create(array(
        'email' => Input::get('email')
      ));

      //If successful, we will be returning the '1' so the form//understands it's successful
      //or if we encountered an unsuccessful creation attempt,return its info
      return $create?'1':'We could not save your address to oursystem, please try again later';
    }

  } else {
    return Redirect::to('subscribers');
  }
}



}

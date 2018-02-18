<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Calendar;
use App\Event;
use App\User;
use Illuminate\Support\Facades\Redirect;
class EventController extends Controller
{
    
    public function index()
    {
       $events = [];
       $data = Event::all();
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
      $calendar = Calendar::addEvents($events); 
      return view('mycalendar', compact('calendar'));
    }

    public function addevent(){

        $userdata1=User::all();
    
     return view('addevent',compact('languages','userdata1'));

    }

     public function store(Request $request)
    {      
           $request->all();
        $input = new Event;
        $input['title'] = $request->input('name'); 
        $input['category'] = $request->input('category');
        $input['start_date'] = $request->input('start_date');
        $input['end_date'] = $request->input('end_date');     
       $input->save();
        return redirect::back()->with('msg_success', trans('app.insert_success_message'));
    }


   
    public function eventlist(){
    $userdata1=User::all();
    $data = Event::all();

    return view('eventlist',compact('data','userdata1'));
     
    }

   public function destroy(){

    $data = Event::findOrFail($id);
    if ($data){
     $data->delete();
    return Redirect::back()->with('msg_delete', trans('app.delete_success_message'));
    }
    else{
    return Redirect::back()->with('msg_delete', "Loged user don't delete able!");
  
 }
   }


}
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\business;
use App\PaymentGateway;
use App\User;
use App\BusinessProducts;
use App\CustomFields;
use App\Transactions;
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
use Validator;
use Carbon\Carbon;
use Charts;
use Config;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{

  //protected $foo;
  public function __construct()
  {
		parent::__construct();
    $this->middleware('auth');
    //$this->foo = $foo;
    $this->middleware('permission:register_user.register_user');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('register_user.register_user');
    }

    public function force_business(){
      return view('register_user.register_user');
    }

    /*public function change_business($id){
      $business = DB::table('business')->where('business_id', '=', $id)->first();
			
			session()->put(['business_actual' => $business->business_id]);
      //$business = DB::table('business')->where('user_id', '=', Auth::id())->get();
      session()->put('business_details', $business);
      return redirect()->action('DashboardController@dashboard_business', ['id' => $id]);
      //return view('register_user.list_business', compact('business'));
    }*/
		
		

    public function steps(Request $request, $id)
    {
      if($request->method() == 'GET'){
          $business = business::findOrFail($id);
          return view('register_user.steps',compact('business'));
      }
      if($request->method() == 'POST'){
          $business = business::findOrFail($id);
          return view('register_user.steps',compact('business'));
      }
    }

    public function select_payment(){
      /***$plans = DB::table('plans')->where('public', '=', '1')->get();
      return view('register_user.select_tech', compact('plans'));***/
      return view('register_user.payment');
    }

    public function temp_payment(Request $request){
      $plans = DB::table('plans')->where('plan_id', '=', $request->input('plan_id'))->first();
      return view('register_user.payment', compact('plans'))->with('amount', $request->input('total'));
    }

    public function process_payment_temp(Request $request){
			
			$plans = DB::table('plans')->where('plan_id', '=', $request->input('plan_id'))->first();
			
			$buss = DB::table('business')->where('public_key', '=', (string) env('DEFAULT_GATEWAY'))->first();
      $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $buss->business_id)->first();
      
			switch(env('APP_ENV')){
				case 'production':
					$base_api = "https://payments.qpaypro.com/checkout/api_v1";
					$http_origin = "https://app.qpaypro.com";
					$amount = $request->input('cc_amount');
				break;
				case 'sandbox':
					$base_api = "https://sandbox.qpaypro.com/checkout/api_v1";
					$http_origin = "https://sandbox.qpaypro.com";
					$amount = 1.00;
				break;
				default:
					$base_api = "https://mydev.qpaypro.com/checkout/api_v1";
					$http_origin = "https://mydev.qpaypro.com";
					$amount = 1.00;
			}
			
			$cc_exp  = substr(chunk_split($request->input('cc_exp'), 2, '/'), 0, -1);
      //"x_amount": "'.$request->input('cc_amount').'",
			
			$array = [
				"x_login" => $buss->public_key,
      	"x_private_key" => $buss->private_key,
      	"x_api_secret" => $buss->api_secret,
      	"x_product_id" => $plans->plan_id,
      	"x_audit_number" => ($paymentgateway->current_audit_number + 1),
      	"x_fp_sequence" => ($paymentgateway->current_audit_number + 1),
      	"x_fp_timestamp" => time(),
      	"x_invoice_num" => ($paymentgateway->current_audit_number + 1),
      	"x_currency_code" => "GTQ",
      	//"x_amount" => 1.00,
				//"x_amount" => $request->input('cc_amount'),
				"x_amount" => $amount,
      	"x_line_item" => $plans->plan_name,
      	"x_freight" => "0",
      	"x_email" => Auth::user()->email,
      	"cc_number" => $request->input('cc_number'),
      	"cc_exp" => $cc_exp,
      	"cc_cvv2" => $request->input('cc_cvv'),
      	"cc_name" => $request->input('cc_name'),
				"cc_type" => null,
      	"x_first_name" => $request->input('cc_name'),
      	"x_last_name" => $request->input('cc_name'),
      	"x_company" => "QPayPro",
      	"x_address" => "Guatemala",
      	"x_city" => "Guatemala",
      	"x_state" => "Guatemala",
      	"x_country" => "Guatemala",
      	"x_zip" => "01011",
      	"x_relay_response" => "none",
      	"x_relay_url" => "none",
      	"x_type" => "AUTH_ONLY",
      	"x_method" => "CC",
      	"http_origin" => $http_origin,
      	"visaencuotas" => 0
			];
			
			$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $base_api);
			
			//curl_setopt($ch, CURLOPT_HEADER, true);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($ch, CURLOPT_HTTPHEADER,$headerArray);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			//curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			
			$resp = curl_exec($ch);
      $info = curl_getinfo($ch);
			//$resp = strstr($resp, "{", false);
      $json = json_decode($resp);
      
			//dd($resp);
				
			if($json){
				$coderesponse = $json->responseCode;
				$textresponse = $json->responseText;
				
				if($coderesponse == "00"){
					$business = new business();
					$business->user_id = Auth::id();
					$business->plan_id = $plans->plan_id;
					$business->step = 'steps';
					$business->save();
	
					session()->put(['business_id' => $business->business_id]);
					session()->put(['user_id' => $business->user_id]);
	
					$paymentgateway = new PaymentGateway();
					$paymentgateway->business_id = $business->business_id;
					$paymentgateway->payment_method_id = '1';
					$paymentgateway->status = '1';
					$paymentgateway->default = '1';
					$paymentgateway->parameters = '{"terminalId":"", "merchant":"", "visaEnCuotas":1}';
					$paymentgateway->save();
	
					session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]);
					return view('register_user.steps',compact('business'))->with('success_payment', $textresponse);
				}else{
					//dd($textresponse);
					if(is_array($textresponse)){
						$textresponse = implode(',', $textresponse);
					}
					return view('register_user.payment', compact('plans'))->with('fail_payment', $textresponse);
				}
				
			} else {
				return view('register_user.payment', compact('plans'))->with('fail_payment', 'Error: El servicio no ha retornado una respuesta, por favor intente de nuevo.');
			}
      
			
    }

    public function step_continue($id){
        $business = business::findOrFail($id);
        $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->first();
        session()->put(['business_id' => $business->business_id]);
        session()->put(['user_id' => Auth::id()]);
        session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]);
        return (session::get('continua'));
        return view('register_user.step2',compact('business'));
    }

    public function step2_continue(Request $request, $id)
    {
      if($request->method() == 'GET'){
        $business = business::findOrFail($id);
        session()->put(['business_id' => $business->business_id]);
        return view('register_user.step2',compact('business'));
      }
    }

    public function step2(Request $request, $id)
    {
      if($request->method() == 'GET'){
        $business = business::findOrFail($id);
        return view('register_user.step2',compact('business'));
      }
      if($request->method() == 'POST'){
        //if($id == null){
        /*** $business = new business();
        $business->user_id = Auth::id();
        $business->step = '1';
        $business->save();

        session()->put(['business_id' => $business->business_id]);
        session()->put(['user_id' => $business->user_id]);

        $paymentgateway = new PaymentGateway();
        $paymentgateway->business_id = $business->business_id;
        $paymentgateway->payment_method_id = '1';
        $paymentgateway->parameters = '{"terminalId":"", "merchant":"", "visaEnCuotas":1}';
        $paymentgateway->save();

        session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]); ***/
        $business = business::findOrFail($id);
        //$input = $request->all();
        $data = $business;
        //return($request->input('currency_afiliation'));
        if($data){
          $input['business_industry'] = $request->input('business_industry');
          $input['desc_business'] = $request->input('desc_business');
          $input['activity_business'] = $request->input('activity_business');
          $input['url_business'] = $request->input('url_business');
          $input['sales_aprox'] = $request->input('sales_aprox');
          $input['expense_aprox'] = $request->input('expense_aprox');
          $input['num_employees'] = $request->input('num_employees');
          $input['step'] = 'step2';
          $data->update($input);
          $business = business::findOrFail($business->business_id);
          return view('register_user.step2',compact('business'));
        }
      //}
      /*** if(session::get('continua') == 'true'){
        $business = business::findOrFail($id);
        session()->put(['continua' => 'false']);
        return view('register_user.step2',compact('business'));
        }
      }
      if(session::get('business_id') != null){
        $data = business::findOrFail($id);
        if($data){
          $input['business_industry'] = $request->input('business_industry');
          $input['desc_business'] = $request->input('desc_business');
          $input['activity_business'] = $request->input('activity_business');
          $input['url_business'] = $request->input('url_business');
          $input['sales_aprox'] = $request->input('sales_aprox');
          $input['expense_aprox'] = $request->input('expense_aprox');
          $input['num_employees'] = $request->input('num_employees');
          $input['step'] = 'step2';
          $data->update($input);
          $business = business::findOrFail($id);
          return view('register_user.step2',compact('business'));
        }***/
      }
      return view('register_user.step2');
    }

    public function step3(Request $request, $id)
    {
      //return($request->all());
      //return($request->method());
      if($request->method() == 'POST'){
				
				if(session::get('continua') == 'true'){
          $business = business::findOrFail(session::get('business_id'));
					
					$business->setAttribute('references_information',
						(array) $this->setReferences(
							json_decode($business->references_information, true)
						)
					);												
					
					
					session()->put(['continua' => 'false']);
				  
          return view('register_user.step3',compact('business'));
        }
        
				$data = business::findOrFail($id);
				
				
        $business = $data;
        if ($request->input('currency_afiliation') == null) {
          session()->put(['currency_afiliation' => '1']);
          return view('register_user.step2',compact('business'));
        }
        $request->session()->forget('currency_afiliation');
        $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->first();
        session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]);
        $data2 = PaymentGateway::findOrFail(session::get('payment_gateway_id'));
        if($request->input('currency_afiliation') == "GTQ"){
          $input['currency_afiliation'] = 'GTQ';
          $input2['currency'] = 'GTQ';
          $data2->update($input2);
        }
        if($request->input('currency_afiliation') == "USD"){
          $input['currency_afiliation'] = 'USD';
          $input2['currency'] = 'USD';
          $data2->update($input2);
        }
        if($data){
          if($request->input('have_afiliation') == '1'){
              $input['have_afiliation'] = $request->input('have_afiliation');
              $input['number_afiliation'] = $request->input('number_afiliation');
          }else{
            $input['have_afiliation'] = '0';
            $input['number_afiliation'] = null;
          }
						$input['step'] = 'step3';
						
					
						//dd($input['references_information']);
					
            $data->update($input);
            $business = business::findOrFail($id);
						
						$business->setAttribute('references_information',
							(array) $this->setReferences(
								json_decode($business->references_information, true)
							)
						);
						
						//dd($business->references_information);
						
						//$business->setAttribute('references_information', json_decode($business->references_information));
						
            return view('register_user.step3',compact('business'));
					
					
					
        }
      }
      if($request->method() == 'GET'){
        $business = business::findOrFail($id);
				
				//dd('dd');
				
			
				
				$business->setAttribute('references_information',
					(array) $this->setReferences(
						json_decode($business->references_information, true)
					)
				);
				
				
				return view('register_user.step3',compact('business'));
      }
    }
		
		private function setReferences($references = array()){
			if(!$references) $references = [];
			//dd($references);
			return (array) array_merge((array) $this->references(), (array) $references);
		}
		
		private function references(){
			$a = (array) [
				'personal_references' => (array) [
					1 => (array) [
						'name'=>null,
						'phone'=>null
					],
					2 => (array) [
						'name'=>null,
						'phone'=>null
					]
				],
				'business_references' => (array) [
					1 => (array) [
						'name'=>null,
						'phone'=>null
					],
					2 => (array) [
						'name'=>null,
						'phone'=>null
					]
				],
				'banking_references' => (array) [ 
					1 => (array) [
						'name'=>null,
					],
					2 => (array) [
						'name'=>null,
					]
				]
			];
			
			return $a;
		}
		
		/*private function setReference($data){
			
			$obj = new \stdClass();
			
			$obj->name = $data['name'];
			$obj->phone = $data['phone'];
			
			return $obj;
		}*/

    public function step4(Request $request, $id)
    {
      if($request->method() == 'POST'){
        $data = business::findOrFail($id);
        $business = $data;
        //if($data->legal_name != null){
          //return ($data);
          //return view('register_user.step4',compact('business'));
        //}
        if($data){
          //return ("hoola");
          $input['fiscal_adress'] = $request->input('fiscal_adress');
          $input['office_adress'] = $request->input('office_adress');
          $input['phone'] = $request->input('phone');
          $input['business_type'] = $request->input('ownership_type');
          $input['business_name'] = $request->input('business_name');
          $input['legal_name'] = $request->input('legal_name');
          $input['tax_id'] = $request->input('tax_id');
          $input['name_representative'] = $request->input('name_representative');
          $input['representative_type'] = $request->input('representative_type');
					$input['representative_email'] = $request->input('representative_email');
					$input['representative_phone'] = $request->input('representative_phone');
          $input['id_representative'] = $request->input('id_representative');
          $input['ownership_type'] = $request->input('ownership_type');
          $input['tax_regime'] = $request->input('tax_regime');
          $input['date_foundation'] = $request->input('date_foundation');
         
				  $input['dangerous_neighborhood'] = $request->input('dangerous_neighborhood');
				 
				  $input['address_location_reference'] = ($request->input('address_location_reference_other')?$request->input('address_location_reference_other'):$request->input('address_location_reference'));
					$input['business_advertising'] = ($request->input('business_advertising_other')?$request->input('business_advertising_other'):$request->input('business_advertising'));
					$input['business_surveillance'] = ($request->input('business_surveillance_other')?$request->input('business_surveillance_other'):$request->input('business_surveillance'));
					
				 //dd($input);
					$references = $this->references();
					//$input['references_information'] = json_encode($this->setReferences($references, $request->input('references_information')));
					
					$input['references_information'] = json_encode(
							$this->setReferences(
								$request->input('references_information')
							)
						);
					
					$input['step'] = 'step4';
					
					//dd($input);
					
          $data->update($input);
          $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->first();
          session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]);
          $data2 = PaymentGateway::findOrFail(session::get('payment_gateway_id'));
          $input2['business_owner_address'] = $request->input('fiscal_adress');
          $input2['business_owner_name'] = $request->input('name_representative');
          $data2->update($input2);
          $business = business::findOrFail($id);
          return view('register_user.step4',compact('business'));
        }
      }
      if($request->method() == 'GET'){
        $business = business::findOrFail($id);
        return view('register_user.step4',compact('business'));
      }
    }

    public function step5(Request $request, $id)
    {
      if($request->method() == 'GET'){
        $business = business::findOrFail($id);
        return view('register_user.step5',compact('business'));
      }
      if($request->method() == 'POST'){
        $data = business::findOrFail($id);
        $business = $data;
        $data2 = PaymentGateway::findOrFail(session::get('payment_gateway_id'));
        if ($request->input('diferent_currency') == null) {
          session()->put(['diferent_currency' => '1']);
          return view('register_user.step4',compact('business'));
        }
        $request->session()->forget('diferent_currency');
        if($data){
          $input['bank'] = $request->input('bank');
          //$input['number_afiliation'] = $request->input('number_afiliation');
          $input['name_to_emit'] = $request->input('name_to_emit');
          $input['retention_name'] = $request->input('retention_name');
          $input['owner_account'] = $request->input('owner_account');
          $input['number_account'] = $request->input('number_account');
          $input['diferent_number_account'] = $request->input('diferent_number_account');
          $input['diferent_bank'] = $request->input('diferent_bank');
          $input['diferent_currency'] = $request->input('diferent_currency');
          $input['step'] = 'step5';
          $data->update($input);
          $input2['bank'] = $request->input('bank');
          $input2['currency'] = $request->input('diferent_currency');
          $input2['bank_account_name'] = $request->input('owner_account');
          $input2['bank_account_number'] = $request->input('number_account');
          $data2->update($input2);
          return view('register_user.step5',compact('business'));
        }
      }
      return view('register_user.step5',compact('business'));
    }

    public function step6(Request $request, $id)
    {
      if($request->method() == 'GET'){
        $business = business::findOrFail($id);
        return view('register_user.step6',compact('business'));
      }
      //return ($request->all());
      $document_id = $request->file('document_id');
      $rtu = $request->file('rtu');
      $service = $request->file('service');
      $document_canceled = $request->file('document_canceled');
      $document_patent = $request->file('document_patent');
      $document_representation = $request->file('document_representation');
      $document_patent_business = $request->file('document_patent_business');
      $document_gob = $request->file('document_gob');
      $document_med = $request->file('document_med');
			
			$file_risk_evaluation = $request->file('file_risk_evaluation');
			
      $data = business::findOrFail($id);
      $business = $data;
      if ($request->file('document_id') == null
					or $request->file('rtu') == null
					or $request->file('service') == null
					or $request->file('document_canceled') == null
					or $request->file('file_risk_evaluation' == null)
				) {
        session()->put(['msg_delete' => 'vacio']);
        return view('register_user.step5',compact('business'));
      }
      $validator = Validator::make($request->all(), [
            'document_id' => 'max:'.(1024*5),
            'rtu' => 'max:'.(1024*5),
            'service' => 'max:'.(1024*5),
            'document_canceled' => 'max:'.(1024*5),
            'document_patent' => 'max:'.(1024*5),
            'document_representation' => 'max:'.(1024*5),
						'file_risk_evaluation' => 'max:'.(1024*5)
        ]);
      if ($validator->fails())
      {
        session()->put(['msg_delete' => 'falla']);
        return view('register_user.step5',compact('business'));
      } else {
				
			}
      $business = $data;
      $destinationPath = 'uploads/registro'; // upload path
      if($document_patent != null){
        $ext_document_patent=$document_patent->getClientOriginalExtension();
        $document_patent = $business->business_id.'_document_patent.'.$ext_document_patent;
          Input::file('document_patent')->move($destinationPath, $document_patent);
        $path_document_patent = $destinationPath."/".$document_patent;
        $input['path_document_patent'] = $path_document_patent;
      }
      //
      if($document_patent_business != null){
        $ext_document_patent_business = $document_patent_business->getClientOriginalExtension();
        $document_patent_business = $business->business_id.'_document_patent_business.'.$ext_document_patent_business;
          Input::file('document_patent_business')->move($destinationPath, $document_patent_business);
        $path_document_patent_business = $destinationPath."/".$document_patent_business;
        $input['path_document_patent_business'] = $path_document_patent_business;
      }
      if($document_gob != null){
        $ext_document_gob = $document_gob->getClientOriginalExtension();
        $document_gob = $business->business_id.'_document_gob.'.$ext_document_gob;
          Input::file('document_gob')->move($destinationPath, $document_gob);
        $path_document_gob = $destinationPath."/".$document_gob;
        $input['path_document_gob'] = $path_document_gob;
      }
      if($document_med != null){
        $ext_document_med=$document_med->getClientOriginalExtension();
        $document_med = $business->business_id.'_document_med.'.$ext_document_med;
          Input::file('document_med')->move($destinationPath, $document_med);
        $path_document_med = $destinationPath."/".$document_med;
        $input['path_document_med'] = $path_document_med;
      }
      //
      if($document_representation != null){
          $ext_document_representation=$document_representation->getClientOriginalExtension();
          $document_representation = $business->business_id.'_document_representation.'.$ext_document_representation;
            Input::file('document_representation')->move($destinationPath, $document_representation);
          $path_document_representation = $destinationPath."/".$document_representation;
          $input['path_document_representation'] = $path_document_representation;
      }
			
			if($file_risk_evaluation != null){
			
					$risk_evaluation = sprintf('%s_%s.%s',
						$business->business_id,
						'risk_evaluation',
						$file_risk_evaluation->getClientOriginalExtension()
					);
          
					Input::file('file_risk_evaluation')->move($destinationPath, $risk_evaluation);
          $path_risk_evaluation = $destinationPath."/".$risk_evaluation;
					
          $input['file_risk_evaluation'] = $path_risk_evaluation;
      }
			
      if($data){
        if($document_id !== null){
          $ext_document_id=$document_id->getClientOriginalExtension();
          $ext_rtu=$rtu->getClientOriginalExtension();
          $ext_service=$service->getClientOriginalExtension();
          $ext_document_canceled=$document_canceled->getClientOriginalExtension();
          $document_id =$business->business_id.'_document_id.'.$ext_document_id;
          $rtu = $business->business_id.'_rtu.'.$ext_rtu;
          $service = $business->business_id.'_service.'.$ext_service;
          $document_canceled = $business->business_id.'_document_canceled.'.$ext_document_canceled;
            Input::file('document_id')->move($destinationPath, $document_id);
            Input::file('rtu')->move($destinationPath, $rtu);
            Input::file('service')->move($destinationPath, $service);
            Input::file('document_canceled')->move($destinationPath, $document_canceled);
          $path_document_id = $destinationPath."/".$document_id;
          $path_rtu = $destinationPath."/".$rtu;
          $path_service = $destinationPath."/".$service;
          $path_document_canceled = $destinationPath."/".$document_canceled;
          $input['path_document_id'] = $path_document_id;
          $input['path_rtu'] = $path_rtu;
          $input['path_service'] = $path_service;
          $input['path_document_canceled'] = $path_document_canceled;
          $input['step'] = 'step6';
          $data->update($input);
          $request->session()->forget('msg_delete');
          return view('register_user.step6', compact('business'));
        }else {//,['msg_delete' => '1']
          return view('register_user.step5',compact('business'));
        }
      }
    }

    public function complete(Request $request, $id){
      $business = business::findOrFail($id);
      $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->first();
      session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]);
      if ($request->input('path_signature') == null) {
        session()->put(['signature' => "1"]);
        return view('register_user.step6', compact('business'));
      }
      $data = $business;
      $data2 = PaymentGateway::findOrFail(session::get('payment_gateway_id'));
      if($data){
        $path_signature = "global/vendor/signature/tmp/".$request->input('path_signature');
        $input2['paramenters'] = '{"merchantId":"", "transactionKey":""}';
        $input['path_signature'] = $path_signature;
        $input['step'] = 'finish';
        $data->update($input);
        $data2->update($input2);

        $payment_gateway_old = PaymentGateway::find(session::get('payment_gateway_id'));
        $payment_gateway_new = $payment_gateway_old->replicate();
        $payment_gateway_new->parameters = '{"merchantId":"", "transactionKey":""}';
        $payment_gateway_new->currency = 'GTQ, USD';
        $payment_gateway_new->payment_method_id = '2';
        $payment_gateway_new->default = '1';
        $payment_gateway_new->save();
        $request->session()->forget('payment_gateway_id');
        $request->session()->forget('business_id');
        //EMAIL
        $url = 'https://api.sendgrid.com/';
        $user_sendgrid = 'qpaypro';
        $pass = 'H3jK8K-O9';

        $json_string = array(

          'to' => array(
            Auth::user()->email
          )
        );

        $params = array(
            'api_user'  => $user_sendgrid,
            'api_key'   => $pass,
            'x-smtpapi' => json_encode($json_string),
            'to'        => Auth::user()->email,
            'subject'   => 'Gracias por completa tu afiliación',
            'html'      => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" data-dnd="true">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
            <!--<![endif]-->

            <!--[if (gte mso 9)|(IE)]><style type="text/css">
            table {border-collapse: collapse;}
            table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
            img {-ms-interpolation-mode: bicubic;}
            </style>
            <![endif]-->
            <style type="text/css">
            body {
            color: #626262;
            }
            body a {
            color: #0088cd;
            text-decoration: none;
            }
            p { margin: 0; padding: 0; }
            table[class="wrapper"] {
            width:100% !important;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            -moz-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            }
            img[class="max-width"] {
            max-width: 100% !important;
            }
            @media screen and (max-width:480px) {
            .preheader .rightColumnContent,
            .footer .rightColumnContent {
            text-align: left !important;
            }
            .preheader .rightColumnContent div,
            .preheader .rightColumnContent span,
            .footer .rightColumnContent div,
            .footer .rightColumnContent span {
            text-align: left !important;
            }
            .preheader .rightColumnContent,
            .preheader .leftColumnContent {
            font-size: 80% !important;
            padding: 5px 0;
            }
            table[class="wrapper-mobile"] {
            width: 100% !important;
            table-layout: fixed;
            }
            img[class="max-width"] {
            height: auto !important;
            }
            a[class="bulletproof-button"] {
            display: block !important;
            width: auto !important;
            font-size: 80%;
            padding-left: 0 !important;
            padding-right: 0 !important;
            }
            // 2 columns
            #templateColumns{
            width:100% !important;
            }

            .templateColumnContainer{
            display:block !important;
            width:100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            }
            }
            .btn-group-vertical > .btn-group::after, .btn-group-vertical > .btn-group::before, .btn-toolbar::after, .btn-toolbar::before, .clearfix::after, .clearfix::before, .container-fluid::after, .container-fluid::before, .container::after, .container::before, .dl-horizontal dd::after, .dl-horizontal dd::before, .form-horizontal .form-group::after, .form-horizontal .form-group::before, .modal-footer::after, .modal-footer::before, .modal-header::after, .modal-header::before, .nav::after, .nav::before, .navbar-collapse::after, .navbar-collapse::before, .navbar-header::after, .navbar-header::before, .navbar::after, .navbar::before, .pager::after, .pager::before, .panel-body::after, .panel-body::before, .row::after, .row::before {
                content: " ";
                display: table;
            }
            *, *::before, *::after {
                box-sizing: border-box;
            }
            *::after, *::before {
                box-sizing: border-box;
            }
            .btn-group-vertical > .btn-group::after, .btn-toolbar::after, .clearfix::after, .container-fluid::after, .container::after, .dl-horizontal dd::after, .form-horizontal .form-group::after, .modal-footer::after, .modal-header::after, .nav::after, .navbar-collapse::after, .navbar-header::after, .navbar::after, .pager::after, .panel-body::after, .row::after {
                clear: both;
            }
            .btn-group-vertical > .btn-group::after, .btn-group-vertical > .btn-group::before, .btn-toolbar::after, .btn-toolbar::before, .clearfix::after, .clearfix::before, .container-fluid::after, .container-fluid::before, .container::after, .container::before, .dl-horizontal dd::after, .dl-horizontal dd::before, .form-horizontal .form-group::after, .form-horizontal .form-group::before, .modal-footer::after, .modal-footer::before, .modal-header::after, .modal-header::before, .nav::after, .nav::before, .navbar-collapse::after, .navbar-collapse::before, .navbar-header::after, .navbar-header::before, .navbar::after, .navbar::before, .pager::after, .pager::before, .panel-body::after, .panel-body::before, .row::after, .row::before {
                content: " ";
                display: table;
            }
            *, *::before, *::after {
                box-sizing: border-box;
            }
            *::after, *::before {
                box-sizing: border-box;
            }
            .steps.row {
                display: block;
                margin-left: 0;
                margin-right: 0;
            }
            .steps {
                margin-bottom: 22px;
            }
            .row {
                margin-left: -15px;
                margin-right: -15px;
            }
            *, *::before, *::after {
                box-sizing: border-box;
            }
            * {
                box-sizing: border-box;
            }
            </style>
            <style>
            body, p, div { font-family: helvetica,arial,sans-serif; }
            </style>
            <style>
            body, p, div { font-size: 15px; }
            </style>
            </head>
            <body yahoofix="true" style="min-width: 100%; margin: 0; padding: 0; font-size: 15px; font-family: helvetica,arial,sans-serif; color: #626262; background-color: #F4F4F4; color: #626262;" data-attributes="%7B%22dropped%22%3Atrue%2C%22bodybackground%22%3A%22%23F4F4F4%22%2C%22bodyfontname%22%3A%22helvetica%2Carial%2Csans-serif%22%2C%22bodytextcolor%22%3A%22%23626262%22%2C%22bodylinkcolor%22%3A%22%230088cd%22%2C%22bodyfontsize%22%3A15%7D>
            <center class="wrapper">
            <div class="webkit">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#F4F4F4">
            <tr><td valign="top" bgcolor="#F4F4F4" width="100%">
            <!--[if (gte mso 9)|(IE)]>
            <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
            <td>
            <![endif]-->
            <table width="100%" role="content-container" class="outer" data-attributes="%7B%22dropped%22%3Atrue%2C%22containerpadding%22%3A%220%2C0%2C0%2C0%22%2C%22containerwidth%22%3A600%2C%22containerbackground%22%3A%22%23F4F4F4%22%7D" align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td width="100%"><table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                    <!--[if (gte mso 9)|(IE)]>
                      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td>
                            <![endif]-->
                              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width:600px;" align="center">
                                <tr><td role="modules-container" style="padding: 0px 0px 0px 0px; color: #626262; text-align: left;" bgcolor="#F4F4F4" width="100%" align="left">
                                  <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="display:none !important; visibility:hidden; opacity:0; color:transparent; height:0; width:0;" class="module preheader preheader-hide" role="module" data-type="preheader">
            <tr><td role="module-content"><p>Has completado la información de tu afiliación.</p></td></tr>
            </table>
            <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22http%3A//app.qpaypro.com/app/public/login%22%2C%22width%22%3A%22200%22%2C%22height%22%3A%2256%22%2C%22imagebackground%22%3A%22%23f4f4f4%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png%22%2C%22alt_text%22%3A%22QPayPro%20-%20Negocios%20Electr%F3nicos%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%2220%2C0%2C20%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
            <tr>
            <td style="font-size:6px;line-height:10px;background-color:#f4f4f4;padding: 20px 0px 20px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
            <center>
            <table width="200" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
            <tr>
            <td width="200" valign="top">
            <![endif]-->
            <a href="http://app.qpaypro.com" target="_blank">
            <img class="max-width"  width="200"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png" alt="QPayPro - Negocios Electrónicos" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 200px !important; width: 100% !important; height: auto !important; " />
            </a>
            <!--[if mso]>
            </td></tr></table>
            </center>
            <![endif]--></td>
            </tr>
            </table><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C10%2C23%22%2C%22containerbackground%22%3A%22%23222121%22%7D">
            <tr>
            <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 10px 23px;" bgcolor="#222121"><h1 style="text-align: center;"><span style="color:#FFFFFF;">Gracias por completa tu afiliación</span></h1> </td>
            </tr>
            </table>
            <table class="module" role="module" data-type="button" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22borderradius%22%3A6%2C%22buttonpadding%22%3A%2212%2C18%2C12%2C18%22%2C%22text%22%3A%22Empecemos%2520a%2520configurar%2520tu%2520cuenta%22%2C%22alignment%22%3A%22center%22%2C%22fontsize%22%3A16%2C%22url%22%3A%22https%253A//app.qpaypro.com/app/public/%22%2C%22height%22%3A%22%22%2C%22width%22%3A%22%22%2C%22containerbackground%22%3A%22%23222121%22%2C%22padding%22%3A%220%2C0%2C30%2C0%22%2C%22buttoncolor%22%3A%22%231188e6%22%2C%22textcolor%22%3A%22%23ffffff%22%2C%22bordercolor%22%3A%22%231288e5%22%7D">
            <tr>
            <td style="padding: 0px 0px 30px 0px;" align="center" bgcolor="#222121">
            <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile">
            <tr>
            <td align="center" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; font-size: 16px;" bgcolor="#1188e6">
            <a href="https://app.qpaypro.com/list_business" class="bulletproof-button" target="_blank" style="height: px; width: px; font-size: 16px; line-height: px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; padding: 12px 18px 12px 18px; text-decoration: none; color: #ffffff; text-decoration: none; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border: 1px solid #1288e5; display: inline-block;">Ver estado de afiliación</a>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C34%2C23%22%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
            <tr>
            <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 34px 23px;" bgcolor="#ffffff"><h1 style="text-align: center;"><span style="color:#2D2D2D;">Tu afiliación a QPayPro está siendo procesada.</span></h1>  <div style="text-align: center;">En estos momentos nuestro departamento de afiliaciones estará validando la información proporcionada y procesándola en los próximos días, nuestro podrá comunicarse con tu persona si llegara a necesitar alguna información adicional.
            </div> <div style="text-align: left; padding: 34px 23px 34px 23px;">Atentamente: <br>Departamento de afiliaciones QPayPro</div></td>
            </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" role="module" data-type="columns" data-attributes="%7B%22dropped%22%3Atrue%2C%22columns%22%3A4%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22cellpadding%22%3A0%2C%22containerbackground%22%3A%22%22%7D">
            <tr><td style="padding: 0px 0px 0px 0px;" bgcolor="">
            <table class="columns--container-table" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
            <tr role="module-content">
            <td style="padding: 0px 0px 0px 0px" role="column-0" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
            <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/34970b0cf62ff01021c56a91bc7bdd22f5df1cfaf6b615b5fad9039e7d581d35f32d11c58737c73024bf42655596a2da4c3d0ec1017803c37b07a1b6582d6768.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
            <tr>
            <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
            <center>
            <table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
            <tr>
            <td width="50" valign="top">
            <![endif]-->

            <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/34970b0cf62ff01021c56a91bc7bdd22f5df1cfaf6b615b5fad9039e7d581d35f32d11c58737c73024bf42655596a2da4c3d0ec1017803c37b07a1b6582d6768.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

            <!--[if mso]>
            </td></tr></table>
            </center>
            <![endif]--></td>
            </tr>
            </table>
            </td><td style="padding: 0px 0px 0px 0px" role="column-1" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
            <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/42b695da6fe99ce857721f0209e1adf4190f51a834cb45af5b1fc7422293c9c629b7ea6a2230d368503999dd5e5acda2aeb0a1e09265dca564317d259203a2e1.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
            <tr>
            <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
            <center>
            <table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
            <tr>
            <td width="50" valign="top">
            <![endif]-->

            <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/42b695da6fe99ce857721f0209e1adf4190f51a834cb45af5b1fc7422293c9c629b7ea6a2230d368503999dd5e5acda2aeb0a1e09265dca564317d259203a2e1.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

            <!--[if mso]>
            </td></tr></table>
            </center>
            <![endif]--></td>
            </tr>
            </table>
            </td><td style="padding: 0px 0px 0px 0px" role="column-2" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
            <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/66f0a7ea03f8989f596eefde9f3a179973f2bb08526aba84eea98db89968264eccf90c2ca05c6b738baf6500e54bccd078a0fbe18fd7cf8598ea84c028fa7b1f.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
            <tr>
            <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
            <center>
            <table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
            <tr>
            <td width="50" valign="top">
            <![endif]-->

            <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/66f0a7ea03f8989f596eefde9f3a179973f2bb08526aba84eea98db89968264eccf90c2ca05c6b738baf6500e54bccd078a0fbe18fd7cf8598ea84c028fa7b1f.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

            <!--[if mso]>
            </td></tr></table>
            </center>
            <![endif]--></td>
            </tr>
            </table>
            </td><td style="padding: 0px 0px 0px 0px" role="column-3" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
            <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/338f67587a9518856eca1dbf3d3ac25d092ebc90edef8a49923c169a50de399b7ed2985488b5e80e3cffbf75224bc2280d777f3d7d2641ceeb637ed8ebf909a7.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
            <tr>
            <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
            <center>
            <table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
            <tr>
            <td width="50" valign="top">
            <![endif]-->

            <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/338f67587a9518856eca1dbf3d3ac25d092ebc90edef8a49923c169a50de399b7ed2985488b5e80e3cffbf75224bc2280d777f3d7d2641ceeb637ed8ebf909a7.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

            <!--[if mso]>
            </td></tr></table>
            </center>
            <![endif]--></td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td></tr>
            </table><table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22spacing%22%3A30%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
            <tr><td role="module-content" style="padding: 0px 0px 30px 0px;" bgcolor="#ffffff"></td></tr></table>
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" class="module footer" role="module" data-type="footer" data-attributes="%7B%22dropped%22%3Atrue%2C%22columns%22%3A%222%22%2C%22padding%22%3A%2248%2C34%2C17%2C34%22%2C%22containerbackground%22%3A%22%2332a9d6%22%7D">
            <tr><td style="padding: 48px 34px 17px 34px;" bgcolor="#32a9d6">
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
            <tr role="module-content">

            <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr>
              <td class="leftColumnContent" role="column-one" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
            <tr>
            <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor="">  <div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;"><a href="[unsubscribe]"><span style="color:#FFFFFF;">Unsubscribe</span></a><span style="color:#FFFFFF;"> | </span><a href="[Unsubscribe_Preferences]"><span style="color:#FFFFFF;">Update Preferences</span></a></div>  </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
            <tr>
              <td class="rightColumnContent" role="column-two" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
            <tr>
            <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor=""><div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">QPay, S.A.</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">Km. 22.5 Carretera a El Salvador, Edif. Plaza Portal del Bosque, Nivel 4, Of. 4A, Guatemala, Centro Am&eacute;rica</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">soporte@qpaypro.com</font></div> </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>

            </tr>
            </table>
            </td></tr>
            </table>

                                </tr></td>
                              </table>
                            <!--[if (gte mso 9)|(IE)]>
                          </td>
                        </td>
                      </table>
                    <![endif]-->
                    </td>
                  </tr>
                </table></td>
              </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </tr></td>
            </table>
            </div>
            </center>
            </body>
            </html>
',
            'text'      => '',
            'from'      => 'afiliaciones@qpaypro.com',
          );
        $request =  $url.'api/mail.send.json';

        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt ($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);


        $json_string = array(

          'to' => array(
            'afiliaciones@qpaypro.com'
          )
        );
				
				$dd = (array) @json_decode($data);

        $params = array(
            'api_user'  => $user_sendgrid,
            'api_key'   => $pass,
            'x-smtpapi' => json_encode($json_string),
            'to'        => 'afiliaciones@qpaypro.com',
            'subject'   => 'Un comercio completo su afiliación',
            'html'      => '
              <p>Un nuevo comercio completo la información necesaria para solicitar afiliación. La información es: </p><br>
							<p>
ID Usuario: '.@$dd['user_id'].' <br />
ID Plan: '.@$dd['plan_id'].' <br />
Fecha de Registro: '.@$dd['created_at'].' <br />
Número de Afiliación: '.@$dd['identification_number'].' <br />
Tipo Afiliación: '.@$dd['ownership_type'].' <br /><br />

1. Datos del Solicitante <br />
------------------ <br />
Tipo de solicitante: '.@$dd['tax_regime'].' <br />
Nombre o Razón Social: '.@$dd['legal_name'].' <br />
Nombre Comercial: '.@$dd['business_name'].' <br />
Actividad Ecónomica Principal: '.@$dd['activity_business'].'<br />
Sector ecónomico al que pertenece: '.@$dd['business_industry'].' <br />
NIT: '.@$dd['tax_id'].' <br />
Regimen Tributario: '.@$dd['business_type'].' <br />
Fecha de inicio de operaciones o de constitución: '.@$dd['date_foundation'].' <br />
Dirección Fiscal: '.@$dd['fiscal_adress'].'<br />
Dirección de Oficinas: '.@$dd['office_adress'].' <br />
Teléfono: '.@$dd['phone'].' <br />
Monto aprox. ventas por mes: '.@$dd['sales_aprox'].' <br />
Monto aprox. egresos por mes: '.@$dd['expense_aprox'].'<br />
Cantidad de empleados: '.@$dd['num_employees'].'<br /><br />

2. Datos del Propietario / Representante Legal 
------------------ <br />
Datos de:	'.@$dd['tax_regime'].' <br />
Nombre:	'.@$dd['name_representative'].' <br />
Tipo de Documento: '.@$dd['representative_type'].' <br />
Número de Documento: '.@$dd['id_representative'].'<br />
Sector ecónomico al que pertenece: '.@$dd['business_industry'].'<br />
Teléfono: '.@$dd['phone'].'<br /><br />

3. Datos para le gestión de pago
------------------ <br />
Nombre para emisión de pago: '.@$dd['name_to_emit'].'<br />
Tipo de Cuenta: DM <br />
Nombre del titular de la cuenta bancaria: '.@$dd['owner_account'].'<br />
Moneda: '.@$dd['currency_afiliation'].'<br />
Cuenta Bancaria: '.@$dd['number_account'].'<br />
Banco a Depositar: '.@$dd['bank'].'<br />
Nombre para emisión de factura y retención: '.@$dd['retention_name'].' <br />

							</p>
            ',
            'text'      => '',
            'from'      => 'afiliaciones@qpaypro.com',
          );
        $request =  $url.'api/mail.send.json';

        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        curl_setopt ($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);

        curl_close($session);
        //EMAIL
        //return view('register_user.complete');
        return view('register_user.complete', compact('business'));
      }
    }

    public function select_tech(Request $request, $id){
      if (session::get('business_id') != null) {
        return view('register_user.select_tech');
      }
      if (session::get('business_id') == null) {
        $business = DB::table('business')->where('business_id', '=', $id)->first();
        session()->put(['business_id' => $business->business_id]);
        $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->first();
        session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]);
        return view('register_user.select_tech');
      }
    }

    public function finish(Request $request, $id){
      $tech = $request->input('tech_id');
      if($tech=="Continuar Plan Free"){
        $tech_id = '1';
      }
      if($tech == "Seleccionar Plan Business"){
        $business = business::findOrFail($id);
        return view('register_user.payment',compact('business'));
      }
      $data = PaymentGateway::findOrFail(session::get('payment_gateway_id'));
      $data2 = business::findOrFail($id);
      if($data){
        $input['payment_method_id'] = $tech_id;
        $input['parameters'] = '{"terminalId":"", "merchant":"", "visaEnCuotas":0}';
        $input2['step'] = 'finish';
        $data->update($input);
        $data2->update($input2);
        $request->session()->forget('payment_gateway_id');
        $request->session()->forget('business_id');
        return view('register_user.finish');
      }
    }

    public function list_business(){
      if (Auth::user()->hasRole('Admin')) {
        //$business = business::all()->paginate(25);
         $business = DB::table('business')->select('*')->paginate(25);
				//$paymentgateway = PaymentGateway::findorFail($business->business_id);
				//'paymentgateway'
        return view('register_user.list_business',compact('business'));
      }else{
        $business = DB::table('business')->where('user_id', '=', Auth::id())->paginate(25);
        if($business == null){
          return view('register_user.register_user');
        }
        return view('register_user.list_business', compact('business'));
      }
    }

    

    public function continue_afiliation($id){
      $business = DB::table('business')->where('business_id', '=', $id)->first();
      session()->put(['business_id' => $business->business_id]);
      $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->first();
      session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]);
      session()->put(['continua' => 'true']);
      return view('register_user.continue_register',compact('business'));
    }

    public function payment($id){
      $business = business::findOrFail($id);
      return view('register_user.payment',compact('business'));
    }

    public function process_payment(Request $request, $id){
      $business = DB::table('business')->where('business_id', '=', $id)->first();
      $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', "46")->first();
      $base_api = "https://payments.qpaypro.com/checkout/api_v1";
      $cc_exp  = substr(chunk_split($request->input('cc_exp'), 2, '/'), 0, -1);
      $array = '{
      	"x_login": "greengift",
      	"x_private_key": "e175fb4c26df212d398c946483e5d6b3",
      	"x_api_secret": "j175WM7grhHxpv762wAHbCpBXHwQGctP",
      	"x_product_id": "1",
      	"x_audit_number": "'.  ($paymentgateway->current_audit_number + 1).'",
      	"x_fp_sequence": "'. ($paymentgateway->current_audit_number + 1) .'",
      	"x_fp_timestamp": "' . time() . '",
      	"x_invoice_num": "'. ($paymentgateway->current_audit_number + 1) .'",
      	"x_currency_code": "GTQ",
      	"x_amount": "576.00",
      	"x_line_item": "QPayPro Business",
      	"x_freight": "0",
      	"x_email": "'. Auth::user()->email .'",
      	"cc_number": "'.$request->input('cc_number').'",
      	"cc_exp": "'.$cc_exp.'",
      	"cc_cvv2": "'.$request->input('cc_cvv').'",
      	"cc_name": "'.$request->input('cc_name').'",
      	"x_first_name": "'.  $business->name_representative . '",
      	"x_last_name": "'.  $business->name_representative . '",
      	"x_company": "'. $business->tax_id .'",
      	"x_address": "'. $business->fiscal_adress .'",
      	"x_city": "Guatemala",
      	"x_state": "Guatemala",
      	"x_country": "Guatemala",
      	"x_zip": "01011",
      	"x_relay_response": "none",
      	"x_relay_url": "none",
      	"x_type": "AUTH_ONLY",
      	"x_method": "CC",
      	"http_origin": "https//app.qpaypro.com",
      	"visaencuotas": 0
      }';
      //return ($array);
      $headerArray = array(
        'Content-Type: application/json;charset=UTF-8',
        );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $base_api);
      curl_setopt($ch, CURLOPT_HEADER, true);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER,$headerArray);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      $resp = curl_exec($ch);
      $info = curl_getinfo($ch);
      $resp = strstr($resp, "{", false);
      $json = json_decode($resp);
      $coderesponse = $json->responseCode;
      $textresponse = $json->responseText;
      //return ($resp);
      if($coderesponse == "00"){
        $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->first();
        session()->put(['payment_gateway_id' => $paymentgateway->payment_gateway_id]);
        $data = business::findOrFail($id);
        //$pg = PaymentGateway::findOrFail(session::get('payment_gateway_id'));
        //$input2['currency'] = 'GTQ, USD';
        //$input2['parameters'] = '{"merchantId":"", "transactionKey":""}';
        //$input2['payment_method_id'] = '2';

        //$pg->update($input2);
        if($data){
					
					$input['public_key'] = strtolower($data->business_name);
					$input['private_key'] = str_random(10);
					$input['api_secret'] = hash('sha1', $data->business_name);
					
          $input['payment_success'] = '1';
          $input['step'] = 'finish';
          $data->update($input);
          $payment_gateway_old = PaymentGateway::find(session::get('payment_gateway_id'));
          $payment_gateway_new = $payment_gateway_old->replicate();
          $payment_gateway_new->parameters = '{"merchantId":"", "transactionKey":""}';
          $payment_gateway_new->currency = 'GTQ, USD';
          $payment_gateway_new->payment_method_id = '2';
          $payment_gateway_new->default = '1';
          $payment_gateway_new->save();
          $request->session()->forget('payment_gateway_id');
          $request->session()->forget('business_id');
          // Retrieve the first task
          //$paymentgateway = new PaymentGateway();
          //$paymentgateway->business_id = $data->business_id;
          //$paymentgateway->currency = 'GTQ, USD';
          //$paymentgateway->parameters = '{"merchantId":"", "transactionKey":""}';
          //$paymentgateway->payment_method_id = '2';
          //$paymentgateway->payment_success = '1';
          //$paymentgateway->save();

          //EMAIL
          $url = 'https://api.sendgrid.com/';
          $user_sendgrid = 'qpaypro';
          $pass = 'H3jK8K-O9';

          $json_string = array(

            'to' => array(
              Auth::user()->email, 'davidg@qpaypro.com'
            )
          );

          $params = array(
              'api_user'  => $user_sendgrid,
              'api_key'   => $pass,
              'x-smtpapi' => json_encode($json_string),
              'to'        => Auth::user()->email,
              'subject'   => 'Gracias tu pago ha sido acreditado',
              'html'      => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml" data-dnd="true">
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
              <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
              <!--[if !mso]><!-->
              <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
              <!--<![endif]-->

              <!--[if (gte mso 9)|(IE)]><style type="text/css">
              table {border-collapse: collapse;}
              table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
              img {-ms-interpolation-mode: bicubic;}
              </style>
              <![endif]-->
              <style type="text/css">
              body {
              color: #626262;
              }
              body a {
              color: #0088cd;
              text-decoration: none;
              }
              p { margin: 0; padding: 0; }
              table[class="wrapper"] {
              width:100% !important;
              table-layout: fixed;
              -webkit-font-smoothing: antialiased;
              -webkit-text-size-adjust: 100%;
              -moz-text-size-adjust: 100%;
              -ms-text-size-adjust: 100%;
              }
              img[class="max-width"] {
              max-width: 100% !important;
              }
              @media screen and (max-width:480px) {
              .preheader .rightColumnContent,
              .footer .rightColumnContent {
              text-align: left !important;
              }
              .preheader .rightColumnContent div,
              .preheader .rightColumnContent span,
              .footer .rightColumnContent div,
              .footer .rightColumnContent span {
              text-align: left !important;
              }
              .preheader .rightColumnContent,
              .preheader .leftColumnContent {
              font-size: 80% !important;
              padding: 5px 0;
              }
              table[class="wrapper-mobile"] {
              width: 100% !important;
              table-layout: fixed;
              }
              img[class="max-width"] {
              height: auto !important;
              }
              a[class="bulletproof-button"] {
              display: block !important;
              width: auto !important;
              font-size: 80%;
              padding-left: 0 !important;
              padding-right: 0 !important;
              }
              // 2 columns
              #templateColumns{
              width:100% !important;
              }

              .templateColumnContainer{
              display:block !important;
              width:100% !important;
              padding-left: 0 !important;
              padding-right: 0 !important;
              }
              }
              .btn-group-vertical > .btn-group::after, .btn-group-vertical > .btn-group::before, .btn-toolbar::after, .btn-toolbar::before, .clearfix::after, .clearfix::before, .container-fluid::after, .container-fluid::before, .container::after, .container::before, .dl-horizontal dd::after, .dl-horizontal dd::before, .form-horizontal .form-group::after, .form-horizontal .form-group::before, .modal-footer::after, .modal-footer::before, .modal-header::after, .modal-header::before, .nav::after, .nav::before, .navbar-collapse::after, .navbar-collapse::before, .navbar-header::after, .navbar-header::before, .navbar::after, .navbar::before, .pager::after, .pager::before, .panel-body::after, .panel-body::before, .row::after, .row::before {
                  content: " ";
                  display: table;
              }
              *, *::before, *::after {
                  box-sizing: border-box;
              }
              *::after, *::before {
                  box-sizing: border-box;
              }
              .btn-group-vertical > .btn-group::after, .btn-toolbar::after, .clearfix::after, .container-fluid::after, .container::after, .dl-horizontal dd::after, .form-horizontal .form-group::after, .modal-footer::after, .modal-header::after, .nav::after, .navbar-collapse::after, .navbar-header::after, .navbar::after, .pager::after, .panel-body::after, .row::after {
                  clear: both;
              }
              .btn-group-vertical > .btn-group::after, .btn-group-vertical > .btn-group::before, .btn-toolbar::after, .btn-toolbar::before, .clearfix::after, .clearfix::before, .container-fluid::after, .container-fluid::before, .container::after, .container::before, .dl-horizontal dd::after, .dl-horizontal dd::before, .form-horizontal .form-group::after, .form-horizontal .form-group::before, .modal-footer::after, .modal-footer::before, .modal-header::after, .modal-header::before, .nav::after, .nav::before, .navbar-collapse::after, .navbar-collapse::before, .navbar-header::after, .navbar-header::before, .navbar::after, .navbar::before, .pager::after, .pager::before, .panel-body::after, .panel-body::before, .row::after, .row::before {
                  content: " ";
                  display: table;
              }
              *, *::before, *::after {
                  box-sizing: border-box;
              }
              *::after, *::before {
                  box-sizing: border-box;
              }
              .steps.row {
                  display: block;
                  margin-left: 0;
                  margin-right: 0;
              }
              .steps {
                  margin-bottom: 22px;
              }
              .row {
                  margin-left: -15px;
                  margin-right: -15px;
              }
              *, *::before, *::after {
                  box-sizing: border-box;
              }
              * {
                  box-sizing: border-box;
              }
              </style>
              <style>
              body, p, div { font-family: helvetica,arial,sans-serif; }
              </style>
              <style>
              body, p, div { font-size: 15px; }
              </style>
              </head>
              <body yahoofix="true" style="min-width: 100%; margin: 0; padding: 0; font-size: 15px; font-family: helvetica,arial,sans-serif; color: #626262; background-color: #F4F4F4; color: #626262;" data-attributes="%7B%22dropped%22%3Atrue%2C%22bodybackground%22%3A%22%23F4F4F4%22%2C%22bodyfontname%22%3A%22helvetica%2Carial%2Csans-serif%22%2C%22bodytextcolor%22%3A%22%23626262%22%2C%22bodylinkcolor%22%3A%22%230088cd%22%2C%22bodyfontsize%22%3A15%7D>
              <center class="wrapper">
              <div class="webkit">
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#F4F4F4">
              <tr><td valign="top" bgcolor="#F4F4F4" width="100%">
              <!--[if (gte mso 9)|(IE)]>
              <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td>
              <![endif]-->
              <table width="100%" role="content-container" class="outer" data-attributes="%7B%22dropped%22%3Atrue%2C%22containerpadding%22%3A%220%2C0%2C0%2C0%22%2C%22containerwidth%22%3A600%2C%22containerbackground%22%3A%22%23F4F4F4%22%7D" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td width="100%"><table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td>
                      <!--[if (gte mso 9)|(IE)]>
                        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td>
                              <![endif]-->
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width:600px;" align="center">
                                  <tr><td role="modules-container" style="padding: 0px 0px 0px 0px; color: #626262; text-align: left;" bgcolor="#F4F4F4" width="100%" align="left">
                                    <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="display:none !important; visibility:hidden; opacity:0; color:transparent; height:0; width:0;" class="module preheader preheader-hide" role="module" data-type="preheader">
              <tr><td role="module-content"><p>Has completado la información de tu afiliación.</p></td></tr>
              </table>
              <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22http%3A//app.qpaypro.com/app/public/login%22%2C%22width%22%3A%22200%22%2C%22height%22%3A%2256%22%2C%22imagebackground%22%3A%22%23f4f4f4%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png%22%2C%22alt_text%22%3A%22QPayPro%20-%20Negocios%20Electr%F3nicos%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%2220%2C0%2C20%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
              <tr>
              <td style="font-size:6px;line-height:10px;background-color:#f4f4f4;padding: 20px 0px 20px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
              <center>
              <table width="200" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
              <tr>
              <td width="200" valign="top">
              <![endif]-->
              <a href="http://app.qpaypro.com" target="_blank">
              <img class="max-width"  width="200"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png" alt="QPayPro - Negocios Electrónicos" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 200px !important; width: 100% !important; height: auto !important; " />
              </a>
              <!--[if mso]>
              </td></tr></table>
              </center>
              <![endif]--></td>
              </tr>
              </table><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C10%2C23%22%2C%22containerbackground%22%3A%22%23222121%22%7D">
              <tr>
              <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 10px 23px;" bgcolor="#222121"><h1 style="text-align: center;"><span style="color:#FFFFFF;">Gracias, tu pago ha sido procesado exitosamente</span></h1> </td>
              </tr>
              </table>
              <table class="module" role="module" data-type="button" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22borderradius%22%3A6%2C%22buttonpadding%22%3A%2212%2C18%2C12%2C18%22%2C%22text%22%3A%22Empecemos%2520a%2520configurar%2520tu%2520cuenta%22%2C%22alignment%22%3A%22center%22%2C%22fontsize%22%3A16%2C%22url%22%3A%22https%253A//app.qpaypro.com/app/public/%22%2C%22height%22%3A%22%22%2C%22width%22%3A%22%22%2C%22containerbackground%22%3A%22%23222121%22%2C%22padding%22%3A%220%2C0%2C30%2C0%22%2C%22buttoncolor%22%3A%22%231188e6%22%2C%22textcolor%22%3A%22%23ffffff%22%2C%22bordercolor%22%3A%22%231288e5%22%7D">
              <tr>
              <td style="padding: 0px 0px 30px 0px;" align="center" bgcolor="#222121">
              <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile">
              <tr>
              <td align="center" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; font-size: 16px;" bgcolor="#1188e6">
              <a href="https://app.qpaypro.com/list_business" class="bulletproof-button" target="_blank" style="height: px; width: px; font-size: 16px; line-height: px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; padding: 12px 18px 12px 18px; text-decoration: none; color: #ffffff; text-decoration: none; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border: 1px solid #1288e5; display: inline-block;">Ver estado de afiliación</a>
              </td>
              </tr>
              </table>
              </td>
              </tr>
              </table>
              <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C34%2C23%22%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
              <tr>
              <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 34px 23px;" bgcolor="#ffffff"><h1 style="text-align: center;"><span style="color:#2D2D2D;">Tus credenciales de pago están en proceso.</span></h1>  <div style="text-align: center;">En estos momentos estaremos procesando tus credenciales de pago, este proceso puede tardar de 3-5 días hábiles, te estaremos notificando por correo electrónico en cuanto el sistema esté listo para ser usado y empieces a integrar tu comercio electrónico con QPay.<br>
              </div> <div style="text-align: left; padding: 34px 23px 34px 23px;">Atentamente: <br>Departamento de afiliaciones QPayPro</div></td>
              </tr>
              </table>
              <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" role="module" data-type="columns" data-attributes="%7B%22dropped%22%3Atrue%2C%22columns%22%3A4%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22cellpadding%22%3A0%2C%22containerbackground%22%3A%22%22%7D">
              <tr><td style="padding: 0px 0px 0px 0px;" bgcolor="">
              <table class="columns--container-table" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
              <tr role="module-content">
              <td style="padding: 0px 0px 0px 0px" role="column-0" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
              <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/34970b0cf62ff01021c56a91bc7bdd22f5df1cfaf6b615b5fad9039e7d581d35f32d11c58737c73024bf42655596a2da4c3d0ec1017803c37b07a1b6582d6768.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
              <tr>
              <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
              <center>
              <table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
              <tr>
              <td width="50" valign="top">
              <![endif]-->

              <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/34970b0cf62ff01021c56a91bc7bdd22f5df1cfaf6b615b5fad9039e7d581d35f32d11c58737c73024bf42655596a2da4c3d0ec1017803c37b07a1b6582d6768.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

              <!--[if mso]>
              </td></tr></table>
              </center>
              <![endif]--></td>
              </tr>
              </table>
              </td><td style="padding: 0px 0px 0px 0px" role="column-1" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
              <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/42b695da6fe99ce857721f0209e1adf4190f51a834cb45af5b1fc7422293c9c629b7ea6a2230d368503999dd5e5acda2aeb0a1e09265dca564317d259203a2e1.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
              <tr>
              <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
              <center>
              <table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
              <tr>
              <td width="50" valign="top">
              <![endif]-->

              <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/42b695da6fe99ce857721f0209e1adf4190f51a834cb45af5b1fc7422293c9c629b7ea6a2230d368503999dd5e5acda2aeb0a1e09265dca564317d259203a2e1.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

              <!--[if mso]>
              </td></tr></table>
              </center>
              <![endif]--></td>
              </tr>
              </table>
              </td><td style="padding: 0px 0px 0px 0px" role="column-2" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
              <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/66f0a7ea03f8989f596eefde9f3a179973f2bb08526aba84eea98db89968264eccf90c2ca05c6b738baf6500e54bccd078a0fbe18fd7cf8598ea84c028fa7b1f.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
              <tr>
              <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
              <center>
              <table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
              <tr>
              <td width="50" valign="top">
              <![endif]-->

              <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/66f0a7ea03f8989f596eefde9f3a179973f2bb08526aba84eea98db89968264eccf90c2ca05c6b738baf6500e54bccd078a0fbe18fd7cf8598ea84c028fa7b1f.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

              <!--[if mso]>
              </td></tr></table>
              </center>
              <![endif]--></td>
              </tr>
              </table>
              </td><td style="padding: 0px 0px 0px 0px" role="column-3" align="center" valign="top" width="25%" height="100%" class="templateColumnContainer column-drop-area ">
              <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2250%22%2C%22height%22%3A%2250%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/338f67587a9518856eca1dbf3d3ac25d092ebc90edef8a49923c169a50de399b7ed2985488b5e80e3cffbf75224bc2280d777f3d7d2641ceeb637ed8ebf909a7.png%22%2C%22alt_text%22%3A%22%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
              <tr>
              <td style="font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
              <center>
              <table width="50" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
              <tr>
              <td width="50" valign="top">
              <![endif]-->

              <img class="max-width"  width="50"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/338f67587a9518856eca1dbf3d3ac25d092ebc90edef8a49923c169a50de399b7ed2985488b5e80e3cffbf75224bc2280d777f3d7d2641ceeb637ed8ebf909a7.png" alt="" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 50px !important; width: 100% !important; height: auto !important; " />

              <!--[if mso]>
              </td></tr></table>
              </center>
              <![endif]--></td>
              </tr>
              </table>
              </td>
              </tr>
              </table>
              </td></tr>
              </table><table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22spacing%22%3A30%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
              <tr><td role="module-content" style="padding: 0px 0px 30px 0px;" bgcolor="#ffffff"></td></tr></table>
              <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" class="module footer" role="module" data-type="footer" data-attributes="%7B%22dropped%22%3Atrue%2C%22columns%22%3A%222%22%2C%22padding%22%3A%2248%2C34%2C17%2C34%22%2C%22containerbackground%22%3A%22%2332a9d6%22%7D">
              <tr><td style="padding: 48px 34px 17px 34px;" bgcolor="#32a9d6">
              <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
              <tr role="module-content">

              <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
              <tr>
                <td class="leftColumnContent" role="column-one" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
              <tr>
              <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor="">  <div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;"><a href="[unsubscribe]"><span style="color:#FFFFFF;">Unsubscribe</span></a><span style="color:#FFFFFF;"> | </span><a href="[Unsubscribe_Preferences]"><span style="color:#FFFFFF;">Update Preferences</span></a></div>  </td>
              </tr>
              </table>
              </td>
              </tr>
              </table>
              </td>
              <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
              <tr>
                <td class="rightColumnContent" role="column-two" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
              <tr>
              <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor=""><div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">QPay, S.A.</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">Km. 22.5 Carretera a El Salvador, Edif. Plaza Portal del Bosque, Nivel 4, Of. 4A, Guatemala, Centro Am&eacute;rica</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">soporte@qpaypro.com</font></div> </td>
              </tr>
              </table>
              </td>
              </tr>
              </table>
              </td>

              </tr>
              </table>
              </td></tr>
              </table>

                                  </tr></td>
                                </table>
                              <!--[if (gte mso 9)|(IE)]>
                            </td>
                          </td>
                        </table>
                      <![endif]-->
                      </td>
                    </tr>
                  </table></td>
                </tr>
              </table>
              <!--[if (gte mso 9)|(IE)]>
              </td>
              </tr>
              </table>
              <![endif]-->
              </tr></td>
              </table>
              </div>
              </center>
              </body>
              </html>
  ',
              'text'      => '',
              'from'      => 'afiliaciones@qpaypro.com',
            );
          $request =  $url.'api/mail.send.json';

          // Generate curl request
          $session = curl_init($request);
          // Tell curl to use HTTP POST
          curl_setopt ($session, CURLOPT_POST, true);
          // Tell curl that this is the body of the POST
          curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
          // Tell curl not to return headers, but do return the response
          curl_setopt($session, CURLOPT_HEADER, false);
          // Tell PHP not to use SSLv3 (instead opting for TLS)
          curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
          curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

          // obtain response
          $response = curl_exec($session);

          $json_string = array(

            'to' => array(
              'afiliaciones@qpaypro.com'
            )
          );

          $params = array(
              'api_user'  => $user_sendgrid,
              'api_key'   => $pass,
              'x-smtpapi' => json_encode($json_string),
              'to'        => 'afiliaciones@qpaypro.com',
              'subject'   => 'Afiliación Pagada',
              'html'      => '
                <p>Un nuevo comercio realizo el pago de su afiliación a QPayPro. La información del comercio es: </p><br>
                <p>'.$data.'</p>
              ',
              'text'      => '',
              'from'      => 'afiliaciones@qpaypro.com',
            );
          $request =  $url.'api/mail.send.json';

          // Generate curl request
          $session = curl_init($request);
          // Tell curl to use HTTP POST
          curl_setopt ($session, CURLOPT_POST, true);
          // Tell curl that this is the body of the POST
          curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
          // Tell curl not to return headers, but do return the response
          curl_setopt($session, CURLOPT_HEADER, false);
          // Tell PHP not to use SSLv3 (instead opting for TLS)
          curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
          curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

          // obtain response
          $response = curl_exec($session);

          curl_close($session);
          //EMAIL

          return view('register_user.finish',compact('business'));
        }
        //$request->session()->forget('payment_gateway_id');
        //$request->session()->forget('business_id');
          //return view('register_user.finish',compact('business'));
      }else{
        session()->put(['fail_payment' => '1']);
        return view('register_user.payment',compact('business'));
      }
    }

    public function third_integration(){
      $business = DB::table('business')->where('user_id', '=', Auth::id())->get();
      return view('register_user.third_integration', compact('business'));
    }

    public function payment_form(){
      return view('register_user.payment_form');
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function details_business($id){
      $user = DB::table('users')->where('id', "=", Auth::id())->first();
      $business = business::findOrFail($id);
      
			$business->setAttribute('references_information',
				(array) $this->setReferences(
					json_decode($business->references_information, true)
				)
			);
			
			$paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->get();
      //$paymentmethod = DB::table('payment_method')->where('payment_method_id', '=', $paymentgateway->payment_method_id)->get();
      //return ($paymentgateway);
      return view('register_user.details_business',compact('business', 'user', 'paymentgateway'));
    }

    public function upload(Request $request, $id)
    {
      //return ($request->all());
      $logo = $request->file('logo');
      $data = business::findOrFail($id);
      $business = $data;
      $validator = Validator::make($request->all(), [
            'logo' => 'max:1024',
        ]);
      if ($validator->fails())
      {
        session()->put(['msg_delete' => 'falla']);
        return view('register_user.details_business',compact('business'));
      }
      $business = $data;
      $destinationPath = 'uploads/registro'; // upload path
      if($data){
          $ext_logo=$logo->getClientOriginalExtension();
          $logo_id = $business->business_id.'_logo.'.$ext_logo;
            Input::file('logo')->move($destinationPath, $logo_id);
          $path_logo_id = $destinationPath."/".$logo_id;
          $input['logo'] = $path_logo_id;
          $data->update($input);
          $user = DB::table('users')->where('id', "=", Auth::id())->first();
          $paymentgateway = DB::table('payment_gateway')->where('business_id', '=', $id)->get();
          return Redirect::back()->with('msg_success', trans('app.insert_success_message'));
      }
    }

    public function business_products(){
      $count = DB::table('business')->where('user_id', "=", Auth::id())->count();
      if($count > 1){
          $business = DB::table('business')->where('user_id', '=', Auth::id())->get();
 			    return view('register_user.list_business', compact('business'));
      }else{
        $business = DB::table('business')->where('user_id', "=", Auth::id())->first();
      }
      $business_products = DB::table('business_products')->where('business_id', "=", $business->business_id)->paginate(10);
      $limit = 0;
      foreach ($business_products as $product) {
        if($product->status == "1"){
          $limit++;
        }
      }
      $plans = DB::table('plans')->where('plan_id', "=", $business->plan_id)->first();
      return view('register_user.business_products', compact('business', 'business_products', 'plans'))->with('limit', $limit);
    }

    public function business_products_detail($id){
			
			$business = null;
			$business_products = null;
			$plans = null;
			$limit = 0;
			
			Session::forget('msg_update');
			Session::forget('msg_success');
			Session::forget('msg_delete');
			
			$business = DB::table('business')->where('business_id', '=', $id)->first();
			
			if($business){
			
				if($business->user_id != Auth::id()){
					$business = DB::table('business')->where('user_id', '=', Auth::id())->get();
					return view('register_user.list_business', compact('business'));
				}
				$business_products = DB::table('business_products')->where('business_id', "=", $business->business_id)->paginate(10);
				
				foreach ($business_products as $product) {
					if($product->status == "1"){
						$limit++;
					}
				}
				
			
				$plans = DB::table('plans')->where('plan_id', "=", $business->plan_id)->first();
			
			}
			
      return view('register_user.business_products', compact('business', 'business_products', 'plans'))->with('limit', $limit);
    }

    public function business_products_register($id){
			Session::forget('msg_update');
			Session::forget('msg_success');
			Session::forget('msg_delete');
			
      $count = DB::table('business')->where('business_id', "=", $id)->count();
      $business = DB::table('business')->where('business_id', "=", $id)->first();
      $business_products = DB::table('business_products')->where('business_id', "=", $id)->get();
      //return($business_products);
      $limit = 0;
      foreach ($business_products as $product) {
        if($product->status == "1"){
          $limit++;
        }
      }
			
      $plans = DB::table('plans')->where('plan_id', "=", $business->plan_id)->first();
      if($limit >= $plans->quantity_buttons && $plans->quantity_buttons != '-1'){
          return view('register_user.business_products', compact('business', 'business_products', 'plans'))->with('limit', $limit);
      }else{
        $business = DB::table('business')->where([
          ['business_id', "=", $id],
          ['step', "=", 'finish'],
          ])->first();
        return view('register_user.business_products_register', compact('business', 'plans'))->with('count', $count);
      }
			session()->flash('msg_update', trans('Ocurrio un error, intenta mas tarde'))->with('count', $count);
      return Redirect::back();
    }
		
		private function validateButton($input = []){
			//dd($input);
			$o = 0;
			$msg = null;
			
			$business = DB::table('business')->where([
        ['business_id', "=", $input['business_id']],
      ])->first();
			
			
			if($input['enabled_visa_cuota'] == 1){
				if($input['currency'] == 'GTQ'){
					
					$gateway = DB::table('payment_gateway')
					->where('business_id', '=', $business->business_id)
					->where('payment_method_id', '=', 1)
					->where('status', '=', 1)
					->limit(1)
					->first()
					;
					
					if($gateway){
						$params = json_decode($gateway->parameters);
						if($params->visaEnCuotas == 1){
							$o = $input['estado'];
						} else {
							$o = 100;
						}
					} else {
						$o = 101;
					}
					
				} else {
					$o = 103;
				}
			} else {
				if($input['currency'] == 'USD'){
					$gateway = DB::table('payment_gateway')
					->where('business_id', '=', $business->business_id)
					->whereRaw(DB::raw("LOCATE('USD',`currency`)>0"))
					->where('status', '=', 1)
					->limit(1)
					->first();
					
					//dd($gateway);
					
					if($gateway){
						$o = $input['estado'];
					} else {
						$o = 102;
					}
					
				} else {
					$default = DB::table('payment_gateway')
					->where('business_id', '=', $business->business_id)
					->whereRaw(DB::raw("LOCATE('GTQ',`currency`)>0"))
					->where('status', '=', 1)
					->where('default', '=', 1)
					->limit(1)
					->first();
					
					if($default){
						$o = $input['estado'];
					} else {
						$o = 104;
					}
					
				}
			}
			
			/*if($input['estado']!=1){
				return 0;
			}**/
			
			return $o;
			
			/*if($input['enabled_visa_cuota']){
				if($input['currency'] == 'GTQ'){
					$payment_gateway_id = $gatewayPGW->payment_gateway_id;	
				} else {
					$payment_gateway_id = null;
					$msg = 'No puedes habilitar Visa cuotas para pago en Dólares';
				}
			} else {
				if($input['currency'] == 'USD'){
					$payment_gateway_id = $gatewayCybs->payment_gateway_id;
				} else {
					
					$defaultGateway = DB::table('payment_gateway')
					->where('business_id', '=', $business->business_id)
					->where('status', '=', 1)
					->where('default', '=', 1)
					->limit(1)
					->get();
					
					$payment_gateway_id = $defaultGateway->payment_gateway_id;
				
			}}*/
			
			
			
		}
		
		private function buttonStatus($status = 0){
			switch($status){
				case 1:
					$msg = 'Botón de pago habilitado';
				break;
				case 100:
					$msg = '[100] Tu comercio no tiene habilitada la recepción de pagos con Visa cuotas';
				break;
				case 101:
					$msg = '[101] Tu comercio no tiene habilitada una pasarela para recibir pagos en moneda Quetzales';
				break;
			  case 102:
					$msg = '[102] Tu comercio no tiene habilitada una pasarela para recibir pagos en moneda Dólares';
				break;
				case 103:
					$msg = '[103] No es posible recibir pagos de Visa cuotas con moneda dólares';
				break;
				case 104:
					$msg = '[104] Tu comercio no tiene una pasarela de pago configurada como predeterminada. Por favor contacte a soporte@qpaypro.com.';
				break;
				default:
					$msg = 'Botón de pago deshabilitado';
			}
			
			return $msg;
		}

    public function business_products_store(Request $request){
			Session::forget('msg_update');
			Session::forget('msg_success');
			Session::forget('msg_delete');
      //$request->all();
      $input = new BusinessProducts;
      $input['business_id'] = $request->input('business_id');
      /**$payments_gateway = DB::table('payment_gateway')->where([
        ['business_id', "=", $input['business_id']],
        ['payment_method_id', "=", '2'],
        ])->get();**/
      //$input['payment_gateway_id'] = $request->input('payment_gateway_id');
      $input['name'] = $request->input('name');
      $input['title'] = $request->input('name');
      $input['description'] = $request->input('description');
      $input['charge_type'] = $request->input('charge_type');
      $input['price'] = $request->input('price');
      $input['price_editable'] = $request->input('price_editable');
      $input['price_range'] = $request->input('price_range');
      $input['button_text'] = $request->input('button_text');
      $input['quantity_edit'] = $request->input('quantity_edit');
      $input['quantity'] = $request->input('quantity');
      $input['currency'] = trim($request->input('currency'));
      $input['frequency'] = $request->input('frequency');
      $input['color'] = $request->input('color');
      $fecha = date_create($request->input('charge_until'));
      $fecha = $fecha->format('Y-m-d');
      $input['charge_until'] = $fecha;
      $input['enabled_visa_cuota'] = $request->input('enabled_visa_cuota');
      $input['enabled_shipping'] = $request->input('enabled_shipping');
      if($request->input('charge_shipping')!=null){
        $input['shipping_cost'] = $request->input('charge_shipping');
        $input['charge_shipping'] = $request->input('charge_shipping');
      }else{
        $input['shipping_cost'] = 0;
        $input['charge_shipping'] = 0;
      }
			//dd($input);
			$input['status'] = $this->validateButton($request);
			
			//dd($input['status']);
			
     // $input['status'] = $request->input('estado');
      
			$input->save();
				
			$products = DB::table('business_products')->where([
			['product_id', "=", $input->product_id],
			])->first();
			$business = DB::table('business')->where([
				['business_id', "=", $products->business_id],
			])->first();
			
      if($input['status'] == 1 || $input['status'] == 0 ){
				return view('register_user.business_products_embed', ['id' => $input->product_id, 'sucess' => 'Tu link de pago ha sido creado', 'sucess_text' => 'Haz creado tu link de pago con exito, tu link es:'], compact('products', 'business'))->with('msg_success', 'Tu nuevo botón de pago ha sido creado.');
			} else {
				
				session()->flash('msg_update',$this->buttonStatus($input['status']));
				
				return redirect()->action('RegisterController@business_products_edit',['id' => $input->product_id])
					;
				//return Redirect::back()->with('msg_delete', $this->buttonStatus($input['status'] ));
			}
			
			//return Redirect::back()->with('msg_success', trans('app.insert_success_message'));
    }

    public function business_products_edit($id){
			Session::forget('msg_update');
			Session::forget('msg_success');
			Session::forget('msg_delete');
      $products = DB::table('business_products')->where([
        ['product_id', "=", $id],
        ])->first();
      $business = DB::table('business')->where([
        ['business_id', "=", $products->business_id],
        ['step', "=", 'finish'],
        ])->first();
      $count = DB::table('business')->where('business_id', "=", $business->business_id)->count();
      $plans = DB::table('plans')->where('plan_id', "=", $business->plan_id)->first();
      //return($products);
			
			Session::forget('msg_update');
			Session::forget('msg_delete');
			
			$statusText = $this->buttonStatus($products->status);
			
			//dd(Session::all());
		  if(@$products->status != 1){
				session()->flash('msg_delete', $statusText);
			} 
			
			
      return view('register_user.business_products_edit', compact('products', 'business', 'plans'))
				->with('count', $count)
				->with('buttonStatus',$statusText)
				//->flash('msg_delete', $statusText)
				;
    }

    public function business_products_update(Request $request, $id)
    {
			Session::forget('msg_update');
			Session::forget('msg_success');
			Session::forget('msg_delete');
      $business = DB::table('business')->where('business_id', "=", $request->input('business_id'))->first();
      $business_products = DB::table('business_products')->where('business_id', "=", $business->business_id)->get();
      //return($business_products);
      $limit = 0;
      foreach ($business_products as $product) {
        if($product->status == "1"){
          $limit++;
        }
      }
			
			$plans = DB::table('plans')->where('plan_id', "=", $business->plan_id)->first();
			
			//return($limit);
      if($limit >= $plans->quantity_buttons && $plans->quantity_buttons != '-1'){
        $input = $request->all();
        $data = BusinessProducts::findOrFail($id);
            if($data){
              $input['business_id'] = $request->input('business_id');
              //$input['payment_gateway_id'] = $request->input('payment_gateway_id');
              $input['name'] = $request->input('name');
              $input['title'] = $request->input('name');
              $input['description'] = $request->input('description');
              $input['charge_type'] = $request->input('charge_type');
              $input['price'] = $request->input('price');
              $input['button_text'] = $request->input('button_text');
              $input['quantity_edit'] = $request->input('quantity_edit');
              $input['quantity'] = $request->input('quantity');
              $input['currency'] = $request->input('currency');
              if($request->input('color_update') != null){
                $input['color'] = $request->input('color_update');
              }
              $input['frequency'] = $request->input('frequency');
              $fecha = date_create($request->input('charge_until'));
              $fecha = $fecha->format('Y-m-d');
              $input['charge_until'] = $fecha;
              $input['enabled_visa_cuota'] = $request->input('enabled_visa_cuota');
              $input['enabled_shipping'] = $request->input('enabled_shipping');
              if($request->input('charge_shipping')!=null){
                $input['shipping_cost'] = $request->input('charge_shipping');
                $input['charge_shipping'] = $request->input('charge_shipping');
              }else{
                $input['shipping_cost'] = 0;
                $input['charge_shipping'] = 0;
              }
							
							$input['status'] = $this->validateButton($input);
							
							//dd($input['status']);
							
              $data->update($input);
              //return Redirect::back()->with('msg_update', trans('app.update_success_message'));
							
							if($input['status'] == 1 || $input['status'] == 0 ){
								
								$products = DB::table('business_products')->where([
								['product_id', "=", $data->product_id],
								])->first();
								$business = DB::table('business')->where([
									['business_id', "=", $products->business_id],
								])->first();
								
								session()->flash('msg_success', 'Tu nuevo botón de pago ha sido creado.');
								
								return view('register_user.business_products_embed', ['id' => $data->product_id, 'sucess' => 'Tu link de pago ha sido creado', 'sucess_text' => 'Haz creado tu link de pago con exito, tu link es:'], compact('products', 'business'))
								;
							} else {
								
								session()->flash('msg_update',$this->buttonStatus($input['status']));
								
								return redirect()->action('RegisterController@business_products_edit',['id' => $data->product_id]);
								//return Redirect::back()->with('msg_delete', $this->buttonStatus($input['status'] ));
							}
							
						}
          //return view('register_user.business_products', compact('business', 'business_products', 'plans'))->with('limit', $limit);
      }else{
        $input = $request->all();
        $data = BusinessProducts::findOrFail($id);
        if($data){
          $input['business_id'] = $request->input('business_id');
          //$input['payment_gateway_id'] = $request->input('payment_gateway_id');
          $input['name'] = $request->input('name');
          $input['title'] = $request->input('name');
          $input['description'] = $request->input('description');
          $input['charge_type'] = $request->input('charge_type');
          $input['price'] = $request->input('price');
          $input['button_text'] = $request->input('button_text');
          $input['quantity_edit'] = $request->input('quantity_edit');
          $input['quantity'] = $request->input('quantity');
          $input['currency'] = $request->input('currency');
          $input['frequency'] = $request->input('frequency');
          $fecha = date_create($request->input('charge_until'));
          $fecha = $fecha->format('Y-m-d');
          $input['charge_until'] = $fecha;
          if($request->input('color_update') != null){
            $input['color'] = $request->input('color_update');
          }
          $input['enabled_visa_cuota'] = $request->input('enabled_visa_cuota');
          $input['enabled_shipping'] = $request->input('enabled_shipping');
          if($request->input('charge_shipping')!=null){
            $input['shipping_cost'] = $request->input('charge_shipping');
            $input['charge_shipping'] = $request->input('charge_shipping');
          }else{
            $input['shipping_cost'] = 0;
            $input['charge_shipping'] = 0;
          }
          //$input['status'] = $request->input('estado');
          $input['status'] = $this->validateButton($input);
					//dd($input);
					
					//dd($input['status']);
					
					//dd($this->buttonStatus($input['status']));
					
					$data->update($input);
					
					if($input['status'] == 1 || $input['status'] == 0 ){
						
						$products = DB::table('business_products')->where([
						['product_id', "=", $data->product_id],
						])->first();
						$business = DB::table('business')->where([
							['business_id', "=", $products->business_id],
						])->first();
						
						session()->flash('msg_success', 'Tu botón de pago ha sido actualizado.');
						
						return view('register_user.business_products_embed', ['id' => $data->product_id, 'sucess' => 'Tu link de pago ha sido actualizado', 'sucess_text' => 'Haz actualizado tu link de pago con exito, tu link es:'], compact('products', 'business'))
						;
					} else {
						
						session()->flash('msg_update', $this->buttonStatus($input['status'] ));
						
						/*return redirect()->action('RegisterController@business_products_edit',['id' => $data->product_id])
							->with('msg_update',$this->buttonStatus($input['status']));*/
						return Redirect::back();
					}
					
          //return Redirect::back()->with('msg_update', trans('app.update_success_message'));
        }
      }
    }

    public function business_products_destroy($id)
    {
			Session::forget('msg_update');
			Session::forget('msg_success');
			Session::forget('msg_delete');
      $data = BusinessProducts::findOrFail($id);
      if($data){
        $input['status'] = 0;
        $data->update($input);
				session()->flash('msg_update', trans('Botón deshabilitado'));
        return Redirect::back();
      }else{
				session()->flash('msg_update', trans('Ocurrio un error, intenta mas tarde'));
        return Redirect::back();
      }
    }

    public function business_products_active($id, $business)
    {
			Session::forget('msg_update');
			Session::forget('msg_success');
			Session::forget('msg_delete');
      $business = DB::table('business')->where('business_id', "=", $business)->first();
      $business_products = DB::table('business_products')->where('business_id', "=", $business->business_id)->get();
      $limit = 0;
      foreach ($business_products as $product) {
        if($product->status == "1"){
          $limit++;
        }
      }
      $plans = DB::table('plans')->where('plan_id', "=", $business->plan_id)->first();
      if($limit >= $plans->quantity_buttons && $plans->quantity_buttons != '-1'){
				session()->flash('msg_update', trans('Tu plan no permite tener mas botónes activos'));
        return Redirect::back();
      }else{
        $data = BusinessProducts::findOrFail($id);
        if($data){
          $input['status'] = 1;
          $data->update($input);
					session()->flash('msg_update', trans('Botón habilitado'));
          return Redirect::back();
        }else{
					session()->flash('msg_update', trans('Ocurrio un error, intenta mas tarde'));
          return Redirect::back();
        }
      }
			session()->flash('msg_update', trans('Ocurrio un error, intenta mas tarde'));
      return Redirect::back();
    }

    public function business_products_embed($id){
			Session::forget('msg_update');
			Session::forget('msg_success');
			Session::forget('msg_delete');
      $products = DB::table('business_products')->where([
        ['product_id', "=", $id],
      ])->first();
      $business = DB::table('business')->where([
        ['business_id', "=", $products->business_id],
      ])->first();
      return view('register_user.business_products_embed', compact('products', 'business'));
    }

    public function transactions_details($id){
      $transactions = DB::table('transactions')->where('transaction_id', '=', $id)->first();
      $business = DB::table('business')->where('business_id', '=', $transactions->business_id)->first();
      $custom_fields_value = DB::table('custom_fields_values')->where('transaction_id', '=', $id)->get();
      return view('register_user.detail_transaction', compact('transactions', 'custom_fields_value', 'business'));
    }

    public function transactions_list(Request $request, $id){
			
			$transactions = null;
			$business = null;
			
			$searchname = $request->input('search');
      $business = DB::table('business')->where('business_id', '=', $id)->first();
			
			if($business){
				if($business->user_id != Auth::id()){
					$business = DB::table('business')->where('user_id', '=', Auth::id())->get();
					return view('register_user.list_business', compact('business'));
				}
				if($searchname!=null){
					$transactions = Transactions::where('business_id', '=', $id)
					 ->where('cc_name', 'like', '%'.$searchname.'%')
					 ->orderBy('created_at', 'desc')
					 ->paginate(20);
				}else{
					$business = DB::table('business')->where('business_id', '=', $id)->first();
					$transactions = DB::table('transactions')->where([
						 ['business_id', '=', $id],
					])
					->orderBy('created_at', 'desc')
					->paginate(10);
					//return($transactions);
				}
			}
			
      return view('register_user.transactions_list', compact('transactions', 'business'));
    }

    public function custom_fields($id){
      $custom_fields = DB::table('custom_fields')->where('product_id', '=', $id)->get();
      $product = DB::table('business_products')->where('product_id', '=', $id)->first();
      $business = DB::table('business')->where('business_id', '=', $product->business_id)->first();
      return view('register_user.custom_fields', compact('custom_fields', 'product', 'business'))->with('id', $id);
    }

    public function custom_fields_register(Request $request, $id){
      //var_dump($request->all());
      if($request->all() == null){
        return Redirect::back()->with('msg_delete', "Para actualizar la información es necesaria tener al menos un campo personalziado creado.");
      }
      $id_edits = array();
      $names = array();
      $types = array();
      $descriptions = array();
      $options = array();
      $temp = array();
      $requiereds = array();
      $statuss = array();
      $removes = array();
      foreach ($request->input('id') as $id_edit) {
        //echo "Codigo: " . $codigo . "<br>";
        array_push($id_edits, $id_edit);
      }
      foreach ($request->input('name') as $name) {
        //echo "Codigo: " . $codigo . "<br>";
        array_push($names, $name);
      }
      foreach ($request->input('type') as $type) {
        //echo "Nombre: " . $nombre . "<br>";
        array_push($types, $type);
      }
      foreach ($request->input('description') as $description) {
        //echo "Precio: " . $precio . "<br>";
        array_push($descriptions, $description);
      }
      /**foreach ($request->input('options') as $option) {
        //echo "Precio: " . $precio . "<br>";
        $option = explode("\r\n", $option);
        $j=0;
        foreach ($option as $line) {
          if($line != ""){
            array_push($option, $j . "=" . $line);
            $j++;
          }
          array_splice($option, 0, ($j*-1));
        }
        array_push($options, $option);
      }**/
      foreach ($request->input('requiered') as $requiered) {
        //echo "Precio: " . $precio . "<br>";
        array_push($requiereds, $requiered);
      }
      foreach ($request->input('status') as $status) {
        //echo "Precio: " . $precio . "<br>";
        array_push($statuss, $status);
      }
      foreach ($request->input('delete') as $remove) {
        //echo "Codigo: " . $codigo . "<br>";
        array_push($removes, $remove);
      }

      for ($i = 0; $i < count($names); $i++){
        //echo "Name: " . $names[$i] . " " . "Type: " . $types[$i] . " " . "Description: " . $descriptions[$i] . " " . "Options: " . $options[$i] . " " . "Requiered: " . $requiereds[$i] ." " . "Requiered: " . $statuss[$i] . "<br>";
        //exit;
        if($id_edits[$i] == ""){
          //echo "Agregar";
          if($names[$i] != ""){
            $input = new CustomFields;
            $input['product_id'] = $id;
            $input['name'] = $names[$i];
            $input['type'] = $types[$i];
            $input['description'] = $descriptions[$i];
            $input['size'] = 0;
            $input['status'] = $statuss[$i];
            $input['required'] = $requiereds[$i];
            $input->save();
          }else{
            return Redirect::back()->with('msg_delete', "No es posible guardar información incompleta. Por favor completa correctamente la información");
          }
        }elseif($id_edits[$i] != "" && $removes[$i] =="0") {
          //echo "Editar";
          if($names[$i] != ""){
            $data = CustomFields::findOrFail($id_edits[$i]);
            if($data){
              $input['name'] = $names[$i];
              $input['type'] = $types[$i];
              $input['description'] = $descriptions[$i];
              $input['size'] = 0;
              $input['status'] = $statuss[$i];
              $input['required'] = $requiereds[$i];
              $data->update($input);
            }
          }else{
            return Redirect::back()->with('msg_delete', "No es posible actualizar información incompleta. Por favor revisa nuevamente el formulario");
          }
        }elseif($id_edits[$i] != "" && $removes[$i] =="1") {
          //echo "Eliminar";
          $data = CustomFields::findOrFail($id_edits[$i]);
          if ($data){
            $data->delete();
          }
        }
      }
      //var_dump($options);
      return Redirect::back()->with('msg_success', trans('app.insert_success_message'));
    }

    public function business_products_send($id)
    {
      $products = DB::table('business_products')->where('product_id', "=", $id)->first();
      $business = DB::table('business')->where('business_id', "=", $products->business_id)->first();
      return view('register_user.business_products_send', compact('products', 'business'));
    }

    public function business_products_sending(Request $request, $id)
    {
      $products = DB::table('business_products')->where('product_id', "=", $id)->first();
      $business = DB::table('business')->where('business_id', "=", $products->business_id)->first();
      if($products->shipping_cost > 0){
        $shipping= 'más envío '.$products->currency.' '.$products->shipping_cost.'<br>';
      }else{
        $shipping ="";
      }
      /**Envío de Correo**/
      $url = 'https://api.sendgrid.com/';
      $user_sendgrid = 'qpaypro';
      $pass = 'H3jK8K-O9';

      $json_string = array(

        'to' => array(
          $request->input('receiver')
        )
      );

      $params = array(
          'api_user'  => $user_sendgrid,
          'api_key'   => $pass,
          'x-smtpapi' => json_encode($json_string),
          'to'        => $request->input('receiver'),
          'subject'   => 'Has recibido una solicitud de pago',
          'html'      => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                          <html xmlns="http://www.w3.org/1999/xhtml" data-dnd="true">
                          <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                            <!--[if !mso]><!-->
                            <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
                            <!--<![endif]-->

                            <!--[if (gte mso 9)|(IE)]><style type="text/css">
                            table {border-collapse: collapse;}
                            table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
                            img {-ms-interpolation-mode: bicubic;}
                            </style>
                            <![endif]-->
                            <style type="text/css">
                            body {
                              color: #626262;
                            }
                            body a {
                              color: #0088cd;
                              text-decoration: none;
                            }
                            p { margin: 0; padding: 0; }
                            table[class="wrapper"] {
                              width:100% !important;
                              table-layout: fixed;
                              -webkit-font-smoothing: antialiased;
                              -webkit-text-size-adjust: 100%;
                              -moz-text-size-adjust: 100%;
                              -ms-text-size-adjust: 100%;
                            }
                            img[class="max-width"] {
                              max-width: 100% !important;
                            }
                            @media screen and (max-width:480px) {
                              .preheader .rightColumnContent,
                              .footer .rightColumnContent {
                                  text-align: left !important;
                              }
                              .preheader .rightColumnContent div,
                              .preheader .rightColumnContent span,
                              .footer .rightColumnContent div,
                              .footer .rightColumnContent span {
                                text-align: left !important;
                              }
                              .preheader .rightColumnContent,
                              .preheader .leftColumnContent {
                                font-size: 80% !important;
                                padding: 5px 0;
                              }
                              table[class="wrapper-mobile"] {
                                width: 100% !important;
                                table-layout: fixed;
                              }
                              img[class="max-width"] {
                                height: auto !important;
                              }
                              a[class="bulletproof-button"] {
                                display: block !important;
                                width: auto !important;
                                font-size: 80%;
                                padding-left: 0 !important;
                                padding-right: 0 !important;
                              }
                              // 2 columns
                              #templateColumns{
                                  width:100% !important;
                              }

                              .templateColumnContainer{
                                  display:block !important;
                                  width:100% !important;
                                  padding-left: 0 !important;
                                  padding-right: 0 !important;
                              }
                            }
                            </style>
                            <style>
                            body, p, div { font-family: helvetica,arial,sans-serif; }
                          </style>
                            <style>
                            body, p, div { font-size: 15px; }
                          </style>
                          </head>
                          <body yahoofix="true" style="min-width: 100%; margin: 0; padding: 0; font-size: 15px; font-family: helvetica,arial,sans-serif; color: #626262; background-color: #F4F4F4; color: #626262;" data-attributes="%7B%22dropped%22%3Atrue%2C%22bodybackground%22%3A%22%23F4F4F4%22%2C%22bodyfontname%22%3A%22helvetica%2Carial%2Csans-serif%22%2C%22bodytextcolor%22%3A%22%23626262%22%2C%22bodylinkcolor%22%3A%22%230088cd%22%2C%22bodyfontsize%22%3A15%7D>
                            <center class="wrapper">
                              <div class="webkit">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#F4F4F4">
                                <tr><td valign="top" bgcolor="#F4F4F4" width="100%">
                                <!--[if (gte mso 9)|(IE)]>
                                <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                                  <tr>
                                    <td>
                                    <![endif]-->
                                      <table width="100%" role="content-container" class="outer" data-attributes="%7B%22dropped%22%3Atrue%2C%22containerpadding%22%3A%220%2C0%2C0%2C0%22%2C%22containerwidth%22%3A600%2C%22containerbackground%22%3A%22%23F4F4F4%22%7D" align="center" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                          <td width="100%"><table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                              <td>
                                              <!--[if (gte mso 9)|(IE)]>
                                                <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                                                  <tr>
                                                    <td>
                                                      <![endif]-->
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width:600px;" align="center">
                                                          <tr><td role="modules-container" style="padding: 0px 0px 0px 0px; color: #626262; text-align: left;" bgcolor="#F4F4F4" width="100%" align="left">
                                                            <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="display:none !important; visibility:hidden; opacity:0; color:transparent; height:0; width:0;" class="module preheader preheader-hide" role="module" data-type="preheader">
                            <tr><td role="module-content"><p>Detalle del pago solicitado</p></td></tr>
                          </table>
                          <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22http%3A//mydev.qpaypro.com/app/public/login%22%2C%22width%22%3A%22200%22%2C%22height%22%3A%2256%22%2C%22imagebackground%22%3A%22%23f4f4f4%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png%22%2C%22alt_text%22%3A%22QPayPro%20-%20Negocios%20Electr%F3nicos%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%2220%2C0%2C20%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
                          <tr>
                            <td style="font-size:6px;line-height:10px;background-color:#f4f4f4;padding: 20px 0px 20px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
                          <center>
                          <table width="200" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
                            <tr>
                              <td width="200" valign="top">
                          <![endif]-->
                          <a href="https://app.qpaypro.com" target="_blank">
                            <img class="max-width"  width="200"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png" alt="QPayPro - Negocios Electrónicos" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 200px !important; width: 100% !important; height: auto !important; " />
                          </a>
                          <!--[if mso]>
                          </td></tr></table>
                          </center>
                          <![endif]--></td>
                          </tr>
                          </table><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C10%2C23%22%2C%22containerbackground%22%3A%22%23222121%22%7D">
                          <tr>
                            <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 10px 23px;" bgcolor="#222121"><h1 style="text-align: center;"><span style="color:#FFFFFF;">Hola, '.$business->legal_name.' te ha solicitado un pago de: '.$products->name.'</span></h1> </td>
                          </tr>
                          </table>
                          <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C34%2C23%22%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
                          <tr>
                            <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 34px 23px;" bgcolor="#ffffff"><h1 style="text-align: center;"><span style="color:#2D2D2D;">Detalle del pago solicitado</span></h1>  <div style="text-align: center;">'.$products->title.': '.$products->name.'<br></div>
                              <div style="text-align: center;">Por un valor de: '.$products->currency.' '.$products->price.' '.$shipping.'</div><br>
                              <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile" align="center">
                                <tr>
                                  <td align="center" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; font-size: 16px;" bgcolor="#1188e6">
                                    <a href="https://payments.qpaypro.com/checkout/'.$business->public_key.'/'.$products->product_id.'" class="bulletproof-button" target="_blank" style="height: px; width: px; font-size: 16px; line-height: px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; padding: 12px 18px 12px 18px; text-decoration: none; color: #ffffff; text-decoration: none; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border: 1px solid #1288e5; display: inline-block;">Realizar Pago</a>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          </table>
                          <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22spacing%22%3A30%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
                          <tr><td role="module-content" style="padding: 0px 0px 30px 0px;" bgcolor="#ffffff"></td></tr></table>
                          <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" class="module footer" role="module" data-type="footer" data-attributes="%7B%22dropped%22%3Atrue%2C%22columns%22%3A%222%22%2C%22padding%22%3A%2248%2C34%2C17%2C34%22%2C%22containerbackground%22%3A%22%2332a9d6%22%7D">

                            <tr><td style="padding: 48px 34px 17px 34px;" bgcolor="#32a9d6">

                              <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                                <tr role="module-content">
                                  <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
                                      <tr>
                                        <td class="leftColumnContent" role="column-one" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
                          <tr>
                            <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor="">  <div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;"><a href="[unsubscribe]"><span style="color:#FFFFFF;">Unsubscribe</span></a><span style="color:#FFFFFF;"> | </span><a href="[Unsubscribe_Preferences]"><span style="color:#FFFFFF;">Update Preferences</span></a></div>  </td>
                          </tr>
                          </table>
                          </td>
                                      </tr>
                                    </table>
                                  </td>
                                  <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
                                      <tr>
                                        <td class="rightColumnContent" role="column-two" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
                          <tr>
                            <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor=""><div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">QPay, S.A.</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">Km. 22.5 Carretera a El Salvador, Edif. Plaza Portal del Bosque, Nivel 4, Of. 4A, Guatemala, Centro Am&eacute;rica</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">soporte@qpaypro.com</font></div> </td>
                          </tr>
                          </table>
                          </td>
                                      </tr>
                                    </table>
                                  </td>

                                </tr>
                              </table>
                            </td></tr>
                          </table>

                                                          </tr>
                                                          <td><div style="background-color: #32A9D6; font-size: 10px; line-height: 150%; margin: 0px; text-align: center;"><font color="#FFFFFF">Usted ha recibido este email departe de QPayPro, el cual es un servicio intermediario de pago en línea que trabaja con la entidad el comercio que generó dicha solicitud de pago.
                                        QPayPro está comprometido a prevenir correo electrónico fraudulento. El correo electrónico departe de QPayPro siempre contrendra el detalle del comercio, si desea conocer más sobre como detectar que no es un correo malicioso o phishing por favor valla a este enlace: Link a qpay sobre phishing.</font>
                        </div>
                                                          </td>
                                                        </td>
                                                        </table>
                                                      <!--[if (gte mso 9)|(IE)]>
                                                    </td>
                                                  </td>
                                                </table>
                                              <![endif]-->
                                              </td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                      </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                    </td>
                                  </tr>
                                </table>
                                <![endif]-->
                                </tr></td>
                                </table>
                              </div>
                            </center>
                          </body>
                          </html>
',
          'text'      => '',
          'from'      => 'no-reply@qpaypro.com',
        );
      $request =  $url.'api/mail.send.json';

      // Generate curl request
      $session = curl_init($request);
      // Tell curl to use HTTP POST
      curl_setopt ($session, CURLOPT_POST, true);
      // Tell curl that this is the body of the POST
      curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
      // Tell curl not to return headers, but do return the response
      curl_setopt($session, CURLOPT_HEADER, false);
      // Tell PHP not to use SSLv3 (instead opting for TLS)
      curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
      curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

      // obtain response
      $response = curl_exec($session);
      /**Fin Envio de correo**/

      return Redirect::back()->with('msg_success', 'Correo enviado exitosamente');
    }

    public function custom_form_payment($id)
    {
			$business = null;
			$business_products = null;
			$plans = null;
			$limit = 0;
			
      $count = DB::table('business')->where('user_id', "=", Auth::id())->count();
      $business = DB::table('business')->where('business_id', '=', $id)->first();
			
			if($business){
			
				if($business->user_id != Auth::id()){
					$business = DB::table('business')->where('user_id', '=', Auth::id())->get();
					return view('register_user.list_business', compact('business'));
				}
				$plans = DB::table('plans')->where('plan_id', "=", $business->plan_id)->first();
				
				
				$business_products = DB::table('business_products')->where('business_id', "=", $business->business_id)->paginate(10);
				
				foreach ($business_products as $product) {
					if($product->status == "1"){
						$limit++;
					}
				}
				if($plans->custom_payment_form == '0'){
					return view('register_user.business_products', compact('business', 'business_products', 'plans'))->with('limit', $limit);
				}
			
			}
      return view('register_user.custom_form_payment', compact('business'))->with('count', $count);
    }
		
    public function custom_form_payment_store(Request $request, $id)
    {
			$input = null;
			ini_set('memory_limit', '128M');
			
			//error_reporting(E_ALL);
			//ini_set('display_errors', true);
			
      $business = business::findOrFail($request->input('business_id'));
      if($business){
				
				$validator = Validator::make($request->all(), [
					'logo' => 'max:2048',
					'banner' => 'max:3096',
				],[
					'logo.max' => 'Has cargado una logo muy grande. El archivo a cargar no deben ser mayor a 2MB',
					'banner.max' => 'Has cargado una banner muy grande. El archivo a cargar no deben ser mayor a 3MB',
					//'banner.dimensions' => 'El banner debe tener como mínimo 1200 x 300 píxeles'
				]);
				if ($validator->fails()){
					
					session()->put(['msg_delete' => 'falla']);
					return Redirect::back()->with('msg_delete', implode(',',$validator->errors()->all()));
				} else {
					
				}
				
				
				/** Cargar Imagen **/
        if ($request->file('banner') != null){
					
					$logo = $request->file('banner');
          $destinationPath = 'uploads/registro'; // upload path
          $ext_logo=$request->file('banner')->getClientOriginalExtension();
          $logo_id = $id.'_'.uniqid().'_banner.'.$ext_logo;
          //Input::file('banner')->move($destinationPath, $logo_id);
          
					$path_banner_id = $destinationPath."/".$logo_id;
          
					try{
						$img = Image::make(Input::file('banner')->getPathName())->resize(250, 100, function ($constraint) {
							$constraint->aspectRatio();
						})->save(public_path().'/'.$destinationPath."/".$logo_id);
						
						$old_file = realpath(public_path().'/'.$business->background);
						
						if(is_file($old_file)){
							unlink($old_file);
						}
						
					} catch(Exception $e){
						
					}
					
					//dd($img);
					
					$input['background'] = $path_banner_id;
					
        }
        if ($request->file('logo') != null){
          $logo = $request->file('logo');
          $destinationPath = 'uploads/registro'; // upload path
          $ext_logo=$request->file('logo')->getClientOriginalExtension();
          $logo_id = $id.'_'.uniqid().'_logo.'.$ext_logo;
          //Input::file('logo')->move($destinationPath, $logo_id);
          
					$path_logo_id = $destinationPath."/".$logo_id;
					
					try{
						$img = Image::make(Input::file('logo')->getPathName())->resize(250, 100, function ($constraint) {
				    $constraint->aspectRatio();
						})->save(public_path().'/'.$destinationPath."/".$logo_id);
						
						$old_file = realpath(public_path().'/'.$business->logo);
						
						if(is_file($old_file)){
							unlink($old_file);
						}
						
					} catch(Exception $e){
						
					}
					
          $input['logo'] = $path_logo_id;
        }
        /** Fin Cargar Imagen **/
        if ($request->input('palete') != null){
          $input['palette'] = $request->input('palete');
        }
				
				if($input)
        $business->update($input);
        
				return Redirect::back()->with('msg_update', trans('app.update_success_message'));
      }
      return Redirect::back()->with('msg_update', "Ocurrio un error, por favor intenta nuevamente");
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
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
use App\Models\Transaction;

class TransactionsController extends Controller
{

  protected $foo;
  public function __construct(Foo $foo)
  {
    parent::__construct();
    $this->middleware('auth');
    $this->foo = $foo;
    $this->middleware('permission:manteinance.manteinance');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $searchname = $request->input('search');
      $transactions = Transactions::where('business_id', 'LIKE', '%'.$searchname.'%')
     ->orWhere('payment_gateway_id', 'LIKE', '%'.$searchname.'%')
     ->orWhere('product_id', 'LIKE', '%'. $searchname .'%')
     ->orWhere('audit_number', 'LIKE', '%'. $searchname .'%')
     ->orWhere('cc_last4digits', 'LIKE', '%'. $searchname .'%')
     ->orWhere('request', 'LIKE', '%'. $searchname .'%')
     ->orWhere('response_code', 'LIKE', '%'. $searchname .'%')
       ->orWhere('status', 'LIKE', '%'. $searchname .'%')
       ->orderBy('transaction_id', 'DESC')
          ->paginate(20);
      return view('transactions.transactions',compact('transactions'));
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
      $userdata = Transactions::findOrFail($id);
      return view('transactions.transactions_detalles',compact('userdata'));
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
    
    public function view($transaction_id){
      $row = Transaction::select(['transactions.*','bp.name as business_product_name', 'pm.payment_method_id', 'pm.name as payment_method_name'])
        ->PaymentGateway()
        ->PaymentMethod()
        ->BusinessProduct()
        ->findOrFail($transaction_id);
      
      if($row->additional_data)
      $row->setAttribute('additional_data', json_decode($row->additional_data));
      
      return view('transactions.view',compact('row'));
    }
    
}

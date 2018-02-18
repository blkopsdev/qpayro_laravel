<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
      'business_id', 'payment_gateway_id', 'product_id', 'audit_number', 'currency', 'amount', 'freight', 'email'. 'cc_name',
      'cc_last4digits', 'cc_expire_month', 'cc_expire_year', 'bill_to_name', 'bill_to_tax_id', 'bill_to_address', 'bill_to_city',
      'bill_to_state', 'bill_to_country', 'bill_to_zip', 'request', 'response_code', 'response_text', 'response_object',
      'status', 
    ];
    protected $dates = [
      'created_at', 'updated_at'
    ];
    protected $hidden = [
      'transaction_id'
    ];
}

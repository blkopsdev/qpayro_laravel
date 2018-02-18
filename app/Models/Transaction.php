<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
      'transactions.business_id', 'transactions.payment_gateway_id', 'product_id', 'audit_number', 'currency', 'amount', 'freight', 'email'.
      'cc_name',
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

    public function business(){
        return $this->belongsTo('App\Models\Business', 'transactions.business_id', 'business.business_id');
    }
    
    public function scopePaymentGateway($query){
        return $query->leftJoin('payment_gateway as pg', 'transactions.payment_gateway_id', '=', 'pg.payment_gateway_id');
    }
    
    public function scopePaymentMethod($query){
        return $query->leftJoin('payment_method as pm', 'pg.payment_method_id', '=', 'pm.payment_method_id');
    }
    
    public function scopeBusinessProduct($query){
        return $query->leftJoin('business_products as bp', 'transactions.product_id', '=', 'bp.product_id');
    }
    
}

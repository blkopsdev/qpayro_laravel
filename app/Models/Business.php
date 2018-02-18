<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Business extends Model
{
  protected $table = 'business';

  protected $primaryKey = 'business_id';

  protected $fillable = [
    'user_id', 'plan_id', 'public_key', 'api_secret', 'private_key', 'business_name', 'logo', 'background', 'palette',
    'identification_number', 'ownership_type', 'tax_regime', 'legal_name', 'tax_id', 'country', 'state', 'city', 'zip_code',
    'address', 'business_industry', 'desc_business', 'activity_business', 'url_business', 'sales_aprox', 'expense_aprox',
    'num_employees', 'number_afiliation', 'number_account', 'owner_account', 'name_to_emit', 'retention_name', 'bank',
    'currency_afiliation', 'have_afiliation', 'diferent_bank', 'diferent_number_account', 'diferent_currency', 'fiscal_adress',
    'office_adress', 'phone', 'business_type', 'address_location_reference', 'business_advertising', 'business_surveillance',
    'dangerous_neighborhood', 'name_representative', 'representative_type', 'id_representative', 'representative_email',
    'representative_phone', 'date_foundation', 'references_information', 'path_document_id', 'path_rtu', 'path_service', 'path_document_canceled',
    'path_document_patent', 'path_document_representation', 'path_document_patent_business', 'path_document_gob', 'path_document_med',
    'path_signature', 'file_risk_evaluation','step','payment_success', 'status'
  ];

  protected $hidden = [
     'business_id'
  ];

  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  
  public function transactions(){
    return $this->hasMany("App\Models\Transaction", 'business_id', 'business_id');
  }
  public function coupons(){
    return $this->hasMany("App\Models\coupon", 'business_id', 'business_id');
  }
  public function plans(){
    return $this->hasMany("App\Models\plane", 'business_id', 'business_id');
  }
  public function payment_gateways(){
    return $this->hasMany("App\Models\PaymentGateway", 'business_id', 'business_id');
  }
  
}

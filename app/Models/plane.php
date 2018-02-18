<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class plane extends Model
{
 protected $table = 'subscriptionplans';
      protected $primaryKey = 'id';

  protected $fillable = [
    'id', 'business_id', 'plan_name', 'plan_currency', 'plan_amount', 'plan_interval_number', 'plan_interval_term', 'plan_status', 'plan_trial'
  ];
}

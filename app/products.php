<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class products extends Model
{
  protected $table = 'products';
 protected $primaryKey = 'id';
protected $fillable = ['user_id','category_id', 'name', 'image', 'text'
    ];


}

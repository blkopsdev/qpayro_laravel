<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
  protected $table = 'role_user';

  protected $primaryKey = 'user_id';

  public $incrementing = true;

  protected $fillable = [
    'user_id',
    'role_id'
  ];
}

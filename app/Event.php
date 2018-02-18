<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   protected $fillable = ['title','category','start_date','end_date'];
}

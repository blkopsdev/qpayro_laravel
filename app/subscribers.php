<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

Class subscribers Extends Model{
protected $table = 'subscribers';
protected $fillable = array('email');
}
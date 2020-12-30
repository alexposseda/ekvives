<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Order extends Model
{
    use CrudTrait;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'name', 'email', 'message', 'company' , 'phone'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class PriceClarify extends Model
{
    use CrudTrait;

    protected $table = 'price_clarify';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'phone'];
}

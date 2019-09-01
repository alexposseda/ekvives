<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Subscriber extends Model
{
    use CrudTrait;

    protected $table = 'subscribers';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'company'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class ContactResponse extends Model
{
    use CrudTrait;

    protected $table = 'contact_responses';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'message', 'email', 'phone', 'subject'];
    

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected static function getAllData()
    {
        return Customer::select('*')->cursor();
    }
}

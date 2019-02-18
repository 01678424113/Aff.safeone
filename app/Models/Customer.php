<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    public static $ACTIVE = 1;
    public static $UNACTIVE = 0;

    protected static function getAllData()
    {
        return Customer::select('*')->cursor();
    }
}

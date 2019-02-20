<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    public static $FAIL = -1;
    public static $WAIT = 0;
    public static $SUCCESS = 1;

    public static $PAID = 1;
    public static $NOPAID = 0;

    protected static function getAllData()
    {
        return Customer::select('*')->cursor();
    }
}

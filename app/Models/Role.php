<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $ADMIN = 'admin';
    public static $LEADER = 'leader';
    public static $EMPLOYEE = 'employee';

}

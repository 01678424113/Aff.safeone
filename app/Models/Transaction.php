<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'company_id',
        'transaction_id',
        'type',
        'status',
        'note',
    ];

    public static $TYPE_MINUS = 1;
    public static $TYPE_PLUS = 2;

    public static $STATUS_INIT = 0;
    public static $STATUS_SUCCESS = 1;
    public static $STATUS_PENDING = 99;
    public static $STATUS_FAILURE = -1;
    public static $STATUS_CANCEL = 100;

    public static $VIA_BANK     = 'bank';
    public static $VIA_VISA     = 'visa';

    public static $CARD_VISA    = 'VISA';
    public static $CARD_MASTER  = 'MASTER';
}

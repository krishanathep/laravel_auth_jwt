<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'sumbillpay_txt';
    //protected $table = 'cust_notifcation_sendto';
    // protected $table = 'SUMBILLPAY_GROUP01';

    // protected $primaryKey = 'mcustno';
    //public $timestamps = false;
}

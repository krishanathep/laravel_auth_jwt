<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'tbl_custtel';

    protected $primaryKey = 'mcustno';

    public $timestamps = false;

    protected $fillable = [
        'mcustno',
        'mcustname',
        'maddress1',
        'maddress2',
        'mfax',
        'mstatusfax',
        'mtel',
        'mmobile',
        'memail',
        'mcontact',
        'mremarks',
        
    ];
}

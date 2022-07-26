<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendDetail extends Model
{
    use HasFactory;

    protected $table = 'send_detail';

    protected $fillable = [
        'mcusdoc','mcustno','mcustname','send_from','fax','email','report'
    ];
}

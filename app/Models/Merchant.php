<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Merchant extends Authenticatable
{
   
    use  Notifiable;
    public $timestamps = false;
    protected $table = 'merchant';
    protected $guard = "merchant";

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
        'coupon_name',
        'coupon_desc',
        'validity_date_time',
        'status',
        'discount',
    ];








    
}

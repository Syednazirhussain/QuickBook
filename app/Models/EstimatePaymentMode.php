<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimatePaymentMode extends Model
{
   use HasFactory, SoftDeletes;
        protected $dates = ["deleted_at"];
        public $timestamps = true;
        protected $table = 'estimate_payment_modes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'Fistamount',
        'Fistpaymentmode',
        'FistPayment',
        'Secondamount',
        'Secondpaymentmode',
        'SecondPayment',
        'Thirdamount',
        'Thirdpaymentmode',
        'ThirdPayment',
        'Fourthamount',
        'Fourthpaymentmode',
        'FourthPayment',
        'quartertype',
        'amount',
        'paymentmode',
        'payment',
        'persion_id',
        
        
    ];
}

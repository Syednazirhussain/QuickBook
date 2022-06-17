<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExciseTax extends Model
{
    use HasFactory, SoftDeletes;
        protected $dates = ["deleted_at"];
        public $timestamps = true;
        protected $table = 'excise_taxes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'IFTAFilledDate',
        'IFTAAcceptanceDate',
        'IFTATaxDue',
        'IFTATaxPaid',
        'IFTATaxPayment',
        'SecondIFTAFilledDate',
        'SecondIFTAAcceptanceDate',
        'SecondIFTATaxDue',
        'SecondIFTATaxPaid',
        'SecondIFTATaxPayment',
        'FilledDate',
        'AcceptanceDate',
        'PaymentMode',
        'PaymentConformed',
        'FormSchedule',
        'ThirdIFTAFilledDate',
        'ThirdIFTAAcceptanceDate',
        'ThirdIFTATaxDue',
        'ThirdIFTATaxPaid',
        'ThirdIFTATaxPayment',
        'FourthIFTAFilledDate',
        'FourthIFTAAcceptanceDate',
        'FourthIFTATaxDue',
        'FourthIFTATaxPaid',
        'FourthIFTATaxPayment',
        'persion_id',
        'quarter',
        
        
    ];
}

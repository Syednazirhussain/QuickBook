<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spinen\QuickBooks\HasQuickBooksToken;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable , SoftDeletes,HasQuickBooksToken;
        protected $dates = ["deleted_at"];
		public $timestamps = true;
		protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
		'mobile_no',
		'password',
        'user_id',
        'role_id'
		
	    
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	 public function DeviceToken()
    {
        return $this->hasMany(DeviceToken::class);
    }
}

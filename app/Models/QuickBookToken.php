<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickBookToken extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quickbooks_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "user_id",
        "realm_id",
        "access_token",
        "refresh_token",
        "access_token_expires_at",
        "refresh_token_expires_at"
    ];

    public function user() {

        return $this->belongsTo(User::class, 'user_id');
    }

}

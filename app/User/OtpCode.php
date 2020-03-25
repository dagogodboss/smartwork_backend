<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $fillable = [
        'user_id', 'token', 'validated'
    ];
    
    public function user(){
        return $this->belongsTo('App/User');
    }
}

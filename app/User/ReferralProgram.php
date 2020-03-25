<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class ReferralProgram extends Model
{
    protected $fillable = ['name', 'uri', 'lifetime_minutes'];
}

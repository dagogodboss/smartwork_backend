<?php

namespace App\User\Site;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $fillable = [
        'name','description', 'benefits', 'bonus', 'color'
    ];

    public static function getAccountType($type){
        return Self::where('name', $type)->first()->id;
    }

    public static function getBonus($type){
        return Self::find($type)->first()->bonus;
    }
}

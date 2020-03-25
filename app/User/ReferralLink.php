<?php

namespace App\User;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class ReferralLink extends Model
{
    protected $fillable = ['user_id', 'code', 'referral_program_id'];

    // protected static function boot()
    // {
    //     static::creating(function (ReferralLink $model) {
    //         $model->generateCode();
    //     });
    // }

    private function generateCode()
    {
         return (string)explode('-', Uuid::uuid1())[0];
    }

    public function getReferral($user, $program)
    {
        return $this->firstOrCreate(
        [
            'user_id' => $user->id,
            'referral_program_id' => $program->id,
        ],
        [
            'user_id' => $user->id,
            'code' =>$this->generateCode(),
            'referral_program_id' => $program->id
        ]);
    }

    public function getLinkAttribute()
    {
        return url($this->program->uri) . '?ref=' . $this->code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        // TODO: Check if second argument is required
        return $this->belongsTo(ReferralProgram::class, 'referral_program_id');
    }

    public function relationships()
    {
        return $this->hasMany(ReferralRelationship::class);
    }

}
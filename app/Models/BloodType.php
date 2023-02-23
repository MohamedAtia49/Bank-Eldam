<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    protected $appends = ['has_any'];
    public function getHasAnyAttribute(){
        $user = auth('client')->user();
        if(!$user){
            $user = auth('api')->user();
        }
        if($user){
            $check = $this->clients()->where('client_id',$user->id)->first();
            if ($check){
                return true;
            }
        }
        return false;
    }
    public function clients_profile()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}

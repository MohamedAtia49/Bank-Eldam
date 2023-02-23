<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{

    protected $table = 'governorates';
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

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}

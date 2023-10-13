<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'calusers';

    protected $fillable = [
        'email','password','avatar','first_name','last_name','company','address','city','state',
        'zip','phone','is_active','company_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function calcompany(){
        return $this->belongsTo('App\CalLocation','company_id');
    }

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CalItem extends Model
{    
    protected $table = "cal_items";

    public function callocation()
    {
        return $this->belongsTo('App\CalLocation','location_id');
    }
}
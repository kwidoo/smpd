<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
   protected $fillable = [
        'name', 'name_ru', 'image', 'title_lv',
    ];

    public function services(){
    	return $this->belongsToMany('App\Services', 'doctors_services', 'doctor_id', 'service_id')->withPivot('order');
    }
}

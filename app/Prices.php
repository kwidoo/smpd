<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $table = 'prices';

    protected $fillable = ['service_id, type', 'value'];

    public function discounts()
    {
        return $this->hasMany('App\Discounts')->where('starts_on', '<', date('Y-m-d H:i:s'))->whereDate('ends_on', '>', date('Y-m-d H:i:s'))->take(1);
    }

    public function service()
    {
        return $this->belongsTo('App\Services2', 'services_id', 'id');
    }
}

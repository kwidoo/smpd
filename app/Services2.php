<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services2 extends Model
{
    protected $table = "services2";

    protected $fillable = ['name', 'code'];

    public function prices()
    {
        return $this->hasMany('App\Prices', 'services_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Categories', 'categories_services', 'services_id', 'categories_id')->withPivot('order');
    }

    public function services()
    {
        return $this->belongsToMany('App\Services', 'rels_smpd.services_pivots', 'services2_id', 'services_id');
    }
}

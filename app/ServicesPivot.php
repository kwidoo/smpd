<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesPivot extends Model
{
    protected $connection = 'mysql';

    protected $table = 'services_pivots';

    public function services() {
    	return $this->hasOne('App\Services');
    }
    public function services2() {
    	return $this->hasOne('App\Services2');
    }
}

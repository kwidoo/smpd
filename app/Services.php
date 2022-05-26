<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Services extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $connection = 'mysql';

    protected $fillable = [
        'name',
    ];
    protected $guarded = [
    	'image',
    ];

    public function doctors(){
    	return $this->belongsToMany('App\Doctors','doctors_services', 'service_id', 'doctor_id')->withPivot('order');
    }

    public function services2(){
    	return $this->belongsToMany('App\Services2', 'rels_smpd.services_pivots')->withPivot(['id', 'order', 'name_lv', 'name_ru']);
    }
}

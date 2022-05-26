<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Categories extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $connection = 'mysql2';

    protected $table = "categories";

    protected $fillable = ['name'];

    public function services()
    {
        return $this->belongsToMany('App\Services2', 'categories_services', 'categories_id', 'services_id')->withPivot('order');
    }
    public function services2()
    {
        return $this->belongsToMany('App\Services2', 'categories_services', 'categories_id', 'services_id')->withPivot('order');
    }

    public function children()
    {
        return $this->belongsToMany('App\Categories', 'categories_children', 'parent_id', 'children_id')->withPivot('order');
    }

    public function parent()
    {
        return $this->belongsToMany('App\Categories', 'categories_children', 'children_id', 'parent_id')->withPivot('order');
    }
}

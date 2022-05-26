<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsToMany;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Causelabs\ResourceIndexLink\ResourceIndexLink;

class Services2 extends Resource
{
    //public static $displayInNavigation = false;

    public static $group = 'Cenradis';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Services2';

    public static $with = [
        'categories'
    ];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name_lv';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name_lv', 'name_ru', 'code'
    ];

    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $indexDefaultOrder = [
        'id' => 'asc'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Select::make('Publicēts:', 'published')->options([
                0 => 'Nē',
                1 => 'Jā',
            ])->displayUsingLabels(),
            ResourceIndexLink::make('Kods:', 'code')->sortable(),
            ResourceIndexLink::make('Nosaukums:', 'name_lv')->sortable(),
            Text::make('Название:', 'name_ru')->onlyOnForms(),
            Text::make('PVN', function (){ 
                return $this->prices->first() ? ($this->prices->first()->type ? 'ar PVN' : 'bez PVN') : null ; 
            }),
            Text::make('Cena', function (){ 
                return $this->prices->first() ? (($this->prices->first()->value ?? 'no '.$this->prices->first()->value_from).' EUR') : null; 
            }),
            Text::make('Order', function() use ($request){
                if ($request->viaResource() === 'App\Nova\Category') {
                    return $this->pivot->order;
                } elseif ($request->viaResource() === 'App\Nova\Service') {
                    return $this->pivot->order;
                }
                else {
                    return null;
                }
            })->hideFromDetail(),
            HasMany::make('Cenas', 'prices', \App\Nova\Price::class),
            BelongsToMany::make('Pakalpojumi', 'services', \App\Nova\Service::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy')) && $request->viaResourceId === null) {
            $query->getQuery()->orders = [];
            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        } else {
            $query->getQuery()->orders = [];
            $query->orderBy('pivot_order');
        }
        return $query;
    }

    public static function label(){
        return 'Pakalpojumi';
    }
    public static function singularLabel(){
        return 'Pakalpojums';
    }

    public function title(){
        return $this->code.' - '.$this->name_lv;
    }
}

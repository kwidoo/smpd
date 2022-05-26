<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\BelongsTo;
use App\Prices;
use App\Services2;

class Price extends Resource
{
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Prices::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            Select::make('PVN', 'tax')->options([
                0 => 'bez PVN',
                1 => 'ar PVN'
            ])->displayUsingLabels(),
            Text::make('Cena', 'value', function(){
                return $this->value;
            })->displayUsing(function(){
                return $this->value.' EUR';
            })->rules('numeric', 'nullable'),
            Text::make('Cena no', 'value_from', function(){
                return $this->value_from;
            })->displayUsing(function(){
                return $this->value.' EUR';
            })->rules('numeric', 'nullable'),
            Text::make('Cena līdz', 'value_to', function(){
                return $this->value_to;
            })->displayUsing(function(){
                return $this->value.' EUR';
            })->rules('numeric','nullable'),
            Text::make('Mainits', 'updated_at', function(){
                return date('Y-m-d', strtotime($this->updated_at));
            })->exceptOnForms(),
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

    public static function label(){
        return 'Cenas';
    } 
    public static function singularLabel(){
        return 'Cena';
    } 
}

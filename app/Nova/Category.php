<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsToMany;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Causelabs\ResourceIndexLink\ResourceIndexLink;
use Yassi\NestedForm\NestedForm;

class Category extends Resource
{
    public static $group = 'Cenradis';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Categories';

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
        'name_lv', 'name_ru'
    ];
    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $indexDefaultOrder = [
        'order' => 'asc'
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
            ResourceIndexLink::make('Nosaukums:', 'name_lv')->sortable(),
            ResourceIndexLink::make('Название:', 'name_ru')->hideFromIndex()->hideFromDetail(),
            Text::make('Order:','order')->hideFromDetail(),

            BelongsToMany::make('Apakškategorijas', 'children', 'App\Nova\Category'),
            BelongsToMany::make('Pakalpojumi', 'services2', 'App\Nova\Services2'),
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
        return [new Lenses\CategoryUnPublished];
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
        if (empty($request->get('orderBy')) && $request->viaResource() === null) {
            $query->getQuery()->orders = [];
            return $query->whereDoesntHave('parent')->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        } else {
            $query->getQuery()->orders = [];
            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
        return $query;
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Kategorijas';
    }
}

<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\TextArea;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;

use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use Johnathan\NovaTrumbowyg\NovaTrumbowyg;
use Ctessier\NovaAdvancedImageField\AdvancedImage;
use Causelabs\ResourceIndexLink\ResourceIndexLink;
use Naxon\NovaFieldSortable\Concerns\SortsIndexEntries;
use Naxon\NovaFieldSortable\Sortable;
use R64\NovaImageCropper\ImageCropper;

class ServiceAp extends Resource
{   
    public static $group = 'Website';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Services';
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
            //ID::make()->sortable(),
            Select::make('Publicēts:', 'published')->options([
                0 => 'Nē',
                1 => 'Jā',
                2 => 'Apakškategorija'
            ])->displayUsingLabels(),
            ImageCropper::make('Mazā bilde', 'avatar')
            ->preview(function () {
                if (!$this->avatar) return null;
    
                $url = 'storage/'.$this->avatar;
                $filetype = pathinfo($url)['extension'];
                return 'data:image/' . $filetype . ';base64,' . base64_encode(file_get_contents($url));
            }),
            ImageCropper::make('Bilde:', 'image')->hideFromIndex()->preview(function () {
                if (!$this->image) return null;
    
                $url = 'storage/'.$this->image;
                $filetype = pathinfo($url)['extension'];
                return 'data:image/' . $filetype . ';base64,' . base64_encode(file_get_contents($url));
            })->hideFromIndex(),
            ResourceIndexLink::make('Nosaukums:','name_lv'),
            Text::make('Название:','name_ru')->onlyOnForms(),
            NovaTrumbowyg::make('Teksts', 'text_lv')->onlyOnForms(),
            NovaTrumbowyg::make('Текст', 'text_ru')->onlyOnForms(),
            Text::make('Mūsu speciālisti:','doctors_lv')->onlyOnForms(),
            Text::make('Наши специалисты:', 'doctors_ru')->onlyOnForms(),
            Text::make('Darba laiks:', 'time')->onlyOnForms(),
            Text::make('Order:', 'order')->hideFromDetail(),
            BelongsToMany::make('Pakalpojumu cenradis', 'services2', 'App\Nova\Services2'),
            BelongsToMany::make('Pievieontie Speciālisti', 'doctors', 'App\Nova\Doctor'),
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
        $query->where('published','=',2)->when(empty($request->get('orderBy')), function(Builder $q) {
            $q->getQuery()->orders = [];
            return $q->orderBy('order', 'ASC');
        });
    }
    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Skaistumkopšana';
    }
}

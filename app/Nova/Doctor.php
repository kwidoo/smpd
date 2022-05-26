<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\TextArea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsToMany;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Johnathan\NovaTrumbowyg\NovaTrumbowyg;
use Ctessier\NovaAdvancedImageField\AdvancedImage;
use R64\NovaImageCropper\ImageCropper;


class Doctor extends Resource
{
    public static $group = 'Website';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Doctors';

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
        'name_lv', 'name_ru',
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
          //  ID::make()->sortable(),
            Select::make('Publicēts:', 'published')->options([
                0 => 'Nē',
                1 => 'Jā'
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
            Text::make('Vārds, Uzvārds:','name_lv'),
            Text::make('Имя, Фамилия:','name_ru')->onlyOnForms(),
            Text::make('title_lv')->hideFromIndex(),
            Text::make('title_ru')->onlyOnForms(),
            Text::make('small_lv')->onlyOnForms(),
            Text::make('small_ru')->onlyOnForms(),
            NovaTrumbowyg::make('Teksts', 'text_lv')->onlyOnForms(),
            NovaTrumbowyg::make('Текст', 'text_ru')->onlyOnForms(),
            Text::make('Order:', function() use ($request){
                if ($request->viaResource() === 'App\Nova\Service') {
                    return $this->pivot->order;
                } else {
                    return $this->order;
                }
            })->sortable()->hideFromDetail(),
            Select::make('Dzimums:','gender')->options([
                0 => 'Virietis',
                1 => 'Sieviete',
            ])->onlyOnForms()->displayUsingLabels(),
            BelongsToMany::make('Services'),

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
            $query->orderBy('doctors_services.order');
        }
        return $query;
    }
    public static function relatableQuery(NovaRequest $request, $query){

    }
    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Ārsti';
    }
}

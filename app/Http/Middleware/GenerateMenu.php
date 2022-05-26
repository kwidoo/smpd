<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Menu;

class GenerateMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     */
    public function handle($request, Closure $next)
    {
        /**
         * Sets current locale for website
         * @method void setLocale()
         * co11
         **/
        App::setLocale(session('lang','lv'));

        Menu::make('SmpdMenu', function ($menu) {
        
            $menu->add(__('messages.services'), ['route' => 'services','class' => 'nav-item'])->link->attr(['class' => 'nav-link btn btn-lg btn-primary pt-3 pb-3 mr-2']);
            
            $menu->add(__('messages.doctors'), ['route' => 'doctors','class' => 'nav-item'])->link->attr(['class' => 'nav-link btn btn-lg btn-primary pt-3 pb-3 mr-2']);
            $menu->add(__('messages.prices'), ['route' => 'prices','class' => 'nav-item'])->link->attr(['class' => 'nav-link btn btn-lg btn-primary pt-3 pb-3 mr-2']);
            $menu->add(__('messages.actions'), ['route' => 'actions','class' => 'nav-item'])->link->attr(['class' => 'nav-link btn btn-lg btn-primary pt-3 pb-3 mr-2']);
            $menu->add(__('messages.contacts'), ['route' => 'contacts','class' => 'nav-item'])->link->attr(['class' => 'nav-link btn btn-lg btn-primary pt-3 pb-3 mr-2']);

        });

        return $next($request);    
    }
}

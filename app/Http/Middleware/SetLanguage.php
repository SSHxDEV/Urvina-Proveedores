<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use Closure;
// Note next two lines:
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \App::setLocale($request->language);
        $menus = [];
        if($request->language == 'en'){
            $menus = config('menus.en.menu');
        }
        if($request->language == 'es'){
            $menus = config('menus.es.menu');
        }
        if($request->language == 'sup'){
            $menus = config('menus.sup.menu');
        }
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) use ($menus){
            foreach ($menus as $menu){
                $event->menu->add($menu);
            }
        });

        return $next($request);
    }
}

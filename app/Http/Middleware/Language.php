<?php

namespace App\Http\Middleware;

use Closure;

use Blade;

class Language
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

        $locale = $request->segment(1);
        if (array_key_exists($locale, app()->config->get('app.locales'))) {
            app()->setLocale($locale);
            // dd('sss');
        }
        elseif(!array_key_exists($locale, app()->config->get('app.locales'))){
            app()->setLocale(app()->getLocale());
            $newPath = '/'.app()->getLocale() .'/'. implode('/', $request->segments());
            // dd($newPath);
            return redirect($newPath);
            // $newPath = app()->getLocale() .'/'. implode('/', $localArr);

        }
        
// dd(app()->getLocale());
        /*$localArr = $request->segments();
        $locale = $request->segment(count($localArr));
        $locale2 = $request->segment(1);
        // if ( ! array_key_exists('', $request->segments())) {
        if (array_key_exists($locale, app()->config->get('app.locales'))) {
            $localArr = array_diff($localArr, [$locale]);
            $newPath = $locale . '/' . implode('/', $localArr);
            
            $segments = $request->segments();
            $segments[0] = app()->config->get('app.fallback_locale');
            return redirect($newPath);
        }
        elseif(!array_key_exists($locale, app()->config->get('app.locales')) && 
            !array_key_exists($locale2, app()->config->get('app.locales'))){
            $newPath = app()->getLocale() .'/'. implode('/', $localArr);
            // dd($newPath);
            return redirect($newPath);
        }*/
        
        // app()->setLocale($locale);

        return $next($request);
    }
}

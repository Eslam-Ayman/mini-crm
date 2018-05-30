<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);
        /*app()->setLocale('ar');
        dd(app()->getLocale().' sdasd');

        $localArr = $request->segments();

        $locale = $request->segment(count($localArr));

        $locale2 = $request->segment(1);

        if(!array_key_exists($locale, app()->config->get('app.locales')) && 
            !array_key_exists($locale2, app()->config->get('app.locales'))){

        dump($locale.'  '. $locale2);
            $newPath = app()->getLocale() .'/'. implode('/', $localArr);
            dd($newPath);
            return redirect($newPath);
        }*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        

    }
}

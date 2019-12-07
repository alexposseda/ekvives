<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;

class Locale
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

        if(session()->get('override_locale')){
            $current = session()->get('override_locale');
        }else{
            $app_locales = Language::getLocales();

            $uri         = \Request::path();
            $segmentsURI = explode('/', $uri);
            if(!empty($segmentsURI[0]) && in_array($segmentsURI[0], $app_locales)){
                $current = $segmentsURI[0];
            }else{
                $current = Language::getDefault();
            }

        }

        \App::setLocale($current);
        return $next($request);
    }
}
